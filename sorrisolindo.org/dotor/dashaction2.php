<?php

require_once '../conexão.php';


if(isset($_POST['Aguardando'])) {
    $stm = $conexao->query("select a.dataDaConsulta, a.horaDaConsulta, p.nomeCompleto,p.numeroDoBilhete,
 p.Sexo,a.Examinado,pr.nomeProcedimento,p.email,p.numeroDeTelefone,p.idPaciente,p.dataDeNascimento
 from  agendamentodeconsulta as a join paciente as p on a.Paciente_ID=p.idPaciente join procedimento as pr on a.Procedimento_ID=pr.ID where Examinado=false and horaDaConsulta='' order by a.ID");

    while ($dados = mysqli_fetch_assoc($stm)) {
        $Nome = $dados['nomeCompleto'];
        $NBI = $dados['numeroDoBilhete'];
        $Genero = $dados['Sexo'];
        $N_Tel = $dados['numeroDeTelefone'];
        $email = $dados['email'];
        $Id=$dados['idPaciente'];
        $Data_Nascimento = $dados['dataDeNascimento'];
        $Servico=$dados['nomeProcedimento'];

        echo "
        <div class='paciente' style='height: 220px'>

        <span>$Nome</span><br>
        <hr>
        <span>Nº Bilhete:$NBI</span><br>
        <span>Género: $Genero</span><br>
        <span>Serviço:$Servico</span><br>
        <span>Data de Nascimento:$Data_Nascimento</span><br>
      
       
        <form method='post' action='news.php'>
        <input type='text' name='Id_Paciente' id='Id' value='$Id' style='display: none'>
        <button type='submit' name='atender' id='atender' class='btn-outline-primary btn form-control'>Atender</button>
        
</form>
        </div>
        
          ";

    }
}
if(isset($_POST['Atendidos'])){
    $stm = $conexao->query("select a.dataDaConsulta, a.horaDaConsulta, p.nomeCompleto,p.numeroDoBilhete,
 p.Sexo,a.Examinado,pr.nomeProcedimento,p.email,p.numeroDeTelefone,p.idPaciente,p.dataDeNascimento
 from  agendamentodeconsulta as a join paciente as p on a.Paciente_ID=p.idPaciente join procedimento as pr on a.Procedimento_ID=pr.ID where Examinado=true order by a.ID");

    while ($dados = mysqli_fetch_assoc($stm)) {
        $Nome = $dados['nomeCompleto'];
        $NBI = $dados['numeroDoBilhete'];
        $Genero = $dados['Sexo'];
        $N_Tel = $dados['numeroDeTelefone'];
        $email = $dados['email'];
        $Id=$dados['idPaciente'];
        $Data_Nascimento = $dados['dataDeNascimento'];
        $Servico=$dados['nomeProcedimento'];
    echo "
        <div class='paciente' style='height: 220px'>

        <span>$Nome</span><br>
        <hr>
        <span>Nº Bilhete:$NBI</span><br>
        <span>Género: $Genero</span><br>
        <span>Serviço:$Servico</span><br>
        <span>Data de Nascimento:$Data_Nascimento</span><br>
      
       
        
        
</form>
        </div>
        
          ";
}
}
if(isset($_POST['Marchoje'])){
    $stm = $conexao->query("select a.dataDaConsulta, a.horaDaConsulta, p.nomeCompleto,p.numeroDoBilhete,
 p.Sexo,a.Examinado,pr.nomeProcedimento,p.email,p.numeroDeTelefone,p.idPaciente,p.dataDeNascimento
 from  agendamentodeconsulta as a join paciente as p on a.Paciente_ID=p.idPaciente join procedimento as pr on a.Procedimento_ID=pr.ID where Examinado=false and a.dataDaConsulta=curdate() order by a.ID");

    while ($dados = mysqli_fetch_assoc($stm)) {
        $Nome = $dados['nomeCompleto'];
        $NBI = $dados['numeroDoBilhete'];
        $Genero = $dados['Sexo'];
        $datamar=$dados['dataDaConsulta'];
        $horamar=$dados['horaDaConsulta'];
        $N_Tel = $dados['numeroDeTelefone'];
        $email = $dados['email'];
        $Id=$dados['idPaciente'];
        $Data_Nascimento = $dados['dataDeNascimento'];
        $Servico=$dados['nomeProcedimento'];

        echo "
        <div class='paciente' style='height: 275px'>

        <span>$Nome</span><br>
        <hr>
        <span>Nº Bilhete:$NBI</span><br>
        <span>Data de Nascimento:$Data_Nascimento</span><br>
        <span>Género: $Genero</span><br>
        <span>Serviço:$Servico</span><br>
        <span>Data Marcação: $datamar</span><br>
        <span>Hora:$horamar</span><br>
        
       
        <form method='post' action='news.php'>
        <input type='text' name='Id_Paciente' id='Id' value='$Id' style='display: none'>
        <button type='submit' name='atender' id='atender' class='btn-outline-primary btn form-control'>Atender</button>
        
</form>
        </div>
        
          ";

    }
}
if (isset($_POST['Sair'])){
    session_start();
    session_unset();
    session_destroy();
}