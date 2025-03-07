<?php

include 'template.php';
require '../../global/connection.php';

if (!isset($_GET['customerid'])){
	echo "Error al obtener reporte. Variable 'customerid' no especificada.";
	return;
}

if (!isset($_GET['datefrom'])){
	echo "Error al obtener reporte. Variable 'datefrom' no especificada.";
	return;
}

if (!isset($_GET['dateto'])){
	echo "Error al obtener reporte. Variable 'dateto' no especificada.";
	return;
}

$customerId = $_GET['customerid'];
$dateFrom = $_GET['datefrom'];
$dateTo = $_GET['dateto'];

$reportTitle = "Ventas por Cliente";
$rptDateInterval = "VENTAS (Sin rango de fecha)";

$productString = "";
$dateString = "";

if ($dateFrom!= "" && $dateTo!= ""){
	$dateString = " AND (th.date BETWEEN '" . $dateFrom . "' AND '". $dateTo . "')";
	$rptDateInterval = "VENTAS DEL " . date("d/m/Y", strtotime($dateFrom)) . " AL " . date("d/m/Y", strtotime($dateTo));
}

$sqlCustomerInfo = "(SELECT DISTINCT th.ruc, th.name, th.address
 FROM tbl_invoice th
WHERE th.ruc = " . $customerId . ")
UNION
(SELECT DISTINCT th.ruc, th.name, th.address
 FROM tbl_receipt th
WHERE th.ruc = " . $customerId . ")";

$sqlStatement = $pdo->prepare($sqlCustomerInfo);
$sqlStatement->execute();
$customerData = $sqlStatement->fetch();

if ($customerData == null){
	echo "Error al obtener reporte. Variable 'customerid' no es válida. No existe el cliente solicitado.";
	return;
}

$sqlString = "(SELECT id, CONCAT(series, '-',number) AS DOC_NUMBER,
date,
delivery_date,
currency,
total_sub,
total_tax,
total_net,
(CASE
 WHEN th.status=1 THEN 'Vigente'
 WHEN th.status=2 THEN 'Anulado'
 WHEN th.status=3 THEN 'Pendiente de Pago'
 WHEN th.status=4 THEN 'Cancelado'
END) AS STATUS
FROM tbl_invoice th
WHERE th.ruc= '" . $customerId . "' " . $dateString . ")
UNION
(SELECT id, CONCAT(series, '-',number) AS DOC_NUMBER,
date,
delivery_date,
currency,
total_sub,
total_tax,
total_net,
(CASE
 WHEN th.status=1 THEN 'Vigente'
 WHEN th.status=2 THEN 'Anulado'
 WHEN th.status=3 THEN 'Pendiente de Pago'
 WHEN th.status=4 THEN 'Cancelado'
END) AS STATUS
FROM tbl_receipt th
WHERE th.ruc= '" . $customerId . "' " . $dateString . ")
UNION
(SELECT id, CONCAT(series, '-',number) AS DOC_NUMBER,
date,
delivery_date,
currency,
total_sub,
total_tax,
total_net*-1,
(CASE
 WHEN th.status=1 THEN 'Vigente'
 WHEN th.status=2 THEN 'Anulado'
 WHEN th.status=3 THEN 'Pendiente de Pago'
 WHEN th.status=4 THEN 'Cancelado'
END) AS STATUS
FROM tbl_credit_note th
WHERE th.ruc= '" . $customerId . "' " . $dateString . ")
ORDER BY date DESC";

$sqlStatement = $pdo->prepare($sqlString);

$sqlStatement->execute();
$rowsNumber = $sqlStatement->rowCount();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetHeaderTitle(mb_convert_encoding($reportTitle, 'ISO-8859-1', 'UTF-8'));
$pdf->AddPage("L","A4",0);
$pdf->SetTitle($reportTitle,true);
$pdf->SetSubject($reportTitle,true);
$pdf->SetAuthor("SATVICOS",true);
$pdf->SetCreator("fpdf v1.82",true);

$pdf->SetFillColor(232,232,232);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,6,mb_convert_encoding('DATOS DEL CLIENTE', 'ISO-8859-1', 'UTF-8'),1,0,'L',1);
$pdf->Ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,6,mb_convert_encoding('RUC / DNI', 'ISO-8859-1', 'UTF-8'),1,0,'R',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,6,mb_convert_encoding($customerData['ruc'], 'ISO-8859-1', 'UTF-8'),1,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,6,mb_convert_encoding('Nombre', 'ISO-8859-1', 'UTF-8'),1,0,'R',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,6,mb_convert_encoding($customerData['name'], 'ISO-8859-1', 'UTF-8'),1,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,6,mb_convert_encoding('Dirección', 'ISO-8859-1', 'UTF-8'),1,0,'R',1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,6,mb_convert_encoding($customerData['address'], 'ISO-8859-1', 'UTF-8'),1,0,'L',0);

$pdf->Ln(10);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,6,mb_convert_encoding($rptDateInterval, 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Ln();
$pdf->Cell(16,6,mb_convert_encoding('TBLID', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(28,6,mb_convert_encoding('Nro. Doc.', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(30,6,mb_convert_encoding('Fecha Emisión', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(30,6,mb_convert_encoding('Fecha Entrega', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(59,6,mb_convert_encoding('Estado', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(24,6,mb_convert_encoding('Tipo Moneda', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(30,6,mb_convert_encoding('Subtotal', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(30,6,mb_convert_encoding('IGV', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
$pdf->Cell(30,6,mb_convert_encoding('Total Neto', 'ISO-8859-1', 'UTF-8'),1,0,'C',1);

$pdf->Ln();

$pdf->SetFont('Arial','',9);

if ($rowsNumber > 0) {

    $totalSales = 0;

    foreach ($sqlStatement as $row) {
        $pdf->Cell(16,6,mb_convert_encoding($row['id'], 'ISO-8859-1', 'UTF-8'),1,0,'C');
        $pdf->Cell(28,6,mb_convert_encoding($row['DOC_NUMBER'], 'ISO-8859-1', 'UTF-8'),1,0,'C');
        $pdf->Cell(30,6,mb_convert_encoding(date("d/m/Y", strtotime($row["date"])), 'ISO-8859-1', 'UTF-8'),1,0,'C');
        $pdf->Cell(30,6,mb_convert_encoding(date("d/m/Y", strtotime($row["delivery_date"])), 'ISO-8859-1', 'UTF-8'),1,0,'C');
        $pdf->Cell(59,6,mb_convert_encoding($row['STATUS'], 'ISO-8859-1', 'UTF-8'),1,0,'C');
        $pdf->Cell(24,6,mb_convert_encoding($row['currency'], 'ISO-8859-1', 'UTF-8'),1,0,'C');
        $pdf->Cell(30,6,mb_convert_encoding(number_format($row['total_sub'], 2, '.',''), 'ISO-8859-1', 'UTF-8'),1,0,'R');
        $pdf->Cell(30,6,mb_convert_encoding(number_format($row['total_tax'], 2, '.',''), 'ISO-8859-1', 'UTF-8'),1,0,'R');

        $total_net = $row['total_net'];

        $pdf->Cell(30,6,mb_convert_encoding(number_format($row['total_net'], 2, '.',''), 'ISO-8859-1', 'UTF-8'),1,0,'R');
            
        $pdf->Ln();

        $totalSales += $total_net;
    }

    $pdf->Cell(217);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,6,mb_convert_encoding("TOTAL VENTAS", 'ISO-8859-1', 'UTF-8'),1,0,'C',1);
    $pdf->Cell(0,6,mb_convert_encoding(number_format($totalSales, 2, '.',''), 'ISO-8859-1', 'UTF-8'),1,0,'R');

} else {
    $pdf->Cell(276,6,mb_convert_encoding("No existen datos para el cliente especificado", 'ISO-8859-1', 'UTF-8'),1,0,'C');
}

$pdf->Output("I", $reportTitle . ".pdf", true);
