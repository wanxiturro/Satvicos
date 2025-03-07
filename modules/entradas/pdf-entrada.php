<?php

require '../../plugins/fpdf/fpdf.php';

date_default_timezone_set('America/Caracas');

class PDF extends FPDF
{
    var $headerTitle="";

    function SetHeaderTitle($title)
    {
        $this->headerTitle = $title;
    }

    function HeaderTitle()
    {
        return $this->headerTitle;
    }

    function Header()
    {

        $this->Cell(190, 39, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
        $this->setXY(12.5,12);
        $this->Cell(35, 35, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
        $this->Image('../../img/logo.png', 10, 8.5, 40);
        $this->SetFont('Arial', 'B', 14);
        //$this->Cell(30);
        $this->Cell(0, 10, $this->HeaderTitle(), 0, 0, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(222);
        $this->Cell(22, 10, mb_convert_encoding("Fecha y Hora:", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);

        $this->Ln(12);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, mb_convert_encoding('Página ' . $this->PageNo() . '/{nb}', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
    }
}

require '../../global/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['history_entrada_executed'])) {
    require_once 'insert-entrada.php';
    // Marcar como ejecutado
    $_SESSION['history_entrada_executed'] = true;
}

$usuario = $_SESSION['loggedInUser']['EMPLOYEE_NAME'];
$reportTitle = "Reporte de entrada - Satvicos";

$pdf = new PDF();
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->setXY(50,16);
$pdf->Cell(0, 0, mb_convert_encoding("Sistema de gestión de inventarios", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(50,20);
$pdf->Cell(0, 0, mb_convert_encoding("ALIMENTOS SATVICOS 23-11-1926 C.A", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(50,24);
$pdf->Cell(0, 0, mb_convert_encoding("R.I.F.: J-31423813-2", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(50,30);
$pdf->Cell(0, 0, mb_convert_encoding("FORMATO NOTA DE RECEPCIÓN", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->setXY(153,16);
$pdf->Cell(0, 0, mb_convert_encoding("Usuario: ". $usuario, 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(154,20);
$pdf->Cell(0, 0, mb_convert_encoding("Página:                  ". $pdf->PageNo() . '     de     {nb}', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(155,24);
$pdf->Cell(0, 0, mb_convert_encoding("Fecha: ". date("d/m/y H:i:s a"), 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');

$pdf->setXY(10,51.5);
$pdf->Cell(190, 45, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->setXY(15,55);
$pdf->Cell(0, 0, mb_convert_encoding("Proveedor: ". $_POST['entrada_prov_nombre'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(21.9,59);
$pdf->Cell(0, 0, mb_convert_encoding("R.I.F.: ". $_POST['entrada_prov_rif'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(15.7,63);
$pdf->Cell(0, 0, mb_convert_encoding("Teléfonos: ". $_POST['entrada_prov_phone1'] . " / " . $_POST['entrada_prov_phone2'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(16.5,67);
$pdf->Cell(0, 0, mb_convert_encoding("Dirección: ". $_POST['entrada_prov_address'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(16.5,77);
$pdf->Cell(0, 0, mb_convert_encoding("Dir. Ent.: ". $_POST['entrada_clidirecc'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(120,55);
$pdf->Cell(0, 0, mb_convert_encoding("Nota de recepción: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(120.7,59);
$pdf->Cell(0, 0, mb_convert_encoding("Fecha de emisión: ". $_POST['entrada_fecha'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(123.9,63);
$pdf->Cell(0, 0, mb_convert_encoding("Fecha de venc.: ". $_POST['entrada_fecha'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(128.9,67);
$pdf->Cell(0, 0, mb_convert_encoding("Cond. Pago: ". $_POST['entrada_formpagotext'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(129,71);
$pdf->Cell(0, 0, mb_convert_encoding("Descripción: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');

$pdf->setXY(134,89);
$pdf->Cell(0, 0, mb_convert_encoding("Moneda: ". $_POST['entrada_tipmon'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->setXY(135.9,93);
$pdf->Cell(0, 0, mb_convert_encoding("Origen: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Ln(6);

$pdf->SetFont('arial','B',8);
$pdf->Cell(15, 5, mb_convert_encoding('Código', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(15, 5, 'Modelo', 1, 0, 'C');
$pdf->Cell(37, 5, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(10, 5, 'Alm.', 1, 0, 'C');
$pdf->Cell(13, 5, mb_convert_encoding('Cantidad', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(10, 5, mb_convert_encoding('Unid.', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(20, 5, mb_convert_encoding('Costo Unitario', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(15, 5, mb_convert_encoding('% Desc.', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(15, 5, mb_convert_encoding('Desc', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(10, 5, mb_convert_encoding('%I.V.A.', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(10, 5, mb_convert_encoding('I.V.A.', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
$pdf->Cell(20, 5, mb_convert_encoding('Neto', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');

$pdf->Ln(8);


$pdf->SetFont('arial','B',9);
$pdf->setXY(10,99);
$pdf->Cell(15, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(37, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(10, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(13, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(10, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(20, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(15, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(10, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(10, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Cell(20, 135, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->Ln(8);



if (isset($_POST['entrada_prods'])) {
    $productos = json_decode($_POST['entrada_prods'], true);  // Decodificar el JSON recibido
} else {
    $pdf->Cell(0,6,mb_convert_encoding("Ningun producto por salir", 'ISO-8859-1', 'UTF-8'),1,0,'C');
}
$pdf->SetFont('Arial', '', 9);

// Arrays para almacenar productos y cantidades
$productosArray = [];
$cantidadesArray = [];
foreach ($productos as $producto) {
    $pdf->SetFont('arial','',7);
    $pdf->Cell(15, 0, $producto[1], 0, 0, 'C'); // CÓDIGO
    $pdf->Cell(15, 0, ("N/P"), 0, 0, 'C'); // MODELO.
    $pdf->Cell(37, 0, $producto[3], 0, 0, 'C'); // DESCRIPCION
    $pdf->Cell(10, 0, $producto[7], 0, 0, 'C'); // ALM
    $pdf->Cell(13, 0, $producto[5], 0, 0, 'C'); // CANTIDAD
    $pdf->Cell(10, 0, $producto[5], 0, 0, 'C'); // UNIDADES
    $pdf->Cell(20, 0, $producto[4], 0, 0, 'C'); // COSTO UNITARIO
    $pdf->Cell(15, 0, ("0.00"), 0, 0, 'C'); // DESCUENTO
    $pdf->Cell(15, 0, ("0.00"), 0, 0, 'C'); // DESCUENTO
    $pdf->Cell(10, 0, ("0.00"), 0, 0, 'C'); // IVA
    $pdf->Cell(10, 0, ("0.00"), 0, 0, 'C'); // IVA
    $pdf->Cell(20, 0, $producto[6], 0, 0, 'C'); // NETO
    $pdf->Ln(3);

    // Agregar a los arrays
    $productosArray[] = $producto[2]; // Nombre del producto
    $cantidadesArray[] = $producto[5]; // Cantidad del producto
 }

$pdf->SetFont('arial','',9);
$pdf->setXY(105,250);
$pdf->Cell(95, 25, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
$pdf->setXY(105,270);
$pdf->Cell(95, 5, mb_convert_encoding('', 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');

$pdf->setXY(115,250);
$pdf->Cell(160, 5, mb_convert_encoding('Sub-total: '.$_POST['entrada_opergrab'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->setXY(120.9,254);
$pdf->Cell(160, 5, mb_convert_encoding('I.V.A: '.$_POST['entrada_igv'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->setXY(112.6,258);
$pdf->Cell(160, 5, mb_convert_encoding('Descuento: '.$_POST['entrada_cantdesc'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->setXY(115.7,262);
$pdf->Cell(160, 5, mb_convert_encoding('Recargo: 0.00', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->setXY(119.9,266);
$pdf->Cell(160, 5, mb_convert_encoding('Otros: 0.00', 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->setXY(120.9,270);
$pdf->Cell(160, 5, mb_convert_encoding('Neto: '.$_POST['entrada_total'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$numcode = date("dmHis");
$fecha = date("Y/m/d H:i:s");
$pdfPath = $_SERVER['DOCUMENT_ROOT'] . '/satvicos-master/reportes/Entrada/ENTRADA ' . $usuario ."_" . date("YmdHis")."_documento.pdf";

$pdf->Output('F', $pdfPath);
$pdf->Output('I');

// Verificar si el archivo PDF ya existe en la base de datos
$checkQuery = "SELECT COUNT(*) FROM tbl_pdf_entry WHERE path_arch = :path_arch";
$stmtCheck = $pdo->prepare($checkQuery);
$stmtCheck->bindParam(':path_arch', $pdfPath);
$stmtCheck->execute();
$count = $stmtCheck->fetchColumn();

if ($count == 0) {
    // Convertir los arrays en cadenas separadas por comas
    $productosStr = implode(', ', $productosArray);
    $cantidadesStr = implode(', ', $cantidadesArray);

    // Almacenar información en la base de datos
    $insertQuery = "INSERT INTO tbl_pdf_entry (id_report, name_user, path_arch, report_products, report_cant) VALUES (:id_report, :name_user, :path_arch, :report_products, :report_cant)";
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
