<?php
declare(strict_types=1);
require_once 'Dbh.php';
class Paciente extends Dbh
{
    public static function cadastrarPaciente($nome, $nbi, $sexo, $tel, $endereco, $email, $dataNascimento)
    {
        if (self::verificarBi($nbi)) {
            try {
                $stm = (new Paciente())->connect()->query("insert into paciente values (0,'$nome', '$nbi', '$dataNascimento', '$email', '$tel', '$sexo', '$endereco',curdate())");
                return true;
            } catch (PDOException $erro) {
                echo 'Erro ' . $erro->getMessage();
            }
        } else {
            return false;
        }

    }


    public static function actualizarPaciente($nome, $nbi, $sexo, $tel, $endereco, $email, $dataNascimento)
    {

        try {
            $id=self::acharId($nbi);
            $stm = (new Paciente())->connect()->query("UPDATE `sorrisolindo`.`paciente` SET `nomeCompleto` = '$nome', `dataNascimento` = '$dataNascimento', `email` = '$email', `numeroTelefone` = '$tel',`numeroBilhete`='$nbi' ,`genero` = '$sexo', `endereco` = '$endereco' WHERE (`idpaciente` = '$id');");
            return true;
        } catch (PDOException $erro) {
            echo 'Erro ' . $erro->getMessage();
        }
    }

    public static function listarPacientes(){
    $stm=(new Paciente())->connect()->query('select * from paciente order by nomeCompleto');
    $i=0;
    $info=array();
    while($dados=$stm->fetch()){
        $info[$i]=$dados;
        $i++;
    }
        return $info;
    }
    public static function filtrarPaciente($nbi){
        $stm=(new Paciente())->connect()->query("select * from paciente where numeroBilhete='$nbi'");
        return $stm->fetch();
    }
    public static function eliminarPaciente($nbi){
        $stm=(new Paciente())->connect()->query("set foreign_key_checks=0;delete from paciente where numeroBilhete='$nbi'");
        return $stm;
    }
    public static function verificarBi($nbi){
        $stm=(new Paciente())->connect()->query("select * from paciente where numeroBilhete='$nbi'");
        if ($stm->rowCount()==0){
            return true;
        }
        else{
            return false;
        }
    }
    public static function acharId($nbi){
        $stm=(new Paciente())->connect()->query("select idpaciente from paciente where numeroBilhete='$nbi'");


    return $stm->fetch()['idpaciente'];

    }
    public static function totalPaciente(){
        $stm=(new Paciente())->connect()->query("select idpaciente from paciente");

        return $stm->rowCount();
    }

    public static function pesquisarPaciente($pesquisa)
    {
        $stm = (new Paciente())->connect()->query("select * from paciente where nomeCompleto  like '%$pesquisa%' or numeroBilhete like '%$pesquisa%'order by nomeCompleto");
        $i = 0;
        $info = array();
        while ($dados = $stm->fetch()) {
            $info[$i] = $dados;
            $i++;
        }
        return $info;
    }
       public static function questoes($idPaciente,$pergunta,$resposta){
          $stm=(new Paciente())->connect()->query("SET FOREIGN_KEY_CHECKS=0");
          $stm=(new Paciente())->connect()->query(" insert into informacoes_adicionais values (0,'$idPaciente','$pergunta','$resposta')");
         return $stm;
        }
    public static function actualizarquestoes($idPaciente,$qt1,$qt2,$qt3,$qt4,$qt5,$qt6,$qt7){
        $stm=(new Paciente())->connect()->query("UPDATE `sorrisolindo`.`informacoes_adicionais` SET `qt1` = '$qt1', `qt2` = '$qt2', `qt3`='$qt3',`qt4` = '$qt4', `qt5` = '$qt5', `qt6` = '$qt6', `qt7` = '$qt7' WHERE (`ID_paciente` = '$idPaciente');)");
        return $stm;
    }

}

