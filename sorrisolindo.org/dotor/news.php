<?php


    session_start();
    $_SESSION['relatorio'] = true;
    $_SESSION['IdPaciente'] = $_POST['Id_Paciente'];
    header("Location: paciente.php");

