<?php 
include("../Include/fpdf186/fpdf.php");

$pdf = new FPDF('P', 'mm', "A4");
$pdf->AddPage();

$pdf->Image('img/logo.jpg', 90, 6, 30, 30);

$pdf->Output();
?>