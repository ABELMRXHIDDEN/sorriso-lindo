
<?php
require_once 'conexão.php';
session_start();
if (isset($_SESSION['logado'])){
    $id=$_SESSION['id'];
    $sql = "select * from usuario where Id='$id'";
    $result=$conexao->query($sql);
    $sql = "select * from venda where Id_user='$id'";
    $venda=$conexao->query($sql);
    while ($info=mysqli_fetch_assoc($result)) {
        $nome_user=$info['Nome'];
        $money=$info['dinheiro'];
        $foto=$info['Foto'];
        $email=$info['Email'];


    }
}
else{
    header("Location: conta.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">

    <title>Perfil|<?php echo"$nome_user"; ?></title>

    <style>
        .produtos{
            position: relative;
            left: 300px;
            width: 900px;
        }
        a{
            display: inline-block;
            margin: 5px;
            float: right;
        }
        table {

           border-spacing: 0;
        }
        td {

            padding: 5px;
            width: 450px;

        }

        label {
            color: gray;
            font-weight: bold;
            font-size: 14pt;
        }

    </style>

</head>
<body>
<form action="conta.php" method=\"post\">
    <input value='' name='perfil' type='submit' class="perfil" style="width: 50px;height: 50px; border: none; background: url('icones/voltar.png') no-repeat;background-size: 50px 50px;background-position: 50% 50%;">
    <h2 style="margin: 0px" class="titulo">Itens Comprado na Plataforma</h2>
</form>






<?php
    echo "

<table>
<tr>
<td>
    <div class='tela-login'>
    <form method='post' action=''>
    
       <img width='250px' style='border-radius: 250px' height='250px' src='$foto' class='icone-login'><br>
        <label>$nome_user</label><br><br>
        <label class='preco'>".number_format($money,2,',','.')." Kz</label><br><br>
        <label>E-mail: $email</label><br><br>
        

    </form>
    </div>
    <td
     </tr>
 
     ";

?>
<div class="tela-login" style='width: 800px; overflow: auto'>

<?php
while ($produto=mysqli_fetch_assoc($venda)){
    $id_prod=$produto['Id_pro'];
    $qtd=$produto['Qtd'];
    $data=$produto['Data_venda'];
    $resultado=$conexao->query("select * from produtos where Id='$id_prod'");
    while ($res=mysqli_fetch_assoc($resultado)){
        $foto_pro = $res['Foto'];
        $nome_pro = $res['Nome'];
        $preco_pro = $res['Preco'];

    }
    echo "
    <table>
    <tr>
    <td><img width='100px' height='100px' src=\"$foto_pro\" alt=\"Foto do produto\"></td>
    <td><label>$nome_pro</label</td>
    <td><label class='preco'>".number_format($preco_pro,2,',','.')." Kz</label></td>
    <td><label> Qtd: $qtd</label></td>
    <td><label>Data de Compra $data</label></td>
    </tr>
    
    ";
}
?>
    </table>
</div>


<script src="js/script.js"></script>
</body>
</html>
