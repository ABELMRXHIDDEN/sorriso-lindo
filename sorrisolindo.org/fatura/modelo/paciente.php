<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paciente</title>

    <style>
        * {
            font-family: Arial, ui-monospace;
            font-weight: bold;
        }
        footer {
            border-top: 1px solid rgba(0,0,0,.2);
            position: absolute;
            border-bottom: 0;
        }
        #cabecalho {
            width: 100%;
        }
        #cabecalho td {


            width: 50%;
        }
        table#corpo {
            margin:150px 0 0 0;
        }
       #corpo td {
            padding: 8px;


        }
       #cabecalho td.dr {
           text-align: right;

       }
        #logo {
         width: 150px;
            margin: 0;
        }
        nav {
            border-bottom: 1px solid rgba(0,0,0,.2);
        }
    </style>
</head>
<body>


<?php
require_once '../../conexão.php';
$bi="007646997LA041";
$sql="select * from paciente where NBI='$bi'";
$res=$conexao->query($sql);
$nome="";
$sexo="";
$tel="";
$servico="";
$data_nas="";
$hora="";
$datamar="";
$id_user="";
$user_name="";
$data_cads="";
$hora_cads="";
while ($dados=mysqli_fetch_assoc($res)){
    $nome=$dados['Nome'];
    $sexo=$dados['Genero'];
    $tel=$dados['N_tel'];
    $servico=$dados['Servico'];
    $data_nas=$dados['Data_Nascimento'];
    $hora=$dados['Hora'];
    $datamar=$dados['Data_Marcacao'];
    $id_user=$dados['Id_user'];
    $data_cads=$dados['Data_Cadas'];
    $hora_cads=$dados['Hora_Cad'];

}
$sql="select Nome from usuario where Id='$id_user'";
$res=$conexao->query($sql);
while ($dados=mysqli_fetch_assoc($res)){
    $user_name=$dados['Nome'];
}
echo "
<nav>
    <table id=\"cabecalho\">
        <tr>
            <td>
    <img id=\"logo\" src=\"http://sorrisolindo.org/icones/imagens/logo.png\">
            </td>
            <td class=\"dr\">

    <p>Balconista: $user_name</p>
    <p>Data de Emissão: $data_cads</p>
    <p>Hora de Emissão: $hora_cads</p>
            </td>
        </tr>
    </table>
</nav>

<h1>Dados De Cadastro</h1>
<table id='corpo'>
<tr>
<td>Nome Completo:</td>
<td>$nome</td>
</tr>
<tr>
<td>Nº Bilhete:</td>
<td>$bi</td>
</tr>
<tr>
<td>Data de Nascimento: </td>
<td>$data_nas</td>
</tr>
<tr>
<td>Género: </td>
<td>$sexo</td>
</tr>
<tr>
<td>Tipo de Exame: </td>
<td>$servico </td>
</tr>
<tr>
<td>Data da Marcação:
<td>$datamar</td>
</tr>
<tr>
<td>Hora da Marcação: </td>  
<td>$hora</td>  
</tr>
</table>




";
?>

</body>
</html>