<?php
include_once '../conexão.php';
if (isset($_POST['relatorio'])) {
session_start();
    $_SESSION['relatorio'] = true;
    $_SESSION['IdPaciente'] = $_POST['Id_Paciente'];
    echo "true";
    header("Location: paciente.php");
}
$total=0;
$stm=$conexao->query("select * from agendamentodeconsulta");
while ($info=mysqli_fetch_assoc($stm)){
    $total++;
}
$aguardando=0;
$stm=$conexao->query("select * from agendamentodeconsulta where Examinado=false and horaDaConsulta=''");
while ($info=mysqli_fetch_assoc($stm)){
    $aguardando++;
}
$marcacao=0;
$stm=$conexao->query("select * from agendamentodeconsulta where Examinado=false and dataDaConsulta=curdate() and horaDaConsulta!=''");
while ($info=mysqli_fetch_assoc($stm)){
    $marcacao++;
}
$atendidos=0;
$stm=$conexao->query("select * from agendamentodeconsulta where Examinado=true");
while ($info=mysqli_fetch_assoc($stm)){
    $atendidos++;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Paciente</title>
    <link rel="stylesheet" href="../css/view_2.0.css">
    <link rel="stylesheet" href="../css/boostrap/css/bootstrap.css">
    <script src="../jquery.min.js"></script>
    <script src="js/view_2.0.1.js"></script>
    <script lang="javascript" src="../js/script.js"></script>
    <script src="../js/animacao.js"></script>

    <script>
      function lc(){
         let id =$("#Id").val()
          var dados={
              Consulta:true,
              Id:id
          }
          $.post('dashaction.php',dados,(Mensagem)=>{
              alert(Mensagem)
          })
      }
    </script>
</head>
<body>
  <div id="dashboard">
      <div id="caixas">
         
          <div class="item_caixa" id="caixa2">
              <div class="item1" id="">
                  <span class="sp1"><?php echo $aguardando?></span><br>
                  <span class="sp2">Aguardando Atendimento</span>
              </div>
              <div class="item2">
                  <img src="../icones/aguardando.png" class="icone">
              </div>
          </div>
          <div class="item_caixa" id="caixa3">
              <div class="item1" id="">
                  <span class="sp1"><?php echo $marcacao ?></span><br>
                  <span class="sp2">Marcações | <?php echo date('d/m/Y') ?> </span>
              </div>
              <div class="item2">
                  <img src="../icones/marcacao.png" class="icone">
              </div>
          </div>
          <div class="item_caixa" id="caixa4">
              <div class="item1" >
                  <span class="sp1"><?php echo $atendidos ?></span><br>
                  <span class="sp2">Pacientes Atendidos</span>
              </div>
              <div class="item2">
                  <img src="../icones/checked_96px.png" class="icone">
              </div>
          </div>
          <div class="item_caixa" style="opacity: 0">
              <div class="item1" id="">

              </div>
              <div class="item2">

              </div>
          </div>


          <div class="item_caixa" id="" style="display: none">


          </div>

      </div>

      </div>

  </div>
  <div class="resultado" style="height: 60vh">

  </div>
</body>
</html>

