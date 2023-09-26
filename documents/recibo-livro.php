<?php 
include("../model/DataBase.php");
include("../Include/fpdf186/fpdf.php");

$DataBaseObj = new DataBase(); 

$pdf = new FPDF("P", "mm", "A4");
$pdf->AddPage();

//------------------------------------------------------------
$pdf->Image('img/logo.jpg', 90, 2.1, 28.5, 30);

//------------------------------------------------------------
$Title = $DataBaseObj->encoding("RECIBO DE ENTREGA DE LIVRO 4º BIMESTRE");

$pdf->SetXY(52, 33);
$pdf->SetFont("Courier", "", 12);
$pdf->Cell(40,10, $Title);

//------------------------------------------------------------



//------------------------------------------------------------
$pdf->Output();
?>