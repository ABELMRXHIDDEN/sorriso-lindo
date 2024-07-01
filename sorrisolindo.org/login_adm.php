<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <script lang="javascript" src="js/script.js"></script>
    <title>SoftTech | Login</title>
</head>
<body>
<h1 class="titulo">Digite as suas Credenciais</h1>

<div class="tela-login">
    <form action="" method="post">

        <img src="icones/user.png" alt="Usuário" class="icone-login">
        <input type="text" name="Nome"  placeholder="Nome de Usúario" class="texto"><br>
        <input type="password" name="Senha" placeholder="Senha" class="texto"><br>


        <input type="submit" name="bt-enviar" value="Entrar" class="bt-enviar" id="entrar">
        <?php
        require_once 'conexão.php';
        if (isset($_POST['bt-enviar'])) {
            $nome=$_POST['Nome'];
            $senha=$_POST['Senha'];

            if(empty($nome) or empty($senha)){

                echo "<center><label style='text-align: center;color: red'>Preecha Todos Campos</label></center>";
                die();
            }
            else{

                        if ($nome == 'Abel@71' and $senha = '131055') {
                            session_start();
                            $_SESSION['adm'] = true;
                            header('Location: adm.php');
                        } else {
                            echo "<center><label style='text-align: center;color: red'>As credenciais Estão Erradas</label></center>";
                            die();
                        }
                    }
                }
        ?>


        <a href="index.php"><img src="icones/back_50px.png"></a>
    </form>
</div>

</body>
</html>
