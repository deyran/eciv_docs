<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'eciv_docs_bd');

$conn =new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . ";", USER, PASS);
?>