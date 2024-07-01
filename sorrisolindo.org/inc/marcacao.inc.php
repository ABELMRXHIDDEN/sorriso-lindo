<?php
declare(strict_types=1);
session_start();
require_once 'Paciente.php';
if (isset($_POST['bt-enviar'])) {

    $nome = strtoupper($_POST['Nome']);
    $BI = $_POST['BI'];
    $data_nas = $_POST['Data_nas'];
    $sexo = $_POST['sexo'];
    $tel = $_POST['tel'];
    $marc = $_POST['marcacao'];
    $morada = strtoupper($_POST['morada']);
    $hora = $_POST['hora'];
    $servico = $_POST['servico'];
    $idUser= $id=$_SESSION['id'];

    try {
        $paciente = new Paciente($nome,$BI,$data_nas,$sexo,$tel,$marc,$morada,$hora,$servico,$idUser);
      if($paciente->addPaciente()){

          header("Location: ../marcacao?Sucesso=1");


      }
      else {


      }
    }catch (Error $e){
        echo "Erro! ".$e->getMessage();

    }



} 
