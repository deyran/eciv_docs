<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de pagamento</title>
</head>
<body style="font-family: 'Courier New', Courier, monospace;"><?php
    include("../model/DataBase.php");
    include("../model/DataTrat.php");

    $DataTratObj = new DataTrat(); 

    $Turmas = array("Jardim 1", "Jardim 2", "1º ANO", "2º ANO", "3º ANO", "4º ANO",
                    "5º ANO", "6º ANO", "7º ANO", "8º ANO", "9º ANO", "1º ANO MÉDIO", 
                    "2º ANO MÉDIO", "3º ANO MÉDIO"); 
                    
    $Turma = "";
    $Responsavel = "";
    $Aluno = "";
    $Valor = "";
    $Parcelas = "";

    if(isset($_POST["Turma"])) $Turma = $_POST["Turma"];
    if(isset($_POST["Responsavel"])) $Responsavel = $_POST["Responsavel"];

    if(isset($_POST["Parcelas"])) 
    {
        $Parcelas = array_unique($_POST["Parcelas"]);
        $Parcelas = implode(", ",$Parcelas);
    }
    
    $selectedTurma = "";
    $selectedResp = "";

    $selected = "";
    if($Turma == "") $selected = "selected";?>

    <form method="post" id="frmReportPag">         
    <!--onchange="document.getElementById('frmReportPag').submit()"-->
        <div align="center">
            <input type="submit" value="  Ok  ">
        </div><br />

        <table border="0" align="center">
        <tr><td valign="top">
            Turma<br />
            <select name="Turma">
                <option <?php echo $selected;?>></option><?php
                for ($i = 0; $i < count($Turmas); $i++) 
                {
                    $TurmaAux = $DataTratObj->encoding($Turmas[$i]);

                    if($Turma == $TurmaAux) $selectedTurma = "selected";?>

                    <option value="<?php echo $DataTratObj->encoding($Turmas[$i]);?>"
                        <?php echo $selectedTurma;?>>
                        <?php echo $TurmaAux;?>
                    </option><?php

                    $selectedTurma = "";
                }?>
            </select>
        </td><td valign="top">
            Responsavel <br />
            <select name="Responsavel" style="width: 200px;"><?php
                if($Turma != "")
                {
                    $SQL_QUERY_AUX = "";
                    if($Responsavel != "") 
                    {
                        $SQL_QUERY_AUX = 
                        " AND R.Responsavel='$Responsavel'";
                    }
                    
                    $SQL_QUERY = "
                    SELECT R.Responsavel, R.Aluno, R.Valor
                    FROM respvalor AS R
                    WHERE R.TURMA='$Turma'
                    $SQL_QUERY_AUX
                    ORDER BY R.Responsavel;";

                // echo $SQL_QUERY;

                    $DataBaseObj = new DataBase(); 
                    $DataBaseObj->connection_bd();

                    $RESULT_DB    = $DataBaseObj->getConnecation()->query($SQL_QUERY);
                    $NUM_LINES_DB = mysqli_affected_rows($DataBaseObj->getConnecation());

                    if($NUM_LINES_DB > 0) 
                    {
                        while($DADOS_ROW = mysqli_fetch_array($RESULT_DB, MYSQLI_NUM))
                        {
                            $Aluno = $DADOS_ROW[1];
                            $Valor = $DADOS_ROW[2];?>
                            <option value="<?php echo $DADOS_ROW[0];?>"><?php
                                echo $DADOS_ROW[0];?>
                            </option><?php
                        }
                    }
                }?>
            </select>
        </td><?php 
            if($Responsavel != "")
            {?>
                <td valign="top">
                    Aluno(a)<br />
                    <input type="text" readonly value="<?php echo $Aluno;?>" />
                </td>
                
                
                <?php
            }?>
        </tr><?php 

        if($Responsavel != "")
        {?>
            <tr>
            <td valign="top">
                Parcela(a)<br /><?php 
                $meses = 
                array("Janeiro", "Fevereiro", "Março", "Abril", 
                        "Maio","Junho",  "Julho", "Agosto", 
                        "Setembro", "Outubro", "Novembro", "Dezembro");
                        
                for ($i = 0; $i < count($meses); $i++) {
                    $Parcela = $DataTratObj->encoding($meses[$i]);?>
                    <div>
                        <input type="checkbox" 
                            id="checkbox" name="Parcelas[]" 
                            value="<?php echo $Parcela;?>">&nbsp;<?php echo $Parcela;?>
                    </div><?php
                }?>
            </td><td valign="top">
                Valor(a)<br />
                <input type="text" value="<?php echo $Valor;?>" />
            </td><td>&nbsp;</td>
            </tr><?php
        }?>
        </table><br />
    </form>
</body>
</html>