<?php
session_start();
require_once 'conexão.php';
if (isset($_SESSION['logado'])){
    
    
}
else{
    
}
if (isset($_POST['sair'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
}
if(isset($_POST['edicao'])){
    $id_user=$_POST['idd'];
    session_start();
    $_SESSION[idd]=$id_user;
    header("Location: gerir.php");

}
?>
<?php
require_once 'conexão.php';
$sql = "select * from usuario order by Id desc limit 50  ";
$result=$conexao->query($sql);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>SoftTech | Página Inicial</title>
    <link rel="stylesheet" href="css/conta.css">
    <script lang="javascript" src="jquery.js"></script>
    <script src="pesquisa.js"></script>
</head>
<body>
<header class="cabecalho">

        <input type="text" autocomplete="off"   name="pesquisa" id="pesquisa" placeholder="Pesquisar Usuario">

</header>
<div class="resultado">
    <?php
    while ($produto=mysqli_fetch_assoc($result)) {
        $foto = $produto['Foto'];
        $nome = $produto['Nome'];
        $email = $produto['Email'];
        $id = $produto['Id'];

        $cargo = $produto['Cargo'];
      


        echo "
        <div class='fundo'>
    
        <figure>
        
        <img src=\"$foto\" alt=\"$nome\" class='foto_prod'>
        
        <figcaption style='background-color: white'>
        <label class='nome'>$nome</label><br>
        <label class='des'>$email</label><br>
        <label class='preco'>Cargo: $cargo</label>
       <form action=\"\" method=\"post\" style='background: white'>
        <input style='opacity: 0' type='text' name='idd' value='$id'>
        <input type=\"submit\"  value='' name='edicao' style=\"background: url('icones/icons8_add.ico') no-repeat;background-size: 30px 30px;margin-top: -18px;background-position: 50% 50%\" class='bt-enviar'>
       
        </figcaption>
        </figure>
        
       
     </form>
        </div>
    
    ";
    }
    ?>
  
    
</div>

</body>
</html>
