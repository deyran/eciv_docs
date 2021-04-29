<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'eciv_docs_bd');

$CONNECTION =new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";", USER, PASS);

$assunto = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);

$SQL_QUERY ="SELECT P.* FROM PESSOA AS P WHERE P.DESCRICAO = '%$assunto%' LIMIT 7";

$RESULT = $CONNECTION->prepare($SQL_QUERY);
$RESULT->execute();

$DATA = [];

while($ROW = $RESULT->fetch(PDO::FETCH_ASSOC))
{
	$DATA[] = $ROW["DESCRICAO"];
}

echo json_encode($DATA);
?>