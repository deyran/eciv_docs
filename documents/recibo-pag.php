<?php
include("../model/DataTrat.php");
include("../Include/fpdf186/fpdf.php");
//------------------------------------------------

$DataTratObj = new DataTrat(); 
//------------------------------------------------

$pdf = new FPDF("P", "mm", "A4");
$pdf->AddPage();
//------------------------------------------------

$pdf->Image("img/logo.jpg", 90, 2.1, 28.5, 30);
//------------------------------------------------

// Protocolo
$pdf->SetXY(91, 35);
$pdf->SetFont("Courier", "", 12);
$pdf->Write(1, "Protocolo");
//------------------------------------------------

//Número protocolo
$NumProtocolo = $DataTratObj->SequenceRandom();
$pdf->SetXY(50, 40);
$pdf->SetFont("Courier", "", 12);
$pdf->Write(1, $NumProtocolo);
//------------------------------------------------

$NomePagador = strtoupper("Jose Nazareno Brito Dos Santos");
$NomeAluno =  strtoupper("Ana Beatriz Lobo dos Santos (7º Ano)");
$PgMens = "da(s) parcela(s) de Maio";
$PgValor = $DataTratObj->ValorPorExt(320.00);
$MensAdd = " Via Pix (E31872495202309271407J3Ylx6uagWO), dia 27-09-23,";

$Text = 
"\t\t\t\t\t\t\t\tPor meio deste documento, RATIFICO que o Sr(A). $NomePagador realizou o pagamento total $PgMens, no valor $PgValor,$MensAdd referente a prestação de serviço escolar do(s) aluno(a)(s) $NomeAluno.";

$Text = $DataTratObj->encoding($Text);

$pdf->SetXY(10, 47);
$pdf->SetFont("Courier", "", 12);
$pdf->MultiCell(0, 7, $Text, 0);
//------------------------------------------------

$pdf->SetXY(111, 86);
$pdf->SetFont("Courier", "", 12);
$pdf->Write(1, $DataTratObj->returnDataExt());
//------------------------------------------------

$Assinatura = "
___________________________________\n
\t\tDEYVID RANNYERE DE MORAES COSTA\n
\t\t\t\t\t\tDEPARTAMENTO FINANCEIRO";

$pdf->SetXY(60, 94);
$pdf->SetFont("Courier", "", 12);
$pdf->MultiCell(0, 3, $Assinatura,0);
//------------------------------------------------

$pdf->Image("img/AssinaturaDeyvid.png", 65, 92, 80, 10);
//------------------------------------------------

$pdf->Output(); 
?>