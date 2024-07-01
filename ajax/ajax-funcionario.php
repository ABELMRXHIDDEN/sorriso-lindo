<?php
declare(strict_types=1);
require_once '../classes/Funcionario.php';

    $dados=$_POST;
    if (isset($dados['Add'])){
    try {
        $res=Funcionario::add($dados['IdUser'],$dados['Nome'],$dados['NBI'],$dados['Sexo'],$dados['Tel'],$dados['Endereco'],$dados['dataNascimento'],$dados['Cargo'],$dados['Salario']);
        if($res){
            echo "Funcionario Cadastrado Com Sucesso!";
        }
       
    }catch (PDOException $erro){
        echo "Erro ".$erro->getMessage();
    }
}
