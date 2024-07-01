<?php
declare(strict_types=1);
require '../vendor/autoload.php';
require_once 'Dbh.php';
use Dompdf\Dompdf;

class Factura extends Dbh
{
    public static function addFactura($idmarc,$idservico,$qtd){
        $stm=(new Factura)->connect()->query("insert into consultas values (0,'$idmarc','$idservico',curdate(),'$qtd')");
    }
    public static function emitirfactura($idmarc,$total){
        $stm=(new Factura)->connect()->query("insert into factura values (0,'$idmarc','$total',false,'')");
    }
    public static function salvarRelatorio($idmarc,$iduser,$relatorio){
        try {
            return (new Factura)->connect()->query("set foreign_key_checks=0;insert into relatorio values (0,'$iduser','$idmarc','$relatorio')");
        }catch (PDOException $e){
            echo "Erro ".$e->getMessage();
        }
    }

    public static function exibirFactura(){
    try {
        $stm= (new Factura)->connect()->query("select p.nomeCompleto,p.numeroBilhete,p.genero,f.status,f.factura,m.datamarcacao,m.horamarcacao,m.idmarcacao from factura as f join marcacao as m on m.idmarcacao=f.idmarc join paciente as p
        on m.idpaciente=p.idpaciente where m.status=true");

        $i = 0;
        $info = array();
        while ($dados = $stm->fetch()) {
            $info[$i] = $dados;
            $i++;
        }
        return $info;
    }catch (PDOException $e){
        echo "Erro ".$e->getMessage();
    }
}
    public static function dadosFactura($idMarc){
        try {
            $stm= (new Factura)->connect()->query("select * from factura as f join marcacao as m on m.idmarcacao=f.idmarc join paciente as p
        on m.idpaciente=p.idpaciente where m.idmarcacao='$idMarc'");


            return $stm->fetch();
        }catch (PDOException $e){
            echo "Erro ".$e->getMessage();
        }
    }

    public static function PagarEmitirFactura($idMarc){
        try {
            $stm= (new Factura)->connect()->query("select * from factura as f join marcacao as m on m.idmarcacao=f.idmarc join paciente as p
        on m.idpaciente=p.idpaciente where m.idmarcacao='$idMarc'");
            $a=$stm->fetch();
            $idFact=$a['idfactura'];
            $nome=uniqid().".pdf";
            $caminho=__DIR__."../../documentos/facturas/".$nome;
            $caminho2="documentos/facturas/".$nome;
            file_put_contents($caminho,self::criarFactura($idMarc));
            $stm= (new Factura)->connect()->query("UPDATE `sorrisolindo`.`factura` SET `status` = '1', `factura` = '$caminho2' WHERE (`idfactura` = '$idFact');
");

return $stm;
        }catch (PDOException $e){
            echo "Erro ".$e->getMessage();
        }
    }
    public static function criarFactura($idMarc)
    {
        $st=(new Factura())->connect()->query("select p.nomeCompleto,p.numeroBilhete,p.numeroTelefone,f.total,f.idfactura,p.genero,m.datamarcacao,m.horamarcacao,s.nome,s.descricao,s.preco,c.qtd from factura as f join marcacao as m on m.idmarcacao=f.idmarc join paciente as p
        on m.idpaciente=p.idpaciente join consultas as c on c.idmarcacao=m.idmarcacao join servicos as s on s.idservicos=c.idservico where m.idmarcacao='$idMarc'");
       $stm="";
        $dados="";
        $nome="";
        $nbi="";

        $genero="";
$idFac="";
        $datamar="";
        $horamar="";
        $total="";
        while ($stm=$st->fetch()){
            $dados.="<tr><td>".$stm['nome']."</td>
          <td>".$stm['descricao']."</td>
          <td>".(number_format(intval($stm['preco']),2,',','.'))." Kz</td>
          <td>".$stm['qtd']."</td>
          <td>".(number_format(intval(($stm['preco']*$stm['qtd'])),2,',','.'))." Kz</td></tr>";

            $nome=$stm['nomeCompleto'];
            $nbi=$stm['numeroBilhete'];

            $genero=$stm['genero'];
$idFac=$stm['idfactura'];
            $datamar=$stm['datamarcacao'];
            $horamar=$stm['horamarcacao'];
            $total=number_format(intval($stm['total']),2,',','.');
        }

        $options = new \Dompdf\Options();
        $options->setChroot(__DIR__);



        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml("
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
        <p style='font-weight: bold;color: cornflowerblue'> Factura Nº: $idFac</p> 
          <table style='width: 100%'>
          <tr>
          <td style='width: 50%'>
          <h2 style='color: cornflowerblue'>Dados do Paciente</h2>
          <p>Nome Completo: $nome</p>
          <p>Nº do Bilhete: $nbi</p>
          </td>
          <td style='width: 50%'>
<h2 style='color: cornflowerblue'>Informacoes da Marcação</h2>
          <p>Data Marcação: $datamar</p>
          <p>Hora da Marcação: $horamar</p> 
          </td>
          </tr>
                   </table>
                   <center>
          <table style='width: 100%' cellspacing='0'>
          <tr class='titulo'>
          <td>Serviço</td>
          <td>Descrição</td>
          <td>Preço</td>
          <td>Qtd</td>
          <td>Total</td>
          
          $dados
          <tr class='titulo'>
          <td colspan='4'>Total</td>
          <td>$total Kz</td>
</tr>
          </table>
          </center>
          
          
     
      <footer style='position: fixed;bottom: 0;display: flex;align-items: center;justify-content: center'>
      <p style='font-size: 10pt;text-align: center'>Emitido Aos :".date('d-m-Y')." Por Albano Colembi</p>
      
</footer>
           ");
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->output();
    }
}
