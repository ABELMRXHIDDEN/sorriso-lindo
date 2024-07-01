<?php
session_start();
if (isset($_SESSION['Recepcao'])) {
    header("Location: recepcao");
}
else if(isset($_SESSION['Dentista'])) {
    header("Location: dentista");
}
else if(isset($_SESSION['Adm'])) {
    header("Location: adm");
}
?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="img/icones/icone-site.ico" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="css/boostrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/load.css">
    <script src="js/sweetalert2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/load.js"></script>
    <script src="js/login.js"></script>
    <title>Sorriso Lindo | Login</title>

</head>
<body>
   <div class="loading">
       <img id="gifDeLoading" src="img/load.gif">

       <div class="form-login">
           <div class="login-logo">

           </div>
        <div class="form-floating">
            <input id="Email" type="email"  required class="form-control texto" placeholder="Email">
            <label for="Email">E-mail</label>
        </div>
           <div class="form-floating">
               <input id="Senha" type="password" required class="form-control texto" placeholder="Senha">
               <label for="Senha">Senha</label>
           </div><br>
           <button type="button" id="Login" class="form-control btn-outline-primary btn btn-lg">Entrar</button>
       </div>

       <div id="sms-login">

       </div>

   </div>
</body>
</html>
