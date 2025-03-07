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
        $this->Image('../../img/logo.png', 5, -3, 40);
        $this->SetFont('Arial', 'B', 14);
        //$this->Cell(30);
        $this->Cell(0, 10, $this->HeaderTitle(), 0, 0, 'C');
        $fecha = date("d/m/Y - h:i:s");
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(222);
        $this->Cell(22, 10, mb_convert_encoding("Fecha y Hora: ", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', '', 9);
        $this->Cell(23, 10, mb_convert_encoding("$fecha", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
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
