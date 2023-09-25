<!DOCTYPE html>
<html lang="en">
<head><?php
	include("../model/DataBase.php");?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
</head>
<body><?php 
    $SQL_QUERY = "
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
    }?>
</body>
</html>