<?php
require '../classes/Usuario.php';
$dados=$_POST;

if (isset($dados['pegarFunc'])){
echo json_encode(Usuario::pesquisarUsuario($dados['id']));
}

if (isset($_FILES['fotografia'])){

    $nomeArquivo = $_FILES["fotografia"]["name"];
    $caminhoTemp = $_FILES["fotografia"]["tmp_name"];
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
    if ($extensao=='png' or $extensao=='jpeg' or $extensao=='jpg'){
        $novoNome=uniqid(date('d-m-Y')).'.'.$extensao;
        // Move o arquivo temporário para o destino desejado
        $caminhoDestino = __DIR__ . '/../documentos/img-usuario/'.$novoNome;

        $caminhodb='documentos/img-usuario/'. $novoNome;
        if (move_uploaded_file($caminhoTemp, $caminhoDestino)){
            chmod(__DIR__ . '/../documentos/img-usuario', 0644);
           echo json_encode(array(true,$caminhodb));
        }

    }
    else{
        echo json_encode("A extensão do arquivo é inválida $extensao");
    }
}
if (isset($_POST['Actualizar'])){
    echo json_encode(Usuario::actualizaruser($dados['id'],$dados['nome'],$dados['nbi'],$dados['datanas'],
    $dados['tel'],$dados['morada'],$dados['sexo'],$dados['Senha'],$dados['Email'],$dados['Foto']));
}
if (isset($_POST['Actualizar2'])){
    echo json_encode(Usuario::actualizarusersf($dados['id'],$dados['nome'],$dados['nbi'],$dados['datanas'],
        $dados['tel'],$dados['morada'],$dados['sexo'],$dados['Senha'],$dados['Email']));
}
if (isset($dados['exibirusuario'])){
    echo json_encode(Usuario::listarUsuario());
}
if (isset($dados['Adicionar'])){
    echo json_encode(Usuario::inserirUsuario($dados['Email'],$dados['Senha']));
}
