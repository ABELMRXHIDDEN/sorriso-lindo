<?php
class Dbh
{
    private string $usename="root";
    private string $pwd="Ao23gev@devphp";
    private string $host="127.0.0.1";
    private string $dbname="sorrisolindo";

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