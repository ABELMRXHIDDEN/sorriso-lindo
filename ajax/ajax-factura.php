<?php
declare(strict_types=1);
require_once '../classes/Factura.php';

$dados=$_POST;

if (isset($dados['Factura'])){
Factura::addFactura($dados['IdMar'],$dados['IdSer']);
}
if (isset($dados['EmitirFactura'])){
    Factura::emitirfactura($dados['IdMar'],$dados['Total']);
}
if (isset($dados['SalvarRelatorio'])){

    echo json_encode(Factura::salvarRelatorio($dados['IdMarcacao'],$dados['IdDentista'],$dados['Relatorio']));
}

if (isset($dados['exibirMarcacao'])){

    echo json_encode(Factura::exibirFactura());
}
if (isset($dados['exibirListafac'])){

    echo json_encode(Factura::dadosFactura($dados['Id']));
}
if (isset($dados['ActPag'])){
    echo json_encode(Factura::PagarEmitirFactura($dados['Id']));
}
if (isset($dados['addConsulta'])){
    echo json_encode(Factura::addFactura($dados['IdMar'],$dados['Ser'],$dados['Qtd']));
}
