<?php
session_start();
require_once '../conexão.php';
if (isset($_SESSION['Dentista'])){
    $id=$_SESSION['Id_user'];
    $sql = "select * from usuario where Id='$id'";
    $user=$conexao->query($sql);
    while ($info=mysqli_fetch_assoc($user)) {
        $foto=$info['Foto'];
    }
}
else{
    header("Location: ../login.php");
}
if (isset($_POST['sair'])){
    session_unset();
    session_destroy();
    header("Location: ../login.php");
}

if (isset($_POST['relatorio'])) {

    $_SESSION['relatorio'] = true;
    $_SESSION['IdPaciente'] = $_POST['Id_Paciente'];
    header("Location: paciente.php");
}



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/formulario.css">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="../css/boostrap/css/bootstrap.css">
    <script lang="javascript" src="../jquery.js"></script>

    <script lang="javascript" src="../js/script.js"></script>
    <script src="../js/animacao.js"></script>

    <title>Cadastrar Paciente</title>
</head>
<body style="">
<nav  class="navbar-expand-sm fixed-top">
    
</nav>
<dialog id="sms" class="modal-sm w-25">

    <h2 class="modal-header">OI</h2>
</dialog>

<div id="interface">
    <header class="cabecalho">


    </header>


    <main class="principal text-center w-75">
    <h2>Pacientes Aguardando Atendimento</h2>
        <div style="overflow: auto; height: 600px">
     <table style="" class="table w-100 table-hover table-striped table-responsive">
         <thead style="">
         <tr style="position: ">
             <th>#</th>
             <th>Nome Completo</th>
             <th>Nº do Bilhete</th>
             <th>Serviço</th>
             <th>Género</th>
             <th>Data de Nascimento</th>
             <th>Nº de Telefone</th>

         </tr>
         </thead>
         <?php
         $pacientes=$conexao->query("select * from paciente where Examinado=false order by Id");

         while ($dados=mysqli_fetch_assoc($pacientes)){
             $Id=$dados['Id'];
             $Nome=$dados['Nome'];
             $NBI=$dados['NBI'];
             $Genero=$dados['Genero'];
             $N_Tel=$dados['N_tel'];
             $Servico=$dados['Servico'];
             $Data_Nascimento=$dados['Data_Nascimento'];
             $Hora=$dados['Hora'];
             $Data_Marcacao=$dados['Data_Marcacao'];
             $Atendente=$dados['Id_user'];
             echo "
        
             <tr style='cursor: pointer'>
             
             <td>
             <form action=\"\" method=\"post\">
             <input type='text' name='Id_Paciente' value='$Id' style='display: none'>
             <input type=\"submit\" value=\"\" name=\"relatorio\" style=\"background: url('../icones/icons8_add.ico') no-repeat;background-size: 25px 25px;background-position: 50% 50%;border: none;width: 40px\" class=\"bt-enviar\">
             </form>
             </td>
             <td>$Nome</td>
             <td>$NBI</td>
             <td>$Servico</td>
             <td>$Genero</td>
             <td>$Data_Nascimento</td>
             <td>$N_Tel</td>
             
             </tr>
             
             ";
         }



         ?>
     </table>
        </div>






    </main>
</div>

</body>
</html>

