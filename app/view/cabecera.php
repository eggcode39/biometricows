<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 05/12/2019
 * Time: 18:19
 */
require 'app/models/fpdf.php';
class PDFF extends FPDF{
    function Header(){
        $this->Image('media/calendar.png',11,7,21);
        $this->SetFont('Arial','B',10);
        $this->Cell(30);
        $this->SetFont('Arial','B',12);
        $this->Cell(200,10,'Control de Asistencia',0,0,'C');
        $this->Ln();
    }
    function Footer(){
        $fecha=date('Y-m-d H:i:s');
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(90,10,'Reporte generado el: '.$fecha,0,0,'L');
        $this->Cell(20,10,'Pagina ' . $this->PageNo().'/{nb}',0,0,'C');
    }
}
?>