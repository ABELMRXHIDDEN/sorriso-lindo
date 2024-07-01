<?php

class Dbh
{
private string $usename="root";
private string $pwd="";
private string $host="localhost";
private string $dbname="sorrisolindo2";

protected function connect(){

    try {
        $dsn='mysql:host='.$this->host.';dbname='.$this->dbname;
        $pdo=new PDO($dsn,$this->usename,$this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $pdo;

    }catch (PDOException $erro){
        echo $erro->getMessage();
    }
}
}