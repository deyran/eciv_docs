<?php
	include("model\Pessoa.php");
    
    $PessoaObj      = new Pessoa();
    $ResponseJson = $PessoaObj->selectPessoaJson();

    /*echo "<pre>";
	print_r($ResponseJson);
    echo "</pre>";*/

    echo json_encode($ResponseJson);

    exit;
?>