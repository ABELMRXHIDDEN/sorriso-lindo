<?php
require_once 'conexão.php';
if(isset($_POST['Pacientes'])){
    $stm=$conexao->query("select agendamentodeconsulta.dataDaConsulta, agendamentodeconsulta.horaDaConsulta, paciente.nomeCompleto,paciente.numeroDoBilhete,paciente.numeroDeTelefone,
 paciente.Sexo,paciente.email,paciente.dataDeNascimento
 from  agendamentodeconsulta join paciente on agendamentodeconsulta.Paciente_ID=paciente.idPaciente");

    while ($dados=mysqli_fetch_assoc($stm)){
    $Nome=$dados['nomeCompleto'];
    $NBI=$dados['numeroDoBilhete'];
    $Genero=$dados['Sexo'];
    $N_Tel=$dados['numeroDeTelefone'];
    $email=$dados['email'];
    $daconsulta=$dados['dataDaConsulta'];
    $Data_Nascimento=$dados['dataDeNascimento'];

    echo "
        
 <div class='paciente'>

        <span>Nome:$Nome</span><br>
        <hr>
        <span>Nº Bilhete:$NBI</span><br>
        <span>Género: $Genero</span><br>
        <span>Email: $email</span><br>
       <span>Data de Nascimento: $Data_Nascimento</span><br>
       <span>Data Consulta: $daconsulta</span><br>
      
        </div>
             ";

}
}
if(isset($_POST['Aguardando'])) {
    $stm = $conexao->query("select agendamentodeconsulta.dataDaConsulta, agendamentodeconsulta.horaDaConsulta, paciente.nomeCompleto,paciente.numeroDoBilhete,paciente.numeroDeTelefone,
 paciente.Sexo,paciente.email,paciente.dataDeNascimento
 from  agendamentodeconsulta right join  paciente on agendamentodeconsulta.Paciente_ID=paciente.idPaciente where Examinado=false and horaDaConsulta=''");

    while ($dados = mysqli_fetch_assoc($stm)) {
        $Nome = $dados['nomeCompleto'];
        $NBI = $dados['numeroDoBilhete'];
        $Genero = $dados['Sexo'];
        $N_Tel = $dados['numeroDeTelefone'];
        $email = $dados['email'];
        $Data_Nascimento = $dados['dataDeNascimento'];

        echo "
        
 <div class='paciente'>

        <span>Nome:$Nome</span><br>
        <hr>
        <span>Nº Bilhete:$NBI</span><br>
        <span>Género: $Genero</span><br>
        <span>Email: $email</span><br>
       <span>Data de Nascimento: $Data_Nascimento</span><br>
      
        </div>
             ";

    }
    if (isset($_POST['Marchoje'])) {
        $stm = $conexao->query("select agendamentodeconsulta.dataDaConsulta, agendamentodeconsulta.horaDaConsulta, paciente.nomeCompleto,paciente.numeroDoBilhete,paciente.numeroDeTelefone,
 paciente.Sexo,paciente.email,paciente.dataDeNascimento
 from  agendamentodeconsulta join paciente on agendamentodeconsulta.Paciente_ID=paciente.idPaciente where Examinado=false and dataDaConsulta=curdate() and horaDaConsulta!=''");

        while ($dados = mysqli_fetch_assoc($stm)) {


            $Nome = $dados['nomeCompleto'];
            $NBI = $dados['numeroDoBilhete'];
            $Genero = $dados['Sexo'];
            $N_Tel = $dados['numeroDeTelefone'];
            $email = $dados['email'];
            $Data_Nascimento = $dados['dataDeNascimento'];
            $daconsulta=$dados['dataDaConsulta'];
            $hora=$hora['horaDaConsulta'];

            echo "
        
 <div class='paciente'>

        <span>Nome:$Nome</span><br>
        <hr>
        <span>Nº Bilhete:$NBI</span><br>
        <span>Género: $Genero</span><br>
        <span>Email: $email</span><br>
       <span>Data de Nascimento: $Data_Nascimento</span><br>
       <hr>
       <span>Data da Marcação: $daconsulta</span><br>
       <span>Hora da Marcação: $hora</span><br>
      
        </div>
             ";

        }

    }
    if (isset($_POST['Marcacoes'])) {
        $stm = $conexao->query("select * from paciente where Examinado=false and Data_Marcacao!=''");
        echo "     <table style=\"\" class=\"table w-100 table-hover table-striped table-responsive w-100\">
         <thead style=\"\">
         <tr style=\" \">
             
             <th>Nome Completo</th>
             <th>Nº do Bilhete</th>
             <th>Serviço</th>
             <th>Género</th>
             <th>Data da Consulta</th>
         </tr>
         </thead>
";
        while ($dados = mysqli_fetch_assoc($stm)) {


            $Nome = $dados['Nome'];
            $NBI = $dados['NBI'];
            $Genero = $dados['Genero'];
            $N_Tel = $dados['N_tel'];
            $Servico = $dados['Servico'];
            $Data_C = $dados['Data_Marcacao'];

            echo "
        
            
             <td>$Nome</td>
             <td>$NBI</td>
             <td>$Servico</td>
             <td>$Genero</td>
             <td>$Data_C</td>
             
             
             </tr>
             
             ";
        }
        echo "</table>";
    }
    if (isset($_POST['Pesquisar'])) {
        $info = $_POST['texto'];

        $stm = $conexao->query("select * from paciente where Nome LIKE '%$info%' or NBI LIKE '%$info%'");
        if ($stm and mysqli_num_rows($stm) != 0) {
            while ($dados = mysqli_fetch_assoc($stm)) {
                $NBI = $dados['NBI'];
                $factura = '';
                $ab = $conexao->query("select * from fatura where Id_Paciente='$NBI'");
                while ($da = mysqli_fetch_assoc($ab)) {
                    $factura = $da['fatura'];
                }
                $Nome = $dados['Nome'];

                $Genero = $dados['Genero'];
                $N_Tel = $dados['N_tel'];
                $Servico = $dados['Servico'];
                $Data_C = $dados['Data_Marcacao'];

                echo "

        <div class='paciente'>

        <span>Nome:$Nome</span><br>
        <span>Nº Bilhete:$NBI</span><br>
        <span>Género: $Genero</span>
       
        <a target='_blank' href='$factura' class='btn-primary btn form-control'>Fatura</a>
        </div>
        
          ";
            }
        } else {
            echo "
        Paciente Não Encontrado
        ";
        }
    }
    if (isset($_POST['Sair'])) {
        session_start();
        session_unset();
        session_destroy();


        echo "Funcionou";
    }
}