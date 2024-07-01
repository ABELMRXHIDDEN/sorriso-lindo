<?php
require_once 'conexão.php';
$sql = "select * from produtos order by Id desc limit 30  ";
session_start();
if (isset($_SESSION['alterou'])){
    echo "<script>alert('Produto alterado com sucessso')</script>";
    unset($_SESSION['alterou']);
}
$result=$conexao->query($sql);
if (isset($_SESSION['add'])){
    $prod=$_SESSION['add'];
    echo "<script>alert('Produto: $prod Adicionado Com sucesso')</script>";
    unset($_SESSION['add']);
}
?>
<html
<head>
    <meta charset="utf-8">
    <title>SoftTech | Loja Online</title>
    <link rel="stylesheet" href="css/conta.css">
    <script lang="javascript" src="jquery.js"></script>
    <script lang="javascript" src="js/accoes.js"></script>
    <script lang="javascript" src="adm_pesq.js"></script>
    <style>
        *{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        ul{
            list-style: none;
            position: absolute;
            top: 18px;
            right: 50px;
        }
        li{
            display: inline-block;



        }
        .bt-enviar{
            border-radius: 5px;
            color: rgba(255, 255, 255, 0.5);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            text-decoration: none;
            padding: 5px;
            border: 1px solid blue;
            margin: 0px;
        }
        .bt-enviar:hover{
            transition: 0.5s;
            background-color: rgba(0, 0, 255, 0.5);
            color: white;
        }

    </style>
</head>
<body>
<header class="cabecalho">
    <form method="POST" id="form-pesquisa" action="" >
        <input type="text" autocomplete="off"  name="pesquisa" id="pesquisa" placeholder="Pesquisar produto">
    </form>
</header>
<div class="resultado" style="width: 1000px;box-shadow: none; display: block;margin: auto">
    <?php
    while ($produto=mysqli_fetch_assoc($result)) {
        $foto = $produto['Foto'];
        $nome = $produto['Nome'];
        $preco = $produto['Preco'];
        $dec = $produto['Des'];
        $id = $produto['Id'];
        $qtd = $produto['Qtd'];


        echo "
    <div class='fundo'>
    
    <figure>
    
    <img src=\"$foto\" alt=\"$nome\" class='foto_prod'>
    
    <figcaption style='background-color: white'>
    <label class='nome'>$nome</label><br>
    <label class='des'>$dec</label><br>
    <label class='preco'>".number_format($preco,2,',','.')." Kz</label>
    </figure>
    <form method='post' action='' style='background-color: white'>
    <input style='opacity: 0' type='text' name='idd' value='$id'>
    <input type=\"submit\"  value='Gerir' name='gerir' style='border-left: 0px; cursor: pointer; border: none; color: black; font-weight: bold;background-color: #dddddd; padding: 5px;position: relative;left: -162px'  width='100px'>
     </form>
    
   

    </div>
    ";
    }
    if (isset($_POST['gerir'])){
        $_SESSION['idd']=$_POST['idd'];
    }
    ?>
</div>
<script src="js/script.js"></script>
</body>
</html>
