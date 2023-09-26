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

$pdf->SetXY(52, 39);
$pdf->SetFont("Courier", "", 12);
$pdf->Write(1, $Title);

//------------------------------------------------------------
$_ALUNO = strtoupper("Pedro Rodrigues De Brito Neto");
$_TURMA = strtoupper("3 Ano Medio");
$_LIVRO = strtoupper("Kit Medio 3 Ano Vortex");
$_RESPONSAVEL = strtoupper("Catarina De Sena Monteiro Nunes");

$Text = 
"\t\t\t\t\t\t\t\tEu, _ALUNO_, matriculado na turma _TURMA_, declaro que recebi o livro _LIVRO_, que foi adquirido pelo  Sr(a). _RESPONSAVEL_. Reconheço que o produto foi entregue emperfeitas condições de uso, sem defeitos ou avarias, e que recebi todas as orientações e informações necessárias sobre o mesmo. Assumo, a partir desta data, a total responsabilidade pelo produto.";

$Text = str_replace("_ALUNO_", $_ALUNO, $Text);
$Text = str_replace("_TURMA_", $_TURMA, $Text);
$Text = str_replace("_LIVRO_", $_LIVRO, $Text);
$Text = str_replace("_RESPONSAVEL_", $_RESPONSAVEL, $Text);

$Text = $DataBaseObj->encoding($Text); 
    
$pdf->SetXY(10, 47);
$pdf->SetFont("Courier", "", 12);
$pdf->MultiCell(0, 7, $Text, 0);

//------------------------------------------------------------
$pdf->Output();
?>