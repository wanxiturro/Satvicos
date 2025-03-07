<?php

require '../reportes/template.php';
require '../../global/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['history_salida_executed'])) {
    require_once 'insert-salida.php';
    // Marcar como ejecutado
    $_SESSION['history_salida_executed'] = true;
}

$usuario = $_SESSION['loggedInUser']['EMPLOYEE_NAME'];
$reportTitle = "ALIMENTOS SATVICOS 21-11-1926 C.A.";

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetHeaderTitle(mb_convert_encoding($reportTitle, 'ISO-8859-1', 'UTF-8'));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(0, -35, mb_convert_encoding("RIF: J-31423813-2", 'ISO-8859-1', 'UTF-8'), 0, 0, 'R');
$pdf->Cell(0, -23, mb_convert_encoding("Nro Nota d Entrega: ", 'ISO-8859-1', 'UTF-8').$_POST['salida_estado'], 0, 0, 'R');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 0, mb_convert_encoding("Fecha Emisión:", 'ISO-8859-1', 'UTF-8'). '         '.$_POST['salida_fecha'], 0, 0, 'R');
$pdf->Cell(0, 10, mb_convert_encoding("Fecha Venc.:", 'ISO-8859-1', 'UTF-8'). '             '.$_POST['salida_fecha'], 0, 0, 'R');
$pdf->Cell(0, 20, mb_convert_encoding("Cond. Pago:", 'ISO-8859-1', 'UTF-8'). '                     '.$_POST['salida_estado'], 0, 0, 'R');
$pdf->Cell(0, 30, mb_convert_encoding("Vendedor:", 'ISO-8859-1', 'UTF-8'). '                    '.$usuario, 0, 0, 'R');

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(-195, -25, mb_convert_encoding("Calle la Línea Edificio Deusto Piso 1 Ofic 103 Urbanizacion", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Cell(0, -19, mb_convert_encoding("Prados de María, Caracas Distrito Capital, Zona Postal 1040", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Cell(-195, -13, mb_convert_encoding("Telfs: +58 (212) 267 51 92 / 267 10 62", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');


$pdf->SetFont('Arial', '', 8);
$pdf->Cell(25, 5, mb_convert_encoding("Cliente: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Cell(-21, 20, mb_convert_encoding("R.I.F: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Cell(14, 27, mb_convert_encoding("Dirección: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Cell(-11.5, 42, mb_convert_encoding("Dir. Ent: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

$pdf->Ln(0);
$pdf->Cell(14, 5, mb_convert_encoding("", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(0.5, 5, mb_convert_encoding("".$_POST['salida_valcliente'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(0.5, 20, mb_convert_encoding("".$_POST['salida_clirif'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(0, 27, mb_convert_encoding("".$_POST['salida_clidirecc'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(0);

$pdf->Ln(35);
$pdf->SetFont('arial','B',9);

$pdf->Cell(85, 5, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 5, 'Alm.', 1, 0, 'C');
$pdf->Cell(15, 5, mb_convert_encoding('Cantidad', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(15, 5, 'Unid.', 1, 0, 'C');
$pdf->Cell(15, 5, mb_convert_encoding('Precio', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(15, 5, mb_convert_encoding('% Desc.', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(15, 5, mb_convert_encoding('% I.V.A', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(15, 5, mb_convert_encoding('Neto', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');

$pdf->Ln(8);

if (isset($_POST['salida_prods'])) {
    $productos = json_decode($_POST['salida_prods'], true);  // Decodificar el JSON recibido
} else {
    $pdf->Cell(0,6,mb_convert_encoding("Ningun producto por salir", 'ISO-8859-1', 'UTF-8'),1,0,'C');
}
$pdf->SetFont('Arial', '', 9);

// SUMA DE IVA + IMPORTE PARA DAR EL NETO DEL PRODUCTO
$productoIva = $producto[6]; // Convertir a número (float)
$salidaIgv = $_POST['salida_igv']; // Convertir a número (float)
$sumaIva = $productoIva + $salidaIgv; // Sumar los valores
$iva = $productoIva * 0.16;

// Arrays para almacenar productos y cantidades
$productosArray = [];
$cantidadesArray = [];





foreach ($productos as $producto) {
    $pdf->SetFont('arial','',7);
    $pdf->Cell(85, 0, $producto[3], 0, 0, 'L'); // DESCRIPCION
    $pdf->Cell(15, 0, $producto[2], 0, 0, 'C'); // ALM.
    $pdf->Cell(15, 0, $producto[5], 0, 0, 'C'); // CANTIDAD
    $pdf->Cell(15, 0, $producto[0], 0, 0, 'C'); // UNIDADES
    $pdf->Cell(15, 0, $producto[4], 0, 0, 'C'); // PRECIO
    $pdf->Cell(15, 0, ("0.00"), 0, 0, 'C'); // DESCUENTO
    $pdf->Cell(15, 0, ("0.00"), 0, 0, 'C'); // IVA
    $pdf->Cell(15, 0, $producto[6], 0, 0, 'C'); // NETO
    $pdf->Ln(3);

    // Agregar a los arrays
    $productosArray[] = $producto[2]; // Nombre del producto
    $cantidadesArray[] = $producto[5]; // Cantidad del producto
}

$pdf->setXY(10,120);
$pdf->Cell(160, 5, mb_convert_encoding('Sub-total: ', 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
$pdf->Cell(160, 5, mb_convert_encoding('I.V.A: ', 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
$pdf->Cell(160, 5, mb_convert_encoding('Descuento: ', 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
$pdf->Cell(160, 5, mb_convert_encoding('Neto: ', 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');



$pdf->Cell(185, -35, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8').$_POST['salida_opergrab'], 0, 1, 'R');
$pdf->Cell(185, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8').$_POST['salida_igv'], 0, 1, 'R');
$pdf->Cell(185, -35, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8').$_POST['salida_cantdesc'], 0, 1, 'R');
$pdf->Cell(185, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8').$_POST['salida_total'], 0, 1, 'R');

$pdf->Ln(0);
$pdf->SetFont('Arial', '', 8);
$pdf->setXY(10,120);
$pdf->Cell(25, 3, mb_convert_encoding("Origen: ", 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->Cell(25, 10, mb_convert_encoding("Transporte: ", 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->Cell(25, 5, mb_convert_encoding("Moneda: ".$_POST['salida_tipmon'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');


$pdf->Ln(50);
$pdf->Cell(0, 20, mb_convert_encoding('___________________________', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(0, 10, mb_convert_encoding('Firma y sello', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

$numcode = date("dmHis");
    
$pdf->setXY(145,271);
$pdf->cell(28,5,('Numero de reporte:'),0,0,'L',0);
$pdf->SetFont('arial','B',9);
$pdf->cell(15,5,date("YmdHis"),0,0,'L',0);

$pdf->SetFont('arial','B',9);
$pdf->setXY(10,72);
$pdf->Cell(85, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Ln(10);


$pdf->SetFont('arial','',7);
$pdf->setXY(25,32);
$pdf->Cell(-150, 42, mb_convert_encoding("".$_POST['salida_clirefer'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');

$pdf->SetFont('arial','B',9);
$pdf->setXY(147,120);
$pdf->Cell(53, 20, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Ln(10);
$pdf->SetFont('arial','B',9);
$pdf->setXY(147,135);
$pdf->Cell(53, 5, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');

$numcode = date("dmHis");
$fecha = date("Y/m/d H:i:s");
$pdfPath = $_SERVER['DOCUMENT_ROOT'] . '/satvicos-master/reportes/Salida/SALIDA ' . $usuario ."_" . date("YmdHis")."_documento.pdf";

$pdf->Output('F', $pdfPath);
$pdf->Output('I');

// Verificar si el archivo PDF ya existe en la base de datos
$checkQuery = "SELECT COUNT(*) FROM tbl_pdf_exit WHERE path_arch = :path_arch";
$stmtCheck = $pdo->prepare($checkQuery);
$stmtCheck->bindParam(':path_arch', $pdfPath);
$stmtCheck->execute();
$count = $stmtCheck->fetchColumn();

if ($count == 0) {
    // Convertir los arrays en cadenas separadas por comas
    $productosStr = implode(', ', $productosArray);
    $cantidadesStr = implode(', ', $cantidadesArray);

    // Almacenar información en la base de datos
    $insertQuery = "INSERT INTO tbl_pdf_exit (id_report, name_user, path_arch, report_products, report_cant) VALUES (:id_report, :name_user, :path_arch, :report_products, :report_cant)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(':id_report', $numcode);
    $stmt->bindParam(':name_user', $usuario);
    $stmt->bindParam(':path_arch', $pdfPath);
    $stmt->bindParam(':report_products', $productosStr);
    $stmt->bindParam(':report_cant', $cantidadesStr);
    if ($stmt->execute()) {
        echo "Registro guardado correctamente en la base de datos.";
    } else {
        echo "Error al guardar en la base de datos: " . $stmt->errorInfo()[2];
    }
} else {
    echo "El archivo PDF ya existe en la base de datos.";
}

?>
