<?php

require_once 'Dbh.php';
class Usuario extends Dbh
{

    public static function loginPesquisarUsuario($email)
    {
        $stm = (new Usuario)->connect()->query("select * from usuario where email='$email'");
        if ($stm->rowCount() != 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Logar($email, $senha)
    {
        $db_email = "";
        $db_pwd = "";
        $id = "";
        $db_cargo = "";
        $db_id_func = '';
        $stm = (new Usuario)->connect()->query("select * from usuario as u join funcionario as f on u.idusuario=f.idusuario where u.email='$email'");
        while ($dados = $stm->fetch()) {
            $db_email = $dados['email'];
            $db_pwd = $dados['senha'];
            $db_cargo = $dados['cargo'];
            $db_id_func = $dados['idfuncionario'];
            $id = $dados['idusuario'];
        }
        if ($senha == $db_pwd and $email == $db_email) {
            return array(true, $db_cargo, $id, $db_id_func);
        } else {
            return false;
        }


    }

    public static function pesquisarUsuario($iduser)
    {
        $stm = (new Usuario)->connect()->query("select * from usuario as u join funcionario as f on u.idusuario=f.idusuario where u.idusuario='$iduser'");
        return $stm->fetch();
    }

    public static function actualizaruser($iduser, $nome, $nbi, $datanas, $tel, $morada, $sexo, $senha, $email, $foto)
    {
        $stm = (new Usuario)->connect()->query("UPDATE `sorrisolindo`.`funcionario` SET `nomeCompleto` = '$nome', `numeroBilhete` = '$nbi', `dataNascimento` = '$datanas',  `numeroTelefone` = '$tel', `endereco` = '$morada', `genero` = '$sexo' WHERE (`idusuario` = '$iduser');
");
        if ($stm) {
            (new Usuario())->connect()->query("UPDATE `sorrisolindo`.`usuario` SET `email` = '$email', `senha` = '$senha', `foto` = '$foto' WHERE (`idusuario` = '$iduser');
");
            return true;
        }
    }

    public static function actualizarusersf($iduser, $nome, $nbi, $datanas, $tel, $morada, $sexo, $senha, $email)
    {
        $stm = (new Usuario)->connect()->query("UPDATE `sorrisolindo`.`funcionario` SET `nomeCompleto` = '$nome', `numeroBilhete` = '$nbi', `dataNascimento` = '$datanas',  `numeroTelefone` = '$tel', `endereco` = '$morada', `genero` = '$sexo' WHERE (`idusuario` = '$iduser');
");
        if ($stm) {
            (new Usuario())->connect()->query("UPDATE `sorrisolindo`.`usuario` SET `email` = '$email', `senha` = '$senha' WHERE (`idusuario` = '$iduser');
");
            return true;
        }
    }

    public static function listarUsuario()
    {
        $stm = (new Usuario)->connect()->query("select * from usuario as u join funcionario as f on u.idusuario=f.idusuario");
        $i = 0;
        $info = array();
        while ($dados = $stm->fetch()) {
            $info[$i] = $dados;
            $i++;
        }
        return $info;
    }
    public static function inserirUsuario($email,$senha)
    {
        $stm=(new Usuario)->connect();
        if($stm->query("insert into usuario values(0,'$email','$senha','',curdate(),'')")){
            return $stm->lastInsertId();
        }
        
        
    }
}

