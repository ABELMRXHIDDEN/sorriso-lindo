<?php
session_start();
require_once 'inc/Dbh.php';
require_once 'inc/Usuario.php';
$email=$_POST['Email'];
$pwd=$_POST['Senha'];
$stm=Usuario::usuarioExiste($email);

if ($stm) {
    $login = Usuario::Logar($email, $pwd);
if (isset($login[0])){
$_SESSION[$login[1]]=true;
$_SESSION['Id_user']=$login[2];
}
else {
    echo 'Senha Incorrecta';
}
}
else{
    echo "Usuário Não Existe";
}