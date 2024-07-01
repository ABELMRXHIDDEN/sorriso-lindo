<?php

require_once '../classes/Usuario.php';
session_start();

$dados= $_POST;

$email=$dados['Email'];
$senha=$dados['Senha'];

if (Usuario::loginPesquisarUsuario($email)){
    $logar=Usuario::Logar($email,$senha);
if(isset($logar[0])){

    $_SESSION[$logar[1]]=true;
    $_SESSION['Id_user']=$logar[2];

    echo  json_encode(array(true,'Redirecionando Para o Aplicativo',$logar[1]));
}
else{
    echo  json_encode("Senha Incorrecta");
}
}
else{


    echo  json_encode("Usuario Não Existe");
}
if (isset($dados['Logout'])){
    session_unset();
    session_destroy();
}




