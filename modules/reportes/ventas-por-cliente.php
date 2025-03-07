<?php
require('../../global/connection.php');
require('../reportes/template.php');

// Verificar si se ha recibido el 'client_id' y si está vacío
if (!isset($_GET['client_id']) || empty($_GET['client_id'])) {
    echo "Error: no se especificó 'client_id'.";
    return;
}

$clientId = $_GET['client_id'];  // Obtener el 'client_id' del formulario

// Verificar si se han recibido los parámetros de fechas (datefrom y dateto)
$dateFrom = isset($_GET['datefrom']) ? $_GET['datefrom'] : '';
$dateTo = isset($_GET['dateto']) ? $_GET['dateto'] : '';

// Inicializar la variable de condición de fecha
$fechaCondicion = '';

// Si ambas fechas están proporcionadas, se añaden las condiciones de fecha
if (!empty($dateFrom) && !empty($dateTo)) {
    // Validar el formato de las fechas (YYYY-MM-DD)
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dateFrom) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $dateTo)) {
        echo "Error: Las fechas no tienen el formato correcto (YYYY-MM-DD).";
        return;
    }
    // Filtrar las compras entre las fechas proporcionadas
    $fechaCondicion = "AND s.fecha_compra BETWEEN :dateFrom AND :dateTo";
} elseif (!empty($dateFrom)) {
    // Si solo se ha especificado la fecha de inicio, filtrar las compras desde esa fecha
    $fechaCondicion = "AND s.fecha_compra >= :dateFrom";
} elseif (!empty($dateTo)) {
    // Si solo se ha especificado la fecha de fin, filtrar las compras hasta esa fecha
    $fechaCondicion = "AND s.fecha_compra <= :dateTo";
}

// Título del reporte
$reportTitle = "Reporte de Compras por Cliente";

// Consultar la información de compras filtrada por 'client_id' y las fechas si están especificadas
$sql = "
    SELECT 
        s.id_compra, 
        s.client_id, 
        s.product_id, 
        s.quantity, 
        s.fecha_compra, 
        s.total_compra, 
        p.name AS product_name, 
        c.business_name AS client_name
    FROM tbl_shopping s
    JOIN tbl_product p ON s.product_id = p.id
    JOIN tbl_customer c ON s.client_id = c.client_id
    WHERE s.client_id = :clientId
    $fechaCondicion
    ORDER BY s.fecha_compra DESC
";

$sqlStatement = $pdo->prepare($sql);
$rowsNumber = $sqlStatement->rowCount();

// Bind de parámetros
$sqlStatement->bindParam(':clientId', $clientId, PDO::PARAM_INT);

// Si se especifican fechas, vincular las fechas a la consulta
if (!empty($dateFrom) && !empty($dateTo)) {
    $sqlStatement->bindParam(':dateFrom', $dateFrom, PDO::PARAM_STR);
    $sqlStatement->bindParam(':dateTo', $dateTo, PDO::PARAM_STR);
} elseif (!empty($dateFrom)) {
    $sqlStatement->bindParam(':dateFrom', $dateFrom, PDO::PARAM_STR);
} elseif (!empty($dateTo)) {
    $sqlStatement->bindParam(':dateTo', $dateTo, PDO::PARAM_STR);
}

$sqlStatement->execute();
$rows = $sqlStatement->fetchAll();

// Crear el objeto PDF
$pdf = new FPDF();
$pdf->AddPage(); // Asegurarse de añadir la página

$reportTitle = "ALIMENTOS SATVICOS 21-11-1926 C.A.";

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetHeaderTitle(mb_convert_encoding($reportTitle, 'ISO-8859-1', 'UTF-8'));

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->setXY(95, 20);
$pdf->Cell(25, 6, 'Registro de compras', 0, 0, 'C');
$pdf->Ln();

// Cabecera de la tabla
$pdf->setXY(10,35);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, 'ID', 1, 0, 'C');
$pdf->Cell(40, 6, 'Cliente', 1, 0, 'C');
$pdf->Cell(40, 6, 'Productos', 1, 0, 'C');
$pdf->Cell(20, 6, 'Cantidad', 1, 0, 'C');
$pdf->Cell(35, 6, 'Fecha Compra', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Compra', 1, 0, 'C');
$pdf->Ln();

// Cuerpo de la tabla
$pdf->SetFont('Arial', '', 9);
if ($rowsNumber <= 0) {

foreach ($rows as $row) {
    $iva = $row['total_compra'] * 0.16;
    $total = $row['total_compra'] + $iva;
    $pdf->Cell(20, 6, $row['id_compra'], 1, 0, 'C');
    $pdf->Cell(40, 6, mb_convert_encoding($row['client_name'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
    $pdf->Cell(40, 6, $row['product_name'], 1, 0, 'C');
    $pdf->Cell(20, 6, $row['quantity'], 1, 0, 'C');
    $pdf->Cell(35, 6, date("d/m/Y", strtotime($row['fecha_compra'])), 1, 0, 'C');
    $pdf->Cell(35, 6, number_format($total, 2, '.', ''), 1, 0, 'R');
    $pdf->Ln();
}

} else {
$pdf->Cell(190,6,mb_convert_encoding("Este cliente aún no ha adquirido productos.", 'ISO-8859-1', 'UTF-8'),1,0,'C');
}
// Salida del PDF
$pdf->Output("I", "Reporte_Compras_Cliente_" . date("Ymd_His") . ".pdf");
?>
