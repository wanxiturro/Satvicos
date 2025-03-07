<?php

include 'template.php';
require '../../global/connection.php';

if (!isset($_GET['mode'])) {
    echo "Error al obtener reporte. Variable 'mode' no especificada.";
    return;
}

$mode = $_GET['mode'];
$reportTitle = "";
$orderString = "";

if ($mode == 1) {
    $reportTitle = "Productos Más Vendidos";
    $orderString = "DESC"; // Orden descendente para los más vendidos
} else if ($mode == 2) {
    $reportTitle = "Productos Menos Vendidos";
    $orderString = "ASC";  // Orden ascendente para los menos vendidos
} else {
    echo "Error al obtener reporte. Valor para variable 'mode' no válido.";
    return;
}

// Consulta SQL ajustada para usar tbl_warehouse_movement (tipo 3 = salida)
$sqlString = "
    SELECT 
        p.id, 
        p.code, 
        p.brand, 
        p.name, 
        p.description,
        CASE 
            WHEN p.active_status = 1 THEN 'Activo' 
            WHEN p.active_status = 0 THEN 'Inactivo' 
        END AS STATUS, 
        SUM(wm.quantity) AS TOTAL
    FROM tbl_warehouse_movement wm
    JOIN tbl_product p ON wm.product_id = p.id
    WHERE wm.type = 3  -- Solo los movimientos de salida (type = 3)
    GROUP BY p.id, p.code, p.brand, p.name, p.description
    HAVING TOTAL > 0  -- Asegura que solo se muestren productos con salidas
    ORDER BY TOTAL " . $orderString . " 
    LIMIT 20
";

$sqlStatement = $pdo->prepare($sqlString);

$sqlStatement->execute();
$rowsNumber = $sqlStatement->rowCount();

// Crear el PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetHeaderTitle(mb_convert_encoding($reportTitle, 'ISO-8859-1', 'UTF-8'));
$pdf->AddPage("L", "A4", 0);
$pdf->SetTitle($reportTitle, true);
$pdf->SetSubject($reportTitle, true);
$pdf->SetAuthor("Satvicos Alimentos", true);
$pdf->SetCreator("fpdf v1.82", true);

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);

// Títulos de las columnas en el PDF
$pdf->Cell(8, 6, mb_convert_encoding('N°', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Cell(30, 6, mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Cell(40, 6, mb_convert_encoding('Marca', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Cell(164, 6, mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Cell(15, 6, mb_convert_encoding('Estado', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Cell(20, 6, mb_convert_encoding('UNIDADES', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 9);

$rowNumber = 1;

if ($rowsNumber > 0) {
    foreach ($sqlStatement as $row) {
        // Agregar los datos de cada producto al PDF
        $pdf->Cell(8, 6, mb_convert_encoding($rowNumber, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 1);
        $pdf->Cell(30, 6, mb_convert_encoding($row['code'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell(40, 6, mb_convert_encoding($row['brand'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell(164, 6, mb_convert_encoding($row['name'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
        $pdf->Cell(15, 6, mb_convert_encoding($row['STATUS'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell(20, 6, mb_convert_encoding($row['TOTAL'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Ln();
        $rowNumber++;
    }
}

$pdf->Output("I", $reportTitle . ".pdf", true);

