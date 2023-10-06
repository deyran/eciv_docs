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

/*
MODELO 1--------------------------------------------------*/
$NomePagador = strtoupper("WELLINGTON NUNES MAIA");
$NomeAluno =  strtoupper("Ana Luiza Sarmento Maia (2º Ano), Laura Rafaela Sarmento Maia (6º Ano) e Wallaxe Davi Sarmento Barbosa (1º Ano médio)");
$PgMens = "da(s) parcela(s) de Agosto";
$PgValor = "1,080.33 (Mil e Oitenta Reais e Trinta e Três Centavos)"; 
//$DataTratObj->ValorPorExt(700.00);
$MensAdd = "CREDITO (873984), dia 15-09-23";
//"Via Pix (E08561701202310021824XIKSGE2E56T), dia 02-10-12,";

$Text = 
"\t\t\t\t\t\t\t\tPor meio deste documento, RATIFICO que o Sr(A). $NomePagador realizou o pagamento total $PgMens, no valor $PgValor, $MensAdd referente a prestação de serviço escolar do(s) aluno(a)(s) $NomeAluno.";

/*
MODELO 2--------------------------------------------------

$NomePagador = strtoupper("Delcio Bandeira Laune");
$NomeAluno =  strtoupper("Danilo De Souza Louné (2º Ano médio)");
$PgMens = "na quantia " . $DataTratObj->ValorPorExt(450.00);
$MensAdd = "como pagamento parcial do débito que totaliza " 
           . "R$ 1,690.50 (Mil e Seiscentos e Noventa Reais e Cinquenta Centavos)"
           . ", restanto R$ 1,240.50 (Mil e Duzentos e Quarenta Reais e Cinquenta Centavos)";
$Text = 
"\t\t\t\t\t\t\t\tPor meio deste documento, RATIFICO que o Sr(A). $NomePagador realizou o pagamento $PgMens, $MensAdd referente a prestação de serviço escolar do(s) aluno(a)(s) $NomeAluno.";*/

$Text = $DataTratObj->encoding($Text);

$pdf->SetXY(10, 47);
$pdf->SetFont("Courier", "", 12);
$pdf->MultiCell(0, 7, $Text, 0);
//------------------------------------------------

$pdf->SetXY(111, 96);
$pdf->SetFont("Courier", "", 12);
$pdf->Write(1, $DataTratObj->returnDataExt());
//------------------------------------------------

$Assinatura = "
___________________________________\n
\t\tDEYVID RANNYERE DE MORAES COSTA\n
\t\t\t\t\t\tDEPARTAMENTO FINANCEIRO";

$pdf->SetXY(60, 104);
$pdf->SetFont("Courier", "", 12);
$pdf->MultiCell(0, 3, $Assinatura,0);
//------------------------------------------------

$pdf->Image("img/AssinaturaDeyvid.png", 65, 102, 80, 10);
//------------------------------------------------

$pdf->Output(); 
?>