<?php
require "../vendor/autoload.php";
use Dompdf\Dompdf;

$options= new \Dompdf\Options();
$options->setRootDir(__DIR__."/ARB");
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);

$dompdf->loadHtmlFile(__DIR__."/ARB/index.html");
$dompdf->render();
header("Content-type: application/pdf");
echo $dompdf->output();
