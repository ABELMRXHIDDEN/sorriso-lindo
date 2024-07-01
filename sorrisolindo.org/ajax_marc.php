<?php
require_once 'conexão.php';
if (isset($_POST['Servico'])){
    $info=array();
    $stmt= $conexao->query('select * from procedimento');
    $i=0;
    while ($dados=mysqli_fetch_assoc($stmt)){
        $info[$i]=$dados;
        $i++;
    }
    $info=json_encode($info);
    echo $info;
}
else if (isset($_POST['Total'])){
    $id=$_POST['ID'];
    $stmt= $conexao->query("select preco from procedimento where ID='$id'");
    $i=0;
    $dados=mysqli_fetch_assoc($stmt);
    $dados=json_encode($dados);
    echo $dados;
}
else if (isset($_POST['Dentista'])){
    $i=0;
    $info=array();
    $stmt= $conexao->query("select * from dentista");
    while ($dados=mysqli_fetch_assoc($stmt)){
        $info[$i]=$dados;
        $i++;
    }
    $info=json_encode($info);
    echo $info;
}


