<html><head>
	<title>Documentos finaneiro</title>
	
</head><body style="margin: 0px; padding: 0px"><?php
	include("model\Pessoa.php");
	
	
	$PessoaObj = new Pessoa();
	//$PessoaObj->setIdPes("0, 1, 10, 50, 100");
	$Result = $PessoaObj->selectPessoa();

	foreach($Result as $Pessoas)
		echo $Pessoas[0] . " - " . $Pessoas[1] . "<br />";
	
?>
	
</body></hmtl>