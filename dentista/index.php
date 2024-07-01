<?php
session_start();
if (!isset($_SESSION['Dentista'])){
    header("Location: ../index.php");

}
else{
$data=date("d-m-Y");
$id=$_SESSION['Id_user'];

echo "<input id='idU' value='$id' style='display: none'>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Dentista</title>

    <link href="../img/icones/icone-site.ico" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="css/style.css">
    <script src="../js/jquery.min.js"></script>
    <script src="js/main.js"></script>

</head>
<body>
<div class="container">
<div class="navegation">
    <ul>
        <img class="logotipo"  src="../img/logo.png">
    </ul>
    <ul>
        <li>
            <a href="#" id="Dashboard">
                <span class="icon"><img width="" src="../img/icones/dashboard.png"></span>
                <span class="title">Dashboard</span>
            </a>
        </li>
    </ul>


    <ul>
        <li>
            <a href="#" id="definicoes">
                <span class="icon"><img src="../img/icones/settings.png"></span>
                <span class="title">Definições</span>
            </a>
        </li>
    </ul>
    <ul>
        <li>
            <a href="../" id="logout">
                <span class="icon"><img width="" src="../img/icones/logout.png"></span>
                <span class="title">Sair</span>
            </a>
        </li>
    </ul>


</div>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <img src="../img/icones/menu.png">
            </div>

            <div class="user">
                <img id="FotoPerfil"   src="../img/usuarios/user.png">
                <p style="position: fixed;right: 100px;top: 20px;display: none" id="nomeUser"></p>
            </div>
        </div>
        <iframe class="views" src="views/view-dashboard.php">
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="number">12</div>
                    <div  class="cardName">Marcações </div>
                </div>
                <div class="iconBx"><img src="../img/icones/dash-paciente.png"></div>
            </div>


        <div class="card">
            <div>
                <div class="number">12</div>
                <div class="cardName">Marcações</div>
            </div>
            <div class="iconBx"><img src="../img/icones/dash-marc.png"></div>
        </div>

        <div class="card">
            <div>
                <div class="number" id="pacientesCadastrados">0</div>
                <div class="cardName">Pacientes Cadastrados</div>
            </div>
            <div class="iconBx"><img src="../img/icones/dash-cadastrado.png"></div>
        </div>

            <div class="card">
                <div>
                    <div class="number">12</div>
                    <div class="cardName">Facturas Emitidas</div>
                </div>
                <div class="iconBx"><img src="../img/icones/dash-factura.png"></div>
            </div>
    </div>
    </iframe>
    </div>
</div>
</body>
</html>