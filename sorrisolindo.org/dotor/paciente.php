<?php
session_start();
$Atendente=$_SESSION['Id_user'];
$Id=$_SESSION['IdPaciente'];
require_once '../conexão.php';
if($_SESSION['relatorio']){
    $Id=$_SESSION['IdPaciente'];
}
else {
    header("Location: dashboard_marc.php");
}
if (isset($_POST['Terminar'])){
   $id=$_SESSION['IdPaciente'];
   $Examinado= $conexao->query("update agendamentodeconsulta set Examinado = true WHERE Id = '$id'");
    if($Examinado){
    $_SESSION['relatorio']=false;
    header("Location: dashboard_marc.php");
    }
    else {
        echo "Erro!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/boostrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/ajax/estilo.css">
    <script lang="javascript" src="../jquery.min.js"></script>
    <script lang="javascript" src="../js/script.js"></script>
    <script src="../js/animacao.js"></script>
    <script src="js/view_2.0.1.js"></script>
    <title>Relatorio Médico</title>
    <style>

    </style>
</head>
<body>


<div id="interface">
    <main>

        <div style="width: 99%">

            <?php
            $pacientes=$conexao->query("select a.dataDaConsulta, a.horaDaConsulta, p.nomeCompleto,p.numeroDoBilhete,
 p.Sexo,a.Examinado,pr.nomeProcedimento,p.dataDeNascimento,p.numeroDeTelefone
 from  agendamentodeconsulta as a join paciente as p on a.Paciente_ID=p.idPaciente join procedimento as pr on a.Procedimento_ID=pr.ID where a.Paciente_ID='$Id'");
            $Nome ="";
            $NBI = "";
            $Genero = "";
            $N_Tel = "";
            $Servico = "";
            $Data_Nascimento = "";
            $Hora ="";
            $Data_Marcacao = "";
            while ($dados = mysqli_fetch_assoc($pacientes)) {

                $Nome = $dados['nomeCompleto'];
                $NBI = $dados['numeroDoBilhete'];
                $Genero = $dados['Sexo'];
                $N_Tel = $dados['numeroDeTelefone'];
                $Servico = $dados['nomeProcedimento'];
                $Data_Nascimento = $dados['dataDeNascimento'];
                $Hora = $dados['horaDaConsulta'];
                $Data_Marcacao = $dados['dataDaConsulta'];
            }
            echo "
<div class='inforPAciente'>
           <h4> $Nome</h4>
           <h4>Serviço: $Servico</h4>
           <h4>$Genero</h4>
           <h4> $Data_Nascimento</h4>
</div>           
           ";
           ?>
            <h6><input type="checkbox" id="rel">Informações Sobre Consultas Passadas</h6>
            <div id="col_Relatorio">
            <div id="gridres">


               <?php
               $res = $conexao->query("select p.nomeCompleto,d.Nome,
 p.Sexo,pr.nomeProcedimento,r.Obs,r.dataRelatorio,r.horaRelatorio
 from  relatorio as r join paciente as p on r.Paciente_ID=p.idPaciente join procedimento as pr on r.procedimento_ID=pr.ID 
 join dentista as d on r.Dentista_ID=d.ID where idPaciente='$Id'");
               while($infor=mysqli_fetch_assoc($res)) {
                   if ($res->num_rows != 0) {
                       $servico=$infor['nomeProcedimento'];
                       $datarel=$infor['dataRelatorio'];
                       $hora=$infor['horaRelatorio'];
                       $obs=$infor['Obs'];

                       echo "
                       <div class='relatorio'>
                       <h5>Serviço: $servico</h5>
                       <h5>$datarel $hora</h5>
                      
                       <hr>
                       
                       <p>$obs</p>
                       
                       </div>
                       ";
                   } else {

                   }
               }

               ?>
            </div>
           </div>
           <form method="post" action="../relatorio.php">
           <div class='w-100' style='display: block; margin: auto'>

          
           <div class="form-floating">
               <textarea rows="30" class='form-control w-100' placeholder='Relatorio' required name='Relatorio' id='relatorio'></textarea>
           <label for='relatorio'>Escreva as Observações acerca da Saúde Bocal do Paciente</label>
           </div>
           </div>
               <h6><input type="checkbox" id="rec">Emitir Receita</h6>
               <div id="col_rec">

           <div class='form-floating w-25'>
              <input  type='text' class='form-control w-100 form-text' placeholder='Receita'  id='qtdmed' name="qtd">
           <label for=''>Qtd Medicamentos</label>
           </div>
               <br>
               <div class="receita">

               </div>
           </div>
        </div>
           <br>
               <?php
               echo "
               
           <input  style=\"display: none\" readonly  type=\"text\" name='Id' value='$Atendente' placeholder=\"bi\"  id=\"id\">
                ";
                 ?>
               <input type="submit" id="Salvar" name="Salvar" class='btn form-control btn-outline-primary w-50 btn-lg' value="Salvar Relatório">
           </form>
            <form method="post">
            <input type="submit" id="" name="Terminar" class='btn form-control btn-outline-secondary w-50 btn-lg' value="Terminar Consulta">
            </form>




        </div>







</div>
</main>
</body>
</html>