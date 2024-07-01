
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/formulario.css">
    <script src="jquery.js"></script>
    <script src="script.js"></script>

    <title>Administrador</title>

    <style>
        body {
            overflow: auto;
        }
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


        }

        label {
            color: gray;
            font-weight: bold;
            font-size: 14pt;
        }

    </style>

</head>
<body style="overflow: hidden">
<table>
<tr>
<td>
    <!--
    botoes de adm
    -->
    <div class='tela-login' style='width: 200px;margin-left: 0px;'>
        <form method="post" action="">
        <input type="submit" id='add_prod' name="pesq" class="bt-enviar" style="width: 235px;" value='Adicionar Usuário'><br>
        <input type="submit" id='usuarios' name="user" class="bt-enviar" style="width: 235px;" value='Gerir usuario'>
       

        </form>
    </div>
    <td
     </tr>

<?php
$url="";
if (isset($_POST['pesq'])){
    $url="criarconta.php";
}
elseif (isset($_POST['user'])){
    header("Location: gerir_user");
}
else if (isset($_POST['altp'])){
      $url="gerir.php";
}
echo "
<iframe src=\"$url\" style=\"display: block; border: 1px solid blue; margin-left:0px;\" width=\"800px\"; height=\"640px\">

</iframe>";
?>

</table>
</body>
</html>


