<?php
require_once "conexão.php";
require_once 'vendor/autoload.php';
require_once 'inc/Dbh.php';
use Dompdf\Dompdf;
class Fatura extends Dbh
{

protected string $idDentista;
protected string $idPaciente;
protected string $total;
protected string $caminho;

public function salvarFactura($idPaciente,$idDentista,$preco,$caminho){
    $sql="insert into fatura(ID, Paciente_ID, Dentista_ID, PreçoTotal,DataFatura, caminho) VALUES (0,?,?,?,curdate(),?)";
    $stm=$this->connect()->prepare($sql);
    $stm->execute([$idPaciente,$idDentista,$preco,$caminho]);

    return true;
}

    /**
     * @throws Exception
     */
    public function emitirFactura($nome, $bi, $email, $datanas, $tel, $morada, $sexo, $datamar, $horamar, $servico, $Dentista, $total){
    $options = new \Dompdf\Options();
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);
    $dompdf=new Dompdf($options);

    $stm=$this->connect()->query("select Nome from dentista where ID='$Dentista'");
    $dados=$stm->fetch();
    $nomeD=$dados['Nome'];

    $stm=$this->connect()->query("select nomeProcedimento,descricao from procedimento where ID='$servico'");
    $dados=$stm->fetch();
    $nomeS=$dados['nomeProcedimento'];
    $decricao=$dados['descricao'];
    $dataemissao=date("d-m-Y H:i:s");
    $datamar =new DateTime($datamar);
    $datanas=new DateTime($datanas);
    $ndatamar=$datamar->format("d/m/Y");
    $ndatanas=$datanas->format("d/m/Y");
    $totalkz=number_format($total,2,',','.');
    $dompdf->loadHtml("
     <style>
     p {
     font-family: Arial sans-serif;
     font-size: 11pt;
     text-align: justify;
     text-transform: uppercase;
     }
</style>
    
        <title>Comprovativo de Cadastro | $nome</title>
       
        
    <img width='20%' id=\"logo\" src=\"http://192.168.1.134/icones/imagens/logo.png\">
    <h1 style='text-align: center'>Comprovativo de Marcação e Pagamento</h1>
    
    <p>Data de Emissão: $dataemissao</p>
     <p>Emitido por : Albano Colembi</p>
          <hr>
          <h2>Dados do Paciente</h2>
          <p>Nome Completo: $nome</p>
          <p>Nº do Bilhete: $bi</p>
          <p>Data de Nascimento: $ndatanas</p>
          <p>Género: $sexo</p>
          <p>Morada: $morada</p>
          <h2>Informações Sobre a Marcação</h2>
          <p>Dentista: $nomeD</p>
          <p>Tipo de Exame: $nomeS</p>
          <p>Descrição: $decricao</p>
          <p>Data Marcação: $ndatamar</p>
          <p>Hora da Marcação: $horamar</p>
          <h2>Total Pago: $totalkz</h2>
          
    
    ");
    $dompdf->render();
    return $dompdf->output();
}
    public function actualizarFactura($nome, $bi, $email, $datanas, $tel, $morada, $sexo, $datamar, $horamar, $servico, $Dentista, $total){
        $options = new \Dompdf\Options();
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);
        $dompdf=new Dompdf($options);
        $st=$this->connect()->query("select * from paciente where numeroDoBilhete='$bi'");

        $info=$st->fetch();
        $id=$info['idPaciente'];
        $datafactura=$info['DataFatura'];
        $caminho=$info['caminho'];
        $stm=$this->connect()->query("select Nome from dentista where ID='$Dentista'");
        $dados=$stm->fetch();
        $nomeD=$dados['Nome'];

        $stm=$this->connect()->query("select nomeProcedimento,descricao from procedimento where ID='$servico'");
        $dados=$stm->fetch();
        $nomeS=$dados['nomeProcedimento'];
        $decricao=$dados['descricao'];
        $dataemissao=date("d-m-Y H:i:s");
        $datamar =new DateTime($datamar);
        $datanas=new DateTime($datanas);
        $ndatamar=$datamar->format("d/m/Y");
        $ndatanas=$datanas->format("d/m/Y");
        $totalkz=number_format($total,2,',','.');
        $dompdf->loadHtml("
     <style>
     p {
     font-family: Arial sans-serif;
     font-size: 11pt;
     text-align: justify;
     text-transform: uppercase;
     }
</style>
    
        <title>Comprovativo de Cadastro | $nome</title>
       
        
    <img width='20%' id=\"logo\" src=\"http://192.168.1.134/icones/imagens/logo.png\">
    <h1 style='text-align: center'>Comprovativo de Marcação e Pagamento</h1>
    
    <p>Data de Emissão: $dataemissao</p>
          <hr>
          <h2>Dados do Paciente</h2>
          <p>Nome Completo: $nome</p>
          <p>Nº do Bilhete: $bi</p>
          <p>Data de Nascimento: $ndatanas</p>
          <p>Género: $sexo</p>
          <p>Morada: $morada</p>
          <h2>Informações Sobre a Marcação</h2>
          <p>Dentista: $nomeD</p>
          <p>Tipo de Exame: $nomeS</p>
          <p>Descrição: $decricao</p>
          <p>Data Marcação: $ndatamar</p>
          <p>Hora da Marcação: $horamar</p>
          <h2>Total Pago: $totalkz</h2>
          
    
    ");
        $dompdf->render();
        return array($dompdf->output(),$caminho);
    }

}