<?php
session_start();

if(isset($_SESSION['Balc'])){
    header("Location: marc.php");
}
if(isset($_SESSION['Dentista'])){
    header("Location: dotor/dotor.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/boostrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/responsividade.css">
    <script src="jquery.min.js"></script>
    <script src="js/login.js"></script>
    <title>Sorriso Lindo| Login</title>
</head>
<body style="background-color: white">
    <header class="cabecalho">

    </header>


      <div class="login">

          <div id="img-lg">
              <img style=" display: block; margin: auto" width="50%"  src="icones/imagens/logo.png">
        <form>

           <div class="form-floating">
               <input type="email" name="Email" id="Email"  class="form-control w-100" placeholder="Email" required>
               <label for="Email">E-mail</label>
           </div>

            <div class="form-floating">
                <input type="password" name="Senha" id="Senha"  class="form-control w-100" placeholder="Senha" required>
                <label for="Senha">Senha</label>
            </div>


            <button class="btn btn-lg btn-primary w-100"  id="Entrar" type="button"><i id="proc"></i> Entrar</button>
             <hr>
            <p id="mensagem-login"></p>
            <p class="text-center">Copyright © 2023 Todos direitos Reservados </p>



           
        </form>
          </div>
      </div>
</body>
</html>