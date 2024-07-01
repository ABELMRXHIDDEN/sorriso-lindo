<?php
declare(strict_types=1);
require_once '../classes/Paciente.php';

$dados=Paciente::listarPacientes();

echo json_encode($dados);
