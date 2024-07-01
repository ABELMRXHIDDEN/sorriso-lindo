<?php

require_once 'Dbh.php';
class Servicos extends Dbh
{

    public static function exibirServicos(){
        $stm = (new Servicos())->connect()->query("select * from servicos order by nome");
        $i = 0;
        $info = array();
        while ($dados = $stm->fetch()) {
            $info[$i] = $dados;
            $i++;
        }
        return $info;
    }
    public static function exibirServico($id){
        $stm = (new Servicos())->connect()->query("select * from servicos where idservicos='$id'");
        return $stm->fetch();
    }
}
