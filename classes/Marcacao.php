<?php
declare(strict_types=1);
require '../vendor/autoload.php';
require_once 'Dbh.php';
require 'Paciente.php';
use Dompdf\Dompdf;
class Marcacao extends Dbh
{
    public static function existeMarcacao($data, $hora)
    {
        $stm = (new Marcacao())->connect()->query("select * from marcacao where horamarcacao='$hora' and datamarcacao='$data'");

        if ($stm->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function AdicionarMarcacao($nbi, $data, $hora)
    {
        $id = Paciente::acharId($nbi);
        $nome=uniqid().".pdf";
        $caminho=__DIR__."../../documentos/marcacao/".$nome;
        $caminho2="documentos/marcacao/".$nome;
        file_put_contents($caminho,self::criarComprovativo($nbi,$data,$hora));
        return (new Marcacao())->connect()->query("insert into marcacao values (0,'$id',null,'$data','$hora',false,'$caminho2')");


    }


    public static function listarMarcacoes()
    {
        try {


            $stm = (new Marcacao())->connect()->query('select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroBilhete,m.comprovativo from marcacao as m join paciente as p on m.idpaciente=p.idpaciente where status=false order by m.datamarcacao,m.horamarcacao');
            $i = 0;
            $info = array();
            while ($dados = $stm->fetch()) {
                $info[$i] = $dados;
                $i++;
            }
            return $info;

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function listarMarcacoes2()
    {
        try {


            $stm = (new Marcacao())->connect()->query('select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroBilhete,m.comprovativo from marcacao as m join paciente as p on m.idpaciente=p.idpaciente');
            $i = 0;
            $info = array();
            while ($dados = $stm->fetch()) {
                $info[$i] = $dados;
                $i++;
            }
            return $info;

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function listarMarcacoesfac2()
    {
        try {


            $stm = (new Marcacao())->connect()->query('select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroBilhete,m.comprovativo,f.total from marcacao as m join paciente as p on m.idpaciente=p.idpaciente join factura as f on f.idmarc=m.idmarcacao');
            $i = 0;
            $info = array();
            while ($dados = $stm->fetch()) {
                $info[$i] = $dados;
                $i++;
            }
            return $info;

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function AtendidosNaoAtendidos()
    {
        try {


            $stm = (new Marcacao())->connect()->query('select m.idmarcacao,m.status,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,
p.numeroBilhete,m.comprovativo from marcacao as m join paciente as p on m.idpaciente=p.idpaciente where m.datamarcacao=curdate()');
            $i = 0;
            $at=0;
            $nat=0;

            while ($dados = $stm->fetch()) {
                if ($dados['status']){
                    $at++;
                }
                else{
                    $nat++;
                }
            }
            return array($at,$nat);

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }

    public static function pesquisarMarcacao($pesquisa)
    {
        try {


            $stm = (new Marcacao())->connect()->query("select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroBilhete,m.comprovativo from marcacao as m join paciente as p on m.idpaciente=p.idpaciente where status=false and p.nomeCompleto LIKE '%$pesquisa%' or p.numeroBilhete LIKE '%$pesquisa%'  order by m.datamarcacao,m.horamarcacao ");
            $i = 0;
            $info = array();
            while ($dados = $stm->fetch()) {
                $info[$i] = $dados;
                $i++;
            }
            return $info;

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }

    public static function listarIdpacienteMarc($idMarcacao)
    {
        try {


            $stm = (new Marcacao())->connect()->query("select idpaciente from marcacao where idmarcacao='$idMarcacao'");


            return $stm->fetch();

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function listarMarcacao($idMarcacao)
    {
        try {


            $stm = (new Marcacao())->connect()->query("select m.idmarcacao,m.horamarcacao,m.datamarcacao,i.Pergunta,i.Resposta,p.nomeCompleto,p.genero,
p.idpaciente,p.numeroBilhete,p.dataNascimento 
from marcacao as m join paciente as p on m.idpaciente=p.idpaciente left join  informacoes_adicionais as i on
i.ID_paciente=p.idpaciente  where m.idmarcacao='$idMarcacao'");


            return $stm->fetch();

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }

    public static function marcacoeshoje()
    {
        try {


            $stm = (new Marcacao())->connect()->query("select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroBilhete,p.dataNascimento from marcacao as m join paciente as p on m.idpaciente=p.idpaciente where datamarcacao=curdate() and status=false");


            return $stm->rowCount();

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function listarmarcacoeshoje()
    {
        try {


            $stm = (new Marcacao())->connect()->query("select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroTelefone,p.numeroBilhete,p.dataNascimento from marcacao as m join paciente as p on m.idpaciente=p.idpaciente where datamarcacao=curdate() and status=false order by m.horamarcacao");

             $i=0;
            $info = array();
            while ($dados = $stm->fetch()) {
                $info[$i] = $dados;
                $i++;
            }
            return $info;

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function todasMarcacoes()
    {
        try {


            $stm = (new Marcacao())->connect()->query("select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroBilhete,p.dataNascimento from marcacao as m join paciente as p on m.idpaciente=p.idpaciente");


            return $stm->rowCount();

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function pacientesatendidos()
    {
        try {


            $stm = (new Marcacao())->connect()->query("select m.idmarcacao,m.horamarcacao,m.datamarcacao,p.nomeCompleto,p.genero,p.numeroBilhete,p.dataNascimento from marcacao as m join paciente as p on m.idpaciente=p.idpaciente where status=true");


            return $stm->rowCount();

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function eliminarMarcacao($idMarcacao)
    {
        try {


            $stm = (new Marcacao())->connect()->query("set foreign_key_checks=0;delete from marcacao where idmarcacao='$idMarcacao';set foreign_key_checks=1;");

            return true;

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function actualizarMarcacao($idMarcacao,$data,$hora)
    {
        try {


            $stm = (new Marcacao())->connect()->query("update marcacao set horamarcacao='$hora',datamarcacao='$data' where idmarcacao='$idMarcacao'");

            return true;

        } catch (PDOException $e) {
            echo "Erro : " . $e->getMessage();
        }
    }
    public static function criarComprovativo($nbi,$datamar,$horamar)
    {
        $stm=Paciente::filtrarPaciente($nbi);
        $nome=$stm['nomeCompleto'];
        $nbi=$stm['numeroBilhete'];
        $datanas=$stm['dataNascimento'];
        $genero=$stm['genero'];
        $endereco=$stm['endereco'];
        $options = new \Dompdf\Options();
        $options->setChroot(__DIR__);

        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml("
     <style>
     p {
     font-family: Calibri, sans-serif;
     font-size: 13pt;
     text-align: justify;
     text-transform: initial;
     }
</style>
    
<style>
     * {
     font-family: Calibri, sans-serif;
     }
     p {
     font-family: Calibri, sans-serif;
     font-size: 13pt;
     text-align: justify;
     text-transform: initial;
     }
    tr.titulo {
    background-color: cornflowerblue;
    padding: 20px;
    border-radius: 20px;
    font-weight: bold;
    color: rgba(255,255,255,0.81);
    }
    td {
    padding: 10px;
    
    }
    #cabec td {
    padding: 0;
    }
    #cabec p{
    font-size: 10pt;
    }
</style>
    
       
        <title>Factura | $nome</title>
       
        
 
    <table id='cabec' style='width: 100%;'>
    <tr>
    <td width='30%' >   <img src='".__DIR__."/logo.jpg' width='80%' alt='logotipo'></td>
    <td width='70%' ><h2 style='color: cornflowerblue;font-weight: bold;'>Clínica Dentária Sorriso Lindo</h2>
    <p>Contacto: +244 927 910 057</p>
    <p>Email: sorrisolindo71@gmail.com</p>
    </td>
</tr>
</table>
          <hr>
          <h2 style='color: cornflowerblue;font-weight: bold;'>Comprovativo de Marcação</h2>
          <table style='width: 100%'>
          <tr>
          <td style='width: 50%'>
          <h2 style='color: cornflowerblue'>Dados do Paciente</h2>
          <p>Nome Completo: $nome</p>
          <p>Nº do Bilhete: $nbi</p>
          <p>Data de Nascimento:   $datanas</p>
          <p>Género: $genero</p>
          <p>Endereço: $endereco</p>
        
          </td>
          <td style='width: 50%'>
<h2 style='color: cornflowerblue'>Informacoes da Marcação</h2>
          <p>Data Marcação: $datamar</p>
          <p>Hora da Marcação: $horamar</p> 
          </td>
          </tr>
     
   
     
      <footer style='position: fixed;bottom: 0;display: flex;align-items: center;justify-content: center'>
      <p style='font-size: 10pt;text-align: center'>Emitido Aos :".date('d-m-Y')." Por Albano Colembi</p>
      
</footer>
           ");

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }

    public static function totalPacienteAtendidos(){
        $stm=(new Marcacao())->connect()->query("select * from marcacao where status=true");

        return $stm->rowCount();
    }
    public static function terminarConsulta($id){
        $stm=(new Marcacao())->connect()->query("UPDATE `sorrisolindo`.`marcacao` SET `status` = true WHERE (`idmarcacao` = '$id')");

        return $stm;
    }
}
