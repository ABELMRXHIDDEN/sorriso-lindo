
<?php
session_start();
require_once 'conexão.php';
 if(isset($_SESSION['carrinho']) and  isset($_SESSION['logado'])){

 }
 else{


     header("Location:conta.php");

 }
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="css/estilo.css">
    <style>

        .carrinho{
            display: block;
            margin:30px auto auto auto;
            box-shadow: 0 0 2px rgba(0,0,0,.3);
            width: 1330px;
            height: 610px;
            overflow: auto;
        }
        label {
            margin: 0px;
        }
        .tela-login2{
            border-radius: 30px 20px;
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 0, 0,0.4);
            width: 350px;
            height: 500px;
            padding: 30px;
            display: inline-flex;
            margin: 0px;
            align-items: center;
            flex-wrap: wrap;

        }
    .bt-enviar2{
        top: -15px;
        position: relative;
        left: 328px;
        width: 40px;
        height: 40px;
        background: url("icones/icons8_cancel_64.png") no-repeat;
        background-position: 50% 50%;
        background-size: 40px 40px;
        cursor: pointer;
        border: none;
    }
    </style>
</head>
<body>
<form action="conta.php" method=\"post\">
    <input value='' name='perfil' type='submit' class="perfil" style="width: 50px;height: 50px; border: none; background: url('icones/voltar.png') no-repeat;background-size: 50px 50px;background-position: 50% 50%;">
</form>
<div class="carrinho" style="border: none;margin-top: -30px">

    <?php
    $total=0;
    foreach ($_SESSION['carrinho'] as $key =>$item) {
        $nome = $item['nome'];
        $preco = $item['preco'];
        $qtd = $item['qtd'];
        $foto = $item['foto'];
        $des = $item['des'];
        $idd=$item['id'];

       $total += $preco*$qtd;
    echo "

<table>
<tr>
<td>
    <div class='tela-login'>
    <form method='post' action=''>
    <input type='submit' name='eliminar' value='' style='' class='bt-enviar2'>
       <img width='250px' height='200px' src='$foto' class='icone-login'><br>
        <label>$nome</label><br><br>
        <label>Preço: ".$preco=number_format($preco,2,',','.')." Kz</label><br><br>
        <label>$des</label><br><br>
        <label>Quantidade: $qtd</label><br><br>
        <label>Total: ".$preco=number_format($qtd*$preco,2,',','.')."kz</label><br><br>
        <input type=\"text\" style='display: none' name='id' value='$idd'>
        


    </form>
    </div>
    <td
     </tr>
 
     ";
    }
    ?>

    <?php
    if (!isset($idd)){

header("Location: conta.php");
    }
    ?>

    <?php
    if (isset($_POST['eliminar'])){
        $id=$_POST['id'];
        unset($_SESSION['carrinho'][$id]);
        header('Location: carrinho.php');
    }
    ?>

    </table>
</div>
<?php


echo "
<form action=\"\" method=\"post\">
<label style='position: absolute; color: white; font-weight: bold; top: 2px;left: 1080px'>
<input type=\"submit\" name='comprar' style='padding: 5px;font-weight: bold;border: none;background-color: white;cursor: pointer; border-radius: 10px' value='Comprar'>
Total:  ".$preco=number_format($total,2,',','.')." kz</label>
</form>
";

?>
</body>
</html>
<?php
$money=$_SESSION['dinheiro'];
if (isset($_POST['comprar'])) {
    if ($money >= $total) {
        $id_user = $_SESSION['id'];
        foreach ($_SESSION['carrinho'] as $key => $item) {
            $idd2 = $item['id'];
            $qtd2 = $item['qtd'];
            $pegar = $conexao->query("select * from produtos where Id='$idd2'");
            while ($abel = mysqli_fetch_assoc($pegar)) {
                $nome_prod = $abel['Nome'];
                $qtd_in = $abel['Qtd'];
            }
            if ($qtd2 > $qtd_in) {
                echo "<script>alert(\"Produto: $nome_prod stok: $qtd_in  Pedido:$qtd2 pedido acima do stock \")</script>";
            }
            else {
                $qtd_fim=$qtd_in-$qtd2;
                 $comprou = $conexao->query("insert into venda values(0,'$id_user','$idd2','$qtd2',current_timestamp())");
                 $res=$money-$total;
                 $comprou=$conexao->query("update usuario set dinheiro = '$res' WHERE Id = '$id_user'");
                 $red=$conexao->query("update produtos set Qtd ='$qtd_fim' where Id='$idd2'");
            if ($red and $comprou){
                echo "<script>alert('Muito obrigado por comprares na nossa plataforma')</script>";

                header("Location: user.php");
            }
            else{
                echo "<script>alert(\"Bugou \")</script>";
            }
        }
       }

    }

    else{
        echo "<script>alert('Não foi possível efutuar a compra pois os fundos são insuficintes => Total a paga => $total  Fundo da conta=> $money')</script>";
    }
}


?>