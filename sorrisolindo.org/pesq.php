<?php
//Incluir a conexão com banco de dados
include_once 'conexão.php';

$paciente = filter_input(INPUT_POST, 'palavra');


//Pesquisar no banco de dados nome do paciente referente a palavra digitada
$sql = "SELECT * FROM paciente WHERE NBI='$paciente'";
$result = mysqli_query($conexao, $sql);


if(($result) and ($result->num_rows != 0 )){
        $dados = mysqli_fetch_assoc($result);

        $id = $dados['Id'];
        $nome = $dados['Nome'];
        $sexo = $dados['Genero'];
        $tel = $dados['N_tel'];
        $morada=$dados['Residencia'];
        $servico = $dados['Servico'];
        $datanas = $dados['Data_Nascimento'];
        $hora = $dados['Hora'];
        $datamar = $dados['Data_Marcacao'];
        $bi = $dados['NBI'];

         echo "
<button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>
<h2 class='modal-header'>O Pacinte Foi Encontrado</h2>
<label for=\"\">Nome: $nome</label><br>
<label for=\"\">BI Nº: $bi</label>
<div style='display: none'>
        <input type='text' id='ide'  value='$id'>
        <input type='text' id='nm'  value='$nome'>
        <input type='text' id='sx' value='$sexo'>
        <input type='text' id='tl'  value='$tel'>
        <input type='text' id='mr'  value='$morada'>
        <input type='text' id='sr'  value='$servico'>
        <input type='text' id='dn'  value='$datanas'>
        <input type='text' id='hr'  value='$hora'>
        <input type='text' id='dm'  value='$datamar'>
        <input type='text' id='bi'  value='$bi'>
     
        </div><br>
         
    ";
}
    

else {


    echo "
   <button class='bt btn-close btn-sm' style='float: right' onclick='fecharMensagem()' id='fechar'></button>

    <h2 class='modal-header'>Erro</h2>
    <p>Não Foi possível Encontrar o Paciente</p>
    <div style='display: none'>

        <input type='text' id='nm'  value='Vazio'>
 
        </div>
   <button class='btn-lg btn-secondary btn' style='float: right' onclick='fecharMensagem()' id='fechar'>Fechar</button>
    "
    ;
}