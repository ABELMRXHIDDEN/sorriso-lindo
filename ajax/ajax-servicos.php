<?php
declare(strict_types=1);
require_once '../classes/Servicos.php';
$dados=$_POST;
if (isset($dados['ExibirSer'])){
echo json_encode(Servicos::exibirServicos());
}
if (isset($dados['ExibirNm'])){
    echo json_encode(Servicos::exibirServico($dados['Id']));
}
