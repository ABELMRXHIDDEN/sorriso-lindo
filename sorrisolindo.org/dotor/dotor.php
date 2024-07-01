<?php
require_once '../conexão.php';
session_start();
if (isset($_SESSION['Dentista'])){
    true;
}
else{
    header("Location: ../login.php");
}

$id=$_SESSION['Id_user'];
$stm=$conexao->query("select * from usuario where Id='$id'");
$foto="";
while ($dados=mysqli_fetch_assoc($stm)){
    $foto=$dados['Foto'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Paciente</title>
    <link rel="stylesheet" href="../css/view_2.0.css">
    <link rel="stylesheet" href="../css/boostrap/css/bootstrap.css">
    <script src="../jquery.min.js"></script>
    <script src="js/view_2.0.1.js"></script>

    <script lang="javascript" src="../js/script.js"></script>
    <script src="../js/animacao.js"></script>
</head>
<body>
   <div id="interface">
     <div id="slideBar">
         <div></div>
         <div></div>
         <div><button class="btn btn-primary form-control btn_slide" id="dashboard"><i><img  src="../icones/dashboard.png"></i>&nbsp;&nbsp;Dashboard &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></div>
         <div><button class="btn btn-primary form-control btn_slide" id="logout"><i><img  src="../icones/logout.png"></i>&nbsp;&nbsp;&nbsp;Terminar Sessão &nbsp;&nbsp;</button></div>
     </div>
       <div id="conteudo">
           <div id="perfil">
               <div class="abas">

               </div>
               <div class="abas">

               </div>
               <div class="abas" id="foto"><img style="border-radius:100% " width="30%" src="<?php  echo "../".$foto ?>">
               </div>

       </div>
           <iframe id="abas" style="overflow: hidden" src="dashboard_marc.php" width="95%" height="520px">

           </iframe>
   </div>
</body>
</html>