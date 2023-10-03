<?php 
include("../model/DataBase.php");
include("../Include/fpdf186/fpdf.php");

$DataBaseObj = new DataBase(); 

$SQL_QUERY = "
SELECT R.* FROM recibolivro AS R WHERE R.Turma = '4 Ano'";

$DataBaseObj->connection_bd();

$RESULT_DB    = $DataBaseObj->getConnecation()->query($SQL_QUERY);
$NUM_LINES_DB = mysqli_affected_rows($DataBaseObj->getConnecation());

$_CountPerson = 0;

if($NUM_LINES_DB > 0) 
{
    $pdf = new FPDF("P", "mm", "A4");    
    while($DADOS_ROW = mysqli_fetch_array($RESULT_DB, MYSQLI_NUM))
    {
        $pdf->AddPage();
        //------------------------------------------------------------

        $pdf->Image("img/logo.jpg", 90, 2.1, 28.5, 30);
        //------------------------------------------------------------

        $Title = $DataBaseObj->encoding("RECIBO DE ENTREGA DE LIVRO 4º BIMESTRE ");
                
        $pdf->SetXY(52, 39);
        $pdf->SetFont("Courier", "", 12);
        $pdf->Write(1, $Title);
        //------------------------------------------------------------

        $_ID          = strtoupper($DADOS_ROW[0]);
        $_TURMA       = strtoupper($DADOS_ROW[1]);
        $_RESPONSAVEL = strtoupper($DADOS_ROW[2]);
        $_ALUNO       = strtoupper($DADOS_ROW[3]);
        $_LIVRO       = strtoupper($DADOS_ROW[4]);
        //------------------------------------------------------------

        $Text = 
        "\t\t\t\t\t\t\t\tEu, _ALUNO_, matriculado na turma _TURMA_, declaro que recebi _LIVRO_, que foi adquirido pelo  Sr(a). _RESPONSAVEL_. Reconheço que o produto foi entregue em perfeitas condições de uso, sem defeitos ou avarias, e que recebi todas as orientações e informações necessárias sobre o mesmo. Assumo, a partir desta data, a total responsabilidade pelo produto.";
        
        $Text = $DataBaseObj->encoding($Text); 

        $Text = str_replace("_ALUNO_", $_ALUNO, $Text);
        $Text = str_replace("_TURMA_", $_TURMA, $Text);
        $Text = str_replace("_LIVRO_", $_LIVRO, $Text);
        $Text = str_replace("_RESPONSAVEL_", $_RESPONSAVEL, $Text);
            
        $pdf->SetXY(10, 47);
        $pdf->SetFont("Courier", "", 11);
        $pdf->MultiCell(0, 7, $Text, 0);
        //------------------------------------------------------------
        
        date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo
        $data = new DateTime(); // Cria um objeto DateTime com a data atual
        $formatter = new IntlDateFormatter('pt_BR',  IntlDateFormatter::FULL,  IntlDateFormatter::NONE,  'America/Sao_Paulo', IntlDateFormatter::GREGORIAN); // Cria um objeto IntlDateFormatter com o locale, o formato da data, o formato da hora, o fuso horário e o tipo de calendário desejados
        
        $DataAtual = ucwords($DataBaseObj->encoding($formatter->format($data)));
        $DataAtual = str_replace(" De ", " de ", $DataAtual);
        
        $pdf->SetXY(109, 92);
        $pdf->SetFont("Courier", "", 11);
        $pdf->Write(1, $DataAtual);
        //------------------------------------------------------------
        
        $Assinatura1 = "________________________________________\n" .
        $_ALUNO . "\n" . $_TURMA;
        
        $pdf->SetXY(0, 99);
        $pdf->SetFont("Courier", "", 11);
        $pdf->MultiCell(0, 5, $Assinatura1, 0, "C");        
    }   

    $pdf->Output(); 
}?>