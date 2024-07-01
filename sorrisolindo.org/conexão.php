<?php
require_once 'vendor/autoload.php';


$servidor = "localhost";
$usuario="root";
$senha="";
$dbname="sorrisolindo2";

$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);

if (!$conexao){
    die("Não foi possivel estabelecer a Ligação".mysqli_error());
}


