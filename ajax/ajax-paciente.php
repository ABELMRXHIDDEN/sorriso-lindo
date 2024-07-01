<?php
declare(strict_types=1);
require_once '../classes/Paciente.php';

    $dados=$_POST;
    if (isset($dados['Adicionar'])){
    try {
        $res=Paciente::cadastrarPaciente($dados['Nome'],$dados['NBI'],$dados['Sexo'],$dados['Tel'],$dados['Endereco'],$dados['Email'],$dados['dataNascimento']);
        if($res){
            echo "Paciente Cadastrado Com Sucesso!";
        }
        else{
            echo "Erro: já um paciente cadastrado com o Nº de Bilhete Preenchido";
        }
    }catch (PDOException $erro){
        echo "Erro ".$erro->getMessage();
    }
    }

if (isset($dados['exibirPacientes'])){
    $dados=Paciente::listarPacientes();

    echo json_encode($dados);

}
if (isset($dados['Pesquisar'])){
    $nbi=$dados['NBI'];
    $dados=Paciente::filtrarPaciente($nbi);

    echo json_encode($dados);

}
if (isset($dados['Eliminar'])){
    $nbi=$dados['NBI'];
    $info=Paciente::eliminarPaciente($nbi);


}
if(isset($dados['Actulizar'])){
    try {
        $res=Paciente::actualizarPaciente($dados['Nome'],$dados['NBI'],$dados['Sexo'],$dados['Tel'],$dados['Endereco'],$dados['Email'],$dados['dataNascimento']);
        if($res){
            echo "Dados Actualizados com sucesso!";
        }
        else{
            echo "Erro ao Actualizar ";
        }
    }catch (PDOException $erro){
        echo "Erro ".$erro->getMessage();
    }
}
if (isset($_POST['Dashboard'])){
    $total = Paciente::totalPaciente();
    echo $total;
}
if (isset($dados['pesquisarPaciente'])){
    echo json_encode(Paciente::pesquisarPaciente($dados['pesquisa']));
}
if (isset($dados['SalvarRes'])){
echo json_encode(Paciente::questoes($dados['Id'],$dados['Pergunta'],$dados['Resposta']));
}
if (isset($dados['ActulizarRes'])){
    echo json_encode(Paciente::actualizarquestoes($dados['Id'],$dados['Qt1'],$dados['Qt2'],$dados['Qt3'],$dados['Qt4'],$dados['Qt5'],$dados['Qt6'],$dados['Qt7']));
}


