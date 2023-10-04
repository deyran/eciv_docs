<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
</head>
<body style="font-family: 'Courier New', Courier, monospace;">
    <h1 style="text-align: center;">Recibo de pagamento</h1><?php

    include("../model/DataBase.php");
    include("../model/DataTrat.php");

    $DataTratObj = new DataTrat(); 

    $Turmas = array("Jardim 1", "Jardim 2", "1º ANO", "2º ANO", "3º ANO", "4º ANO",
                    "5º ANO", "6º ANO", "7º ANO", "8º ANO", "9º ANO", "1º ANO MÉDIO", 
                    "2º ANO MÉDIO", "3º ANO MÉDIO"); 
                    
    $Turma = "";
    if(isset($_POST["Turma"])) $Turma = $_POST["Turma"];

    $selectedTurma = "";

    $selected = "";
    if($Turma == "") $selected = "selected";?>

    <form method="post">
        <table border="0" align="center" >
        <tr><td>
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
        </td><td><?php
            if($Turma != "")
            {
                $SQL_QUERY = "
                SELECT R.Responsavel
                FROM respvalor AS R
                WHERE R.TURMA='$Turma'
                ORDER BY R.Responsavel;";
                
                $DataBaseObj = new DataBase(); 
                $DataBaseObj->connection_bd();

                $RESULT_DB    = $DataBaseObj->getConnecation()->query($SQL_QUERY);
                $NUM_LINES_DB = mysqli_affected_rows($DataBaseObj->getConnecation());

                if($NUM_LINES_DB > 0) 
                {
                    while($DADOS_ROW = mysqli_fetch_array($RESULT_DB, MYSQLI_NUM))
                    {
                        echo $DADOS_ROW[0] ."<br />";
                    }    
                }
                
            }?>
        </td></tr>
        <tr><td rowspan="2" align="center">
            <input type="submit" value="Ok">
        </td></tr>
        </table>
    </form><?php 

   /* $SQL_QUERY = "
    SELECT R.* 
    FROM recibolivro as R  ";

    $DataBaseObj = new DataBase(); 
    $DataBaseObj->connection_bd();
    
    $RESULT_DB    = $DataBaseObj->getConnecation()->query($SQL_QUERY);
    $NUM_LINES_DB = mysqli_affected_rows($DataBaseObj->getConnecation());
    
    if($NUM_LINES_DB > 0) 
    {
        while($DADOS_ROW = mysqli_fetch_array($RESULT_DB, MYSQLI_NUM))
        {
            echo $DADOS_ROW[0] 
                ." - " .$DADOS_ROW[1] 
                ." - " .$DADOS_ROW[2] 
                ." - " .$DADOS_ROW[3] 
                ." - " .$DADOS_ROW[4]
                ."<br />";
        }    
    }*/?>
</body>
</html>