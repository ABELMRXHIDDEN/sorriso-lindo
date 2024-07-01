<?php

require_once __DIR__.'/vendor/autoload.php';
use Dompdf\Dompdf;

$options = new \Dompdf\Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);


// Render the HTML as PDF


// Output the gen
try {
    $dompdf->loadHtmlFile(__DIR__ . "/fatura/modelo/paciente.php");

// (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4');

    $dompdf->render();
    $dompdf->stream("fatura",array("Attachment"=>false));
}catch (\Dompdf\Exception $e){
    echo "Erro! ".$e->getMessage();
}