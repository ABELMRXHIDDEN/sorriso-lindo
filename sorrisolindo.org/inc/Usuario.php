<?php
require_once 'Dbh.php';
class Usuario extends Dbh
{
 protected string $email;
 protected string $password;

 public static function usuarioExiste($email){
     $stm = (new Usuario)->connect()->query("select * from usuario where Email='$email'");
     if ($stm->rowCount()>0){
         return true;
     }
     else{
         return false;
     }

 }
public static function Logar($email,$senha)
{
    $db_email = "";
    $db_pwd = "";
    $id="";
    $db_cargo="";
    $stm = (new Usuario)->connect()->query("select * from usuario where Email='$email' and Senha='$senha'");
    while ($dados = $stm->fetch()) {
        $db_email = $dados['Email'];
        $db_pwd = $dados['Senha'];
        $db_cargo = $dados['Cargo'];
        $id=$dados['ID'];
    }
    if ($senha == $db_pwd and $email == $db_email) {
        return array(true,$db_cargo,$id);
    } else {
        return false;
    }


}
}