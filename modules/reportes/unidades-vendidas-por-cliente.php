<?php

include 'template.php';
require '../../global/connection.php';

if (!isset($_GET['productid'])) {
    echo "Error al obtener reporte. Variable 'productid' no especificada.";
    return;
}

if (!isset($_GET['datefrom'])) {
    echo "Error al obtener reporte. Variable 'datefrom' no especificada.";
    return;
}

if (!isset($_GET['dateto'])) {
    echo "Error al obtener reporte. Variable 'dateto' no especificada.";
    return;
}

$productId = $_GET['productid'];
$dateFrom = $_GET['datefrom'];
$dateTo = $_GET['dateto'];

$reportTitle = "Unidades Compradas por Cliente";
$rptDateInterval = "UNIDADES COMPRADAS (Sin rango de fecha)";

$productString = "";
$dateString = "";
$productData = "";

// Si el productId es distinto de 0, obtener detalles del producto
if ($productId != 0 && $productId != "") {
    $reportTitle = "Unidades de Producto Compradas por Cliente";
    $productString = " AND s.product_id = " . $productId;

    // Obtener detalles del producto
    $sqlProductInfo = "SELECT p.id, p.code, p.brand, p.name, p.description,
        (CASE
            WHEN p.active_status = 1 THEN 'ACTIVO'
            WHEN p.active_status = 0 THEN 'INACTIVO'
        END) AS status
        FROM tbl_product p
        WHERE p.id = " . $productId;

    $sqlStatement = $pdo->prepare($sqlProductInfo);
    $sqlStatement->execute();
    $productData = $sqlStatement->fetch();

    if ($productData == null) {
        echo "Error al obtener reporte. Variable 'productid' no es válida. No existe el producto solicitado.";
        return;
    }
}

// Rango de fechas
if ($dateFrom != "" && $dateTo != "") {
    $dateString = " AND (s.fecha_compra BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "')";
    $rptDateInterval = "UNIDADES COMPRADAS DEL " . date("d/m/Y", strtotime($dateFrom)) . " AL " . date("d/m/Y", strtotime($dateTo));
}

// Consulta para obtener las unidades compradas por cliente (desde tbl_shopping)
// Si el productId es 0, no filtramos por producto, mostramos todos
$sqlString = "SELECT c.ruc, c.business_name AS client_name, s.product_id,
                    SUM(s.quantity) AS TOTAL_UNITS_PURCHASED
FROM tbl_customer c
LEFT JOIN tbl_shopping s ON s.client_id = c.client_id
WHERE 1 " . $productString . $dateString . "
GROUP BY c.ruc, c.business_name, s.product_id
ORDER BY TOTAL_UNITS_PURCHASED DESC";

$sqlStatement = $pdo->prepare($sqlString);
$sqlStatement->execute();
$rowsNumber = $sqlStatement->rowCount();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetHeaderTitle(mb_convert_encoding($reportTitle ?? '', 'ISO-8859-1', 'UTF-8'));
$pdf->AddPage("L", "A4", 0);
$pdf->SetTitle($reportTitle, true);
$pdf->SetSubject($reportTitle, true);
$pdf->SetAuthor("SATVICOS", true);
$pdf->SetCreator("fpdf v1.82", true);

$pdf->SetFillColor(232, 232, 232);

// Solo mostramos los detalles del producto si el productId no es 0
if ($productId != 0 && $productId != "") {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(0, 6, mb_convert_encoding('DATOS DEL PRODUCTO', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 6, mb_convert_encoding('ID', 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(20, 6, mb_convert_encoding($productData['id'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(24, 6, mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(50, 6, mb_convert_encoding($productData['code'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(24, 6, mb_convert_encoding('Marca', 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(90, 6, mb_convert_encoding($productData['brand'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(19, 6, mb_convert_encoding('Estado', 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(0, 6, mb_convert_encoding($productData['status'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->Ln();

    // Aquí agregamos una celda con el nombre del producto
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 6, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(0, 6, mb_convert_encoding($productData['name'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 6, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 1, 0, 'R', 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(0, 6, mb_convert_encoding($productData['description'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 0);
    $pdf->Ln(10);
}

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 6, mb_convert_encoding($rptDateInterval ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Ln();
$pdf->Cell(24, 6, mb_convert_encoding('RIF', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Cell(213, 6, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L', 1);
$pdf->Cell(40, 6, mb_convert_encoding('UNIDADES COMPRADAS', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 9);

if ($rowsNumber > 0) {

    $totalUnitsPurchased = 0;

    foreach ($sqlStatement as $row) {
        $pdf->Cell(24, 6, mb_convert_encoding($row['ruc'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell(213, 6, mb_convert_encoding($row['client_name'] ?? '', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');

        $unitsPurchased = $row['TOTAL_UNITS_PURCHASED'];

        $pdf->Cell(40, 6, mb_convert_encoding($unitsPurchased ?? 0, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Ln();

        $totalUnitsPurchased += $unitsPurchased;
    }

    $pdf->Cell(167);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(70, 6, mb_convert_encoding("TOTAL UNIDADES COMPRADAS", 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
    $pdf->Cell(40, 6, mb_convert_encoding($totalUnitsPurchased, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
} else {
    $pdf->Cell(0, 6, mb_convert_encoding("No existen datos para el producto especificado", 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
}

$pdf->Output("I", $reportTitle . ".pdf", true);
?>
