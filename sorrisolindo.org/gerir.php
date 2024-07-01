<?php
require_once 'conexão.php';
session_start();

$id=$_SESSION['idd'];
if (!isset($_SESSION['idd'])){
    header("Location: gerir_user.php");
}
$sql = "select * from usuario where Id='$id'";
$result=$conexao->query($sql);
//buscando dados na base de dados
while ($usuario=mysqli_fetch_assoc($result)) {
    $foto = $usuario['Foto'];
        $nome = $usuario['Nome'];
        $email = $usuario['Email'];
        $id = $usuario['Id'];
        $senha=$usuario['Senha'];
        $cargo = $usuario['Cargo'];
      
}

if(isset($_POST['editar'])){

    $nome1=$_POST['Nome'];
    $email1=$_POST['Email'];
    $senha1=$_POST['Senha'];
    header("Location: gerir.php");
    $sql1="update usuario set Nome='$nome1',Senha='$senha1',Email='$email1' where Id='$id'";
    $result=$conexao->query($sql1);

    if($result){
        echo  "<script>alert('Dados Alterados com sucesso')</script>";
    }
    else {
        echo  "<script>alert('Não foi possivel alterar os daddos')</script>";
    }
}
if(isset($_POST['eliminar'])){

 
    
    $sql1="delete from usuario where Id='$id'";
    $result=$conexao->query($sql1);

    if($result){
        echo  "<script>alert('Usuário Eliminado com sucesso')</script>";
        session_unset();
        session_destroy();
        header("Location: gerir_user.php");
    }
    else {
        echo  "<script>alert('Não foi possivel eliminar o Usuário')</script>";
    }
}
if(isset($_POST['voltar'])){
    session_unset();
    session_destroy();
    header("Location: gerir_user.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/formulario.css">
<link rel="stylesheet" href="css/divs.css">
<?php
echo "
<title>Alterar Usuário | $nome</title>
";
//importando arquivo de conexao

//editar os dados

?>
</head>
<body>
<header class="cabecalho>">
//
</header>
<div class="interface">
<div class="dados">
<?php
echo "
<img src='$foto' class='img_user'>
<center>

<form style=\"width: 100%;\" action=\"\" method=\"post\">
<input type=\"text\" style=\"width: 70%;\" name=\"Nome\" placeholder=\"Nome de Usúario\" value='$nome' class=\"texto\"><br>
<input type=\"email\" style=\"width: 70%;\" name=\"Email\" placeholder=\"E-mail\" value=\"$email\" class=\"texto\"><br>
<input type=\"password\" style=\"width: 70%;\" name=\"Senha\" placeholder=\"Senha\" value=\"$senha\" class=\"texto\"><br>

<input style=\"width: 74%;\" type=\"submit\" value=\"Editar\" name=\"editar\" class=\"bt-enviar\" id=\"entrar\">
<input style=\"width: 74%; background-color:  rgb(192, 134, 134);\" type=\"submit\" value=\"Eliminar\" name=\"eliminar\" class=\"bt-enviar\" id=\"entrar\">
<input style=\"width: 74%; \" type=\"submit\" value=\"Voltar\" name=\"voltar\" class=\"bt-enviar\" id=\"entrar\">


</form>
</center>

";

?>
</div>
<div class="registros">
//
<input type="text" name="" value="ou" id="">
<br>
<br>
<br>
</div>
</div>
</body>
</html>