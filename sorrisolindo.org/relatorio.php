<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
//Incluir a conexão com banco de dados
include_once 'conexão.php';
require_once 'inc/Dbh.php';
session_start();
$Id=$_SESSION['IdPaciente'];
$qtd=$_POST['qtd'];
$nome=array();
for($i=1; $i<=$qtd; $i++){
    $nome[$i]=array($_POST['med'.$i],$_POST['qtd'.$i]);
}
$NomeDentista='';
$Servicoid="";
$dentista="";
$Nome ="";
$NBI = "";
$Genero = "";
$N_Tel = "";
$Servico = "";
$Data_Nascimento = "";
$Hora = "";
$Data_Marcacao = "";
$pacientes=$conexao->query("select a.dataDaConsulta, a.horaDaConsulta, p.nomeCompleto,p.numeroDoBilhete,
 p.Sexo,a.Examinado,pr.nomeProcedimento,p.numeroDeTelefone,a.horaDaConsulta,d.Nome,a.horaDaConsulta,p.dataDeNascimento,a.Dentista_ID,pr.ID
 from  agendamentodeconsulta as a join paciente as p on a.Paciente_ID=p.idPaciente join procedimento as pr on a.Procedimento_ID=pr.ID join dentista as d on a.Dentista_ID = d.ID");
while ($dados = mysqli_fetch_assoc($pacientes)) {
    $dentista=$dados['Dentista_ID'];
    $Nome = $dados['nomeCompleto'];
    $NBI = $dados['numeroDoBilhete'];
    $Genero = $dados['Sexo'];
    $N_Tel = $dados['numeroDeTelefone'];
    $Servicoid=$dados['ID'];
    $Servico = $dados['nomeProcedimento'];
    $Data_Nascimento = $dados['dataDeNascimento'];
    $Hora = $dados['horaDaConsulta'];
    $NomeDentista=$dados['Nome'];
    $Data_Marcacao = $dados['dataDaConsulta'];

}

$data=date("d-m-Y:H:i:s");
$id = filter_input(INPUT_POST, 'Id', FILTER_SANITIZE_STRING);
$receita = filter_input(INPUT_POST, 'Receita', FILTER_SANITIZE_STRING);
$relatorio = filter_input(INPUT_POST, 'Relatorio', FILTER_SANITIZE_STRING);




$resultado=$conexao->query("insert into relatorio values (0,'$Id','$dentista','$Servicoid','$relatorio',curdate(),curtime())");
if ($resultado){

    echo "
     <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Sucesso!</h2>
    <p>O relatório sobre o paciente foi salvo Com sucesso</p>
   
    ";
    $info="";
    $dompdf=new Dompdf();
    for ($i=1; $i<=array_key_last($nome); $i++){
        $name=$nome[$i][0];
        $qtd=$nome[$i][1];
        $info.="<h3> $name---  $qtd</h3>";
    }
    echo $info;
    $dompdf->loadHtml(
        "
        <h1>Receita Medica | $Nome</h1>
        <p>Bilhete: $NBI</p>
        <p>Servico: $Servico</p>
        <p>Emitido aos </p>
       <hr>
       <br>
       <br>
        <br>
       $info
      
        
        <footer style='position: absolute;bottom: 0' >
                        Assinatura<br>
        _______________________________________________<br>
                      $DomeDentista
</footer>
        "

    );
    $dompdf->render();

    header('Content-type: application/pdf');
    echo $dompdf->output();
}
else {
    echo "
     <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
     <h2 class='modal-header'>Erro!</h2>
    <p>Não Foi possivel Salvar o Relatorio</p>
    ";
}
