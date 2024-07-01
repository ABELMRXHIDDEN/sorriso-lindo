<?php
declare(strict_types=1);
require_once 'Dbh.php';
class Funcionario extends Dbh
{
    public static function add($iduser,$nome, $nbi, $sexo, $tel, $endereco, $dataNascimento,$cargo,$salario)
    {
            try {
                $stm = (new Funcionario())->connect()->query("insert into funcionario values (0,'$iduser','$nome', '$nbi', '$dataNascimento','$cargo','$salario' ,curdate(),'$tel','$endereco','$sexo')");
                return true;
            } catch (PDOException $erro) {
                echo 'Erro ' . $erro->getMessage();
            }

    }

}