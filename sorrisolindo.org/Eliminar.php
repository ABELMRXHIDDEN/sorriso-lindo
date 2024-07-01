<?php
declare(strict_types=1);
use Dompdf\Dompdf;
include "inc/Dbh.php";
require "inc/Paciente.php";
include_once 'conexão.php';
require "inc/Fatura.php";
session_start();
if(isset($_POST['eliminar'])) {
    $id = filter_input(INPUT_POST, 'Id');
//Pesquisar no banco de dados nome do paciente referente a palavra digitada
    $sql = "delete from paciente where Id=$id ";
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
        echo "
    <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Sucesso!</h2>
    <p>Paciente Removido da Base de Dados </p>

    
       ";
    }

}
if (isset($_POST['act'])) {
    $nome=$_POST['Nome'];
    $id=$_POST['Id'];
    $dataNascimento=$_POST['dataNascimento'];
    $sexo=$_POST['sexo'];
    $tel=$_POST['tel'];
    $bi=$_POST['BI'];
    $servico=$_POST['servico'];
    $morada=$_POST['morada'];
    $dataMarcacao=$_POST['datamarcacao'];
    $hora=$_POST['hora'];
    $user=$_POST['Id_user'];

    $pacientes=new Paciente($nome,$bi,$dataNascimento,$sexo,$tel,$dataMarcacao,$morada,$hora,$servico,$user);
    if (empty($nome) or empty($id) or empty($dataNascimento) or empty($sexo) or empty($tel) or empty($servico) or empty($morada)){
        echo "
    <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Erro!</h2>
    <p>Preencha todos Campos</p>
    ";
    }else {
        try {
            if (Paciente::updatePaciente($nome, $id, $dataNascimento, $sexo, $tel, $dataMarcacao, $morada, $hora, $servico)) {
                echo "
    <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Sucesso!</h2>
    <p>Dados do pacinte: $nome foram actualizados com sucesso!</p>
  
    
       ";

            }
        }
        catch (PDOException $e){
            echo "
    <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Erro!</h2>
    <p>Tipo de Erro: $e</p>

    
       ";
        }
    }

}
if (isset($_POST['cad'])) {
    $nome=$_POST['Nome'];
    $bi=$_POST['Nbi'];
    $dataNascimento=$_POST['dataNascimento'];
    $sexo=$_POST['sexo'];
    $tel=$_POST['tel'];
    $servico=$_POST['servico'];
    $morada=$_POST['morada'];
    $dataMarcacao=$_POST['datamarcacao'];
    $hora=$_POST['hora'];
    $user=$_POST['id_user'];
    $total=$_POST['Total'];
  $totalnum=$total;
    if (empty($nome) or empty($bi) or empty($dataNascimento) or empty($sexo) or empty($tel) or empty($servico) or empty($morada) or empty($total)){
        echo "
    <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Erro!</h2>
    <p>Preencha todos Campos</p>
    ";
    }else {

        try {
           $paciente = new Paciente($nome,$bi,$dataNascimento,$sexo,$tel,$dataMarcacao,$morada,$hora,$servico,$user);
            if ($paciente->addPaciente()){
                echo "
    <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Sucesso!</h2>
    <p>Paciente Cadastrado Com Exito!</p>

   
    
       ";


            }
            try {

                $fatura=uniqid($nome);
                $caminho="fatura/arquivos/fatura_$fatura.pdf";
                $obfactura=new Fatura($caminho,$bi,$user,$total);
                try {
                    if($obfactura->salvarFactura()){
                        echo "<p>Fatura Salva no servidor</p>";
                    }
                    else {
                        echo "<p>Erro Fatura Não foi Salva</p>";
                    }
                }catch (PDOException $e){
                    echo "ERRO".$e->getMessage();
                }

                file_put_contents(__DIR__."/fatura/arquivos/fatura_$fatura.pdf", $paciente->criarFactura($total));
                echo "<a target='_blank' href='$caminho' class='btn-primary btn'>Abrir Factura</a>";
            }catch (ErrorException $e){
                echo "ERRO".$e->getMessage();
            }
            }


        catch (PDOException $e){
            echo "
    <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Erro!</h2>
    <p>Tipo de Erro: $e</p>

    
       ";
        } catch (\Dompdf\Exception $e) {
            echo "ERRO! ".$e->getMessage();
        }
    }

}
if (isset($_POST['Fatura'])){
  $fatura = new Dompdf();
  $fatura->loadHtml('
  <b>Abel Pedro</b>
  ');
  $fatura->setPaper('A4','portrait');
  $fatura->render();
header('Content-type: application/pdf');
  $fatura->stream();
}

