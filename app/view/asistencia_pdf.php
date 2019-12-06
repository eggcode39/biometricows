<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 05/12/2019
 * Time: 18:55
 */
$pdf = new PDFF();
$pdf->AliasNbPages();
$pdf->AddPage('P');

$pdf->AddFont('helveticab');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,'Listado de Registros Dia:' . $_POST['fecha'] ,0,1,'C');
$pdf->Ln();

foreach ($docentes as $d){
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,10,'Turno :' . $d->cTurno ,0,1,'L');
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(100,6,'Nombre : ' . $d->cNombres . ' ' . $d->cApellidos,0,1,'L',0);
    $pdf->Cell(100,6,'DNI : ' . $d->cDNI,0,1,'L',0);
    $pdf->Cell(100,6,'Hora : ' . $d->dHora,0,1,'L',0);
    $pdf->Ln();
}

$pdf->Output();