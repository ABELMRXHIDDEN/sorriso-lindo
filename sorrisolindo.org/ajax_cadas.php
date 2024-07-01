<?php
require_once "vendor/autoload.php";
require_once "inc/Fatura.php";
require_once "conexão.php";
 if (isset($_POST['Cadastrar'])){
    $nome=$_POST['Nome'];
    $bi=$_POST['BI'];
    $email=$_POST['Email'];
    $datanas=$_POST['DataNascimento'];
    $tel=$_POST['Tel'];
    $morada=$_POST['Morada'];
    $sexo=$_POST['Sexo'];
    $datamar=$_POST['DataMarcacao'];
    $horamar=$_POST['Hora'];
    $servico=$_POST['Servico'];
    $Dentista=$_POST['Denstista'];
    $total=$_POST['Total'];


    if($conexao->query("insert into paciente values(0,'$nome','$bi','$tel','$sexo','$datanas','$email','$morada')")){

       $stm=$conexao->query("select idPaciente from paciente where numeroDoBilhete='$bi'");
       if ($stm) {
           $info = mysqli_fetch_assoc($stm);
           $id = $info['idPaciente'];
           $conexao->query("insert into agendamentodeconsulta values (0,'$id','$Dentista','$datamar','$horamar','$servico',' ',default)");

           $factura=new Fatura();
           $fac=$factura->emitirFactura($nome,$bi,$email,$datanas,$tel,$morada,$sexo,$datamar,$horamar,$servico,$Dentista,$total);
           $novoNome=$nome.uniqid($nome).".pdf";
           $caminho="/fatura/arquivos/factura_".$novoNome;

           file_put_contents(__DIR__.".$caminho",$fac);

           if($factura->salvarFactura($id,$Dentista,$total,$caminho)){
               $caminho=json_encode($caminho);
               echo $caminho;
           }

       }
    }

}
 if (isset($_POST['Pesquisar'])){
     $bi=$_POST['NBI'];
     $stm=$conexao->query("select * from paciente where numeroDoBilhete='$bi'");

     if($stm->num_rows!=0){
         $dados['Paciente']=mysqli_fetch_assoc($stm);
         $id=$dados['Paciente']['idPaciente'];
        $stm2 =$conexao->query("select caminho from fatura where Paciente_ID='$id'");
        $dados['Fatura']=mysqli_fetch_assoc($stm2);
         $stm3 =$conexao->query("select * from agendamentodeconsulta where Paciente_ID ='$id'");
         $dados['Marcacao']=mysqli_fetch_assoc($stm3);

         $dados=json_encode($dados);
         echo $dados;
     }
     else{
         echo json_encode(false);
     }

 }
 if (isset($_POST['Eliminar'])){
    $bi=$_POST['NBI'];
    $stm=$conexao->query("select idPaciente from paciente where numeroDoBilhete='$bi'");
    $dados=mysqli_fetch_assoc($stm);
    $id=$dados['idPaciente'];
    $conexao->query("SET FOREIGN_KEY_CHECKS=0;");
    $conexao->query("delete from paciente where idPaciente='$id'");
    $conexao->query("SET FOREIGN_KEY_CHECKS=1;");
    $conexao->query("delete from agendamentodeconsulta where Paciente_ID='$id'");
 }
