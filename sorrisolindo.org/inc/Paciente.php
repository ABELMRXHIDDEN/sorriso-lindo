<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
class Paciente extends Dbh
{
    protected string $nomeCompleto;
    protected string $numeroDoBilhete;
    protected string $dataDeNascimento;
    protected string $sexo;
    protected string $numeroDeTelefone;
    protected string $dataMacacao;
    protected string $morada;
    protected string $horaMarcacao;
    protected string $servico;
    protected string $idUser;
    protected string $idDentista;

    public function __construct($nome, $nbi, $data_nas, $sexo, $numeroDeTelefone, $dataMacacao, $morada, $horaMarcacao, $servico, $idUser,$idDentista)
    {
        $this->nomeCompleto = $nome;
        $this->numeroDoBilhete = $nbi;
        $this->dataDeNascimento = $data_nas;
        $this->sexo = $sexo;
        $this->numeroDeTelefone = $numeroDeTelefone;
        $this->dataMacacao = $dataMacacao;
        $this->morada = $morada;
        $this->horaMarcacao = $horaMarcacao;
        $this->servico = $servico;
        $this->idUser = $idUser;
        $this->idDentista=$idDentista;
    }

    /**
     * @return mixed
     */
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * @param mixed $nomeCompleto
     */
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;
    }

    /**
     * @return mixed
     */
    public function getNumeroDoBilhete()
    {
        return $this->numeroDoBilhete;
    }

    /**
     * @param mixed $numeroDoBilhete
     */
    public function setNumeroDoBilhete($numeroDoBilhete)
    {
        $this->numeroDoBilhete = $numeroDoBilhete;
    }

    /**
     * @return mixed
     */
    public function getDataDeNascimento()
    {
        return $this->dataDeNascimento;
    }

    /**
     * @param mixed $dataDeNascimento
     */
    public function setDataDeNascimento($dataDeNascimento)
    {
        $this->dataDeNascimento = $dataDeNascimento;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getNumeroDeTelefone()
    {
        return $this->numeroDeTelefone;
    }

    /**
     * @param mixed $numeroDeTelefone
     */
    public function setNumeroDeTelefone($numeroDeTelefone)
    {
        $this->numeroDeTelefone = $numeroDeTelefone;
    }

    /**
     * @return mixed
     */
    public function getDataMacacao()
    {
        return $this->dataMacacao;
    }

    /**
     * @param mixed $dataMacacao
     */
    public function setDataMacacao($dataMacacao)
    {
        $this->dataMacacao = $dataMacacao;
    }

    /**
     * @return mixed
     */
    public function getMorada()
    {
        return $this->morada;
    }

    /**
     * @param mixed $morada
     */
    public function setMorada($morada)
    {
        $this->morada = $morada;
    }

    /**
     * @return mixed
     */
    public function getHoraMarcacao()
    {
        return $this->horaMarcacao;
    }

    /**
     * @param mixed $horaMarcacao
     */
    public function setHoraMarcacao($horaMarcacao)
    {
        $this->horaMarcacao = $horaMarcacao;
    }

    /**
     * @return mixed
     */
    public function getServico()
    {
        return $this->servico;
    }

    /**
     * @param mixed $servico
     */
    public function setServico($servico)
    {
        $this->servico = $servico;
    }

    public function addPaciente()
    {

        try {
            $sql = "insert into paciente(Id, Nome, NBI, Genero, N_tel, Residencia, Servico, Data_Nascimento, Hora, Data_Marcacao, Id_user, Examinado,Data_Cadas,Hora_Cad) values (0,?,?,?,?,?,?,?,?,?,?,false,curdate(),curtime())";
            $stm = $this->connect()->prepare($sql);
            $stm->execute([$this->nomeCompleto, $this->numeroDoBilhete, $this->sexo, $this->numeroDeTelefone, $this->morada, $this->servico, $this->dataDeNascimento, $this->horaMarcacao, $this->dataMacacao, $this->idUser]);
            return true;
        } catch (PDOException $e) {
            echo "Erro!" . $e->getMessage();
            return false;
        }
    }

    public static function updatePaciente($nome, $id, $data_nas, $sexo, $numeroDeTelefone, $dataMacacao, $morada, $horaMarcacao, $servico)
    {
        try {
            $sql = "update paciente set Nome = ?, Genero = ?, N_tel = ?, Residencia = ?, Servico = ?, Data_Nascimento = ?, Hora = ?, Data_Marcacao = ? where (Id = ?);";
            $stm = (new Dbh)->connect()->prepare($sql);
            $stm->execute([$nome, $sexo, $numeroDeTelefone, $morada, $servico, $data_nas, $horaMarcacao, $dataMacacao, $id]);
            return true;

        } catch (PDOException $e) {
            echo "Erro! " . $e->getMessage();
            return false;
        }


    }


    public function criarFactura($total)
    {
        $options = new \Dompdf\Options();
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $total=number_format($total,"2",",",".");
        $dompdf->loadHtml("
     <style>
     p {
     font-family: Arial sans-serif;
     font-size: 13pt;
     text-align: justify;
     text-transform: uppercase;
     }
</style>
    
        <title>Comprovativo de Cadastro | $this->nomeCompleto</title>
       
        
    <img width='20%' id=\"logo\" src=\"http://192.168.1.134/sorrisolindo.org/icones/imagens/logo.png\">
    <h1 style='text-align: center'>Comprovativo de Cadastramento</h1>
          <hr>
          <h2>Dados do Paciente</h2>
          <p>Nome Completo: $this->nomeCompleto</p>
          <p>Nº do Bilhete: $this->numeroDoBilhete</p>
          <p>Data de Nascimento: $this->dataDeNascimento</p>
          <p>Género: $this->sexo</p>
          <p>Morada: $this->morada</p>
          <p>Tipo de Exame: $this->servico</p>
          <p>Data Marcação: $this->dataMacacao</p>
          <p>Hora da Marcação: $this->horaMarcacao</p>
          <h2>Total a Pagar: $total</h2>
</footer>
           ");
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }

    public static function getPaciente($bi)
    {
        $sql = "select * from paciente where NBI=?";
        $stm = (new Paciente)->connect()->prepare($sql);
        $stm->execute([$bi]);

        return $stm;
}
    public function salvarFactura($idEmissor,$idPaciente,$total,$factura){
        $sql="insert into fatura(id, id_emissor, id_paciente, total, fatura) VALUES (0,'$idEmissor','$idPaciente','$total','$factura')";
        $stm=$this->connect()->query($sql);
        return true;
    }
    public static function getTotalPaciente(){
        $total=0;
        $stm=(new Paciente)->connect()->query("select * from paciente");
        while ($total=mysqli_fetch_assoc($stm)){
            $total++;
        }
        return $total;
    }
}