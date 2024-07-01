<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../../js/chart.min.js"></script>

    <script src="../../js/chart.umd.min.js"></script>
    <script src="../../js/helpers.min.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../js/dashboard.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <div class="cardBox">

        <div id="btn-pa"  class="card">
            <div>
                <div class="number" id="atendidos">12</div>
                <div class="cardName">Pacientes Atendidos</div>
            </div>
            <div class="iconBx"><img src="../../img/icones/dash-paciente.png"></div>
        </div>


        <div class="card">
            <div>
                <div class="number" id="tdMarc">12</div>
                <div class="cardName">Marcações</div>
            </div>
            <div class="iconBx"><img src="../../img/icones/dash-marc.png"></div>
        </div>

        <div class="card">
            <div>
                <div class="number" id="pacientesCadastrados">0</div>
                <div class="cardName">Pacientes Cadastrados</div>
            </div>
            <div class="iconBx"><img src="../../img/icones/dash-cadastrado.png"></div>
        </div>

        <div class="card">
            <div>
                <div class="number">12</div>
                <div class="cardName">Facturas Emitidas</div>
            </div>
            <div class="iconBx"><img src="../../img/icones/dash-factura.png"></div>
        </div>
    </div>
    <div class="graficos">
        <div class="grafico1" style="width: 580px; height: 500px">
            <h2>Marcações</h2>
            <canvas id="myChart">

            </canvas>
        </div>

        <div style="width: 600px; height: 500px" class="grafico1">
            <h2>Faturação</h2>
            <canvas id="myChart2" width="600px" height="500px">

            </canvas>
        </div>


    </div>



</body>
</html>