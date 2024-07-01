<?php
require '../classes/Marcacao.php';
$dados=$_POST;

if (isset($dados['verificarMarcacao'])){
    $res=Marcacao::existeMarcacao($dados['DataMarcacao'],$dados['HoraMarcacao']);

      echo json_encode($res);
}
if(isset($dados['AddMarcacao'])){
    try {
        if (Marcacao::AdicionarMarcacao($dados['NBI'], $dados['DataMarcacao'], $dados['HoraMarcacao'])){
            echo "Marcação Efectuada Com sucesso!";
        }
        else {
            echo "Erro Ao Marcar";
        }

        }catch (PDOException $e){
        echo "Erro ".$e->getMessage();
    }

}
if (isset($dados['Marchoje'])){
    echo json_encode(Marcacao::marcacoeshoje());
}
if (isset($dados['exibirMarcacao'])){
$res=Marcacao::listarMarcacoes();

echo json_encode($res);

}
if (isset($dados['exibirMarcacao2'])){
    $res=Marcacao::listarMarcacoes2();

    echo json_encode($res);

}
if (isset($dados['exibirMarcacao3'])){
    $res=Marcacao::listarMarcacoesfac2();

    echo json_encode($res);

}

if (isset($dados['PesquisarMarc'])){
    $res=Marcacao::pesquisarMarcacao($dados['infor']);

    echo json_encode($res);

}
if (isset($dados['Pesquisar'])){
echo json_encode(Marcacao::listarMarcacao($dados['ipMarcacao']));
}

if (isset($dados['Eliminar'])){
Marcacao::eliminarMarcacao($dados['idMarcacao']);
}
if (isset($dados['Actulizar'])){
    Marcacao::actualizarMarcacao($dados['ID'],$dados['Data'],$dados['Hora']);
    echo "Dados da Marcação foram actualizados";
}
if (isset($dados['PacienteAtendido'])){
    echo json_encode(Marcacao::pacientesatendidos());
}
if (isset($dados['TodasMarc'])){
echo json_encode(Marcacao::todasMarcacoes());
}
if (isset($dados['listarMarchoje'])){
    echo json_encode(Marcacao::listarmarcacoeshoje());
}
if (isset($dados['PegarId'])){
echo json_encode(Marcacao::listarMarcacao($dados['IdMar']));
}
if (isset($dados['PegarIdmarc'])){
    echo json_encode(Marcacao::listarIdpacienteMarc($dados['IdMar']));
}
if (isset($dados['pacienteAt'])){
    echo json_encode(Marcacao::pacientesatendidos());
}
if (isset($dados['totalMarc'])){
    echo json_encode(Marcacao::todasMarcacoes());
}
if (isset($dados['Terminar'])){
    echo json_encode(Marcacao::terminarConsulta($dados['Id']));
}
if (isset($dados['totalAtendidosHoje'])){
    echo json_encode(Marcacao::terminarConsulta($dados['Id']));
}
if (isset($dados['grafico1'])){
    echo json_encode(Marcacao::AtendidosNaoAtendidos());
}