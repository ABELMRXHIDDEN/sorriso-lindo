<?php
if(isset($_POST['vlt'])){
    header("Location: https://google.com");
}
if(isset($_POST['ctn'])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/boostrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/responsividade.css">
    <script lang="javascript" src="jquery.js"></script>
    <title>Boas Vindas</title>
    <script>
 function fechar(){
   
  }
    
 
    </script>
</head>
<body>
    <main class="container login">
    <header class="container">
    <center>
        <img src="icones/imagens/logo.png" width="30%" alt="">
    </center>
    </header>
    <div class="container-sm">
        <h1>Bem Vindo</h1>
        <p>Sistema de gestão da clinica sorriso lindo restrito para uso de pessoal autorizado</p>
        <p>Em caso de invasão ou uso de pessoal não autorizado devidas sansões serão aplicadas</p>
        <form action="" method="post">

        <input type="submit" name="vlt" class="btn btn-lg btn-primary" value="Voltar">
        <input style="float:right" name="ctn" type="submit" class="btn btn-lg btn-primary" value="Continuar">

        </form>
    </div>
    <main>
</body>
</html>