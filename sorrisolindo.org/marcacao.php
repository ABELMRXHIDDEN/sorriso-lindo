<?php
session_start();
require_once 'conexão.php';
if (isset($_SESSION['Balc'])){
    $id=$_SESSION['idd'];
    $sql = "select * from usuario where Id='$id'";
    $user=$conexao->query($sql);
    while ($info=mysqli_fetch_assoc($user)) {
        $foto=$info['Foto'];
    }
}
else{
    true;
}
if (isset($_POST['sair'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
}
if (isset($_POST['Sair'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/formulario.css">
    <link rel="stylesheet" href="css/boostrap/css/bootstrap.css">
    <script src="jquery.min.js"></script>
    <link rel="stylesheet" href="css/responsividade.css">
    <link rel="stylesheet" href="css/view_2.0.css">
    <script lang="javascript" src="js/script.js"></script>
    <script src="js/marcacao.js"></script>

    <script src="js/animacao.js"></script>

    <title>Cadastrar Paciente</title>
</head>
<body style="overflow: auto">
<dialog  id="Mensagens">


</dialog>

        <form class="gridf">
           <div class="item" id="col_nome">
               <div class="form-floating">
                   <input type="text" class="form-control texto" required id="nomeCompleto" placeholder="nome">
                   <label for="nomeCompleto">Nome Completo</label>
               </div>

           </div>
            <div class="item" id="col_bi">
                <div class="form-floating">
                    <input type="text" class="form-control texto" required id="numeroBilhete" placeholder="nome">
                    <label for="nomeCompleto">Nº do Bilhete</label>
                </div>
            </div>
            <div id="col_email" class="item">
                <div class="form-floating w-100">
                    <input type="text"  class="form-control w-100 texto" required id="Email" placeholder="nome">
                    <label for="nomeCompleto">E-mail</label>
                </div>
            </div>
            <div id="col_numero" class="item">
                <div class="form-floating w-100">
                    <input type="text"  class="form-control w-100 texto" required id="numeroTelefone" placeholder="nome">
                    <label for="nomeCompleto">Numero de Telefone</label>
                </div>

            </div>

            <div id="col_datanas" class="item w-100">
             <div class="form-floating">
                 <input type="text" id="dataNascimento" class="form-control texto w-100" onfocusin="this.type='date'" onfocusout="this.type='text'" placeholder="Data de Nascimento">
                 <label for="dataNascimento">Data de Nascimento</label>
             </div>
            </div>
            <div id="col_morada" class="item">
            <div class="form-floating w-100">
                <input type="text"  class="form-control w-100 texto" required id="endereco" placeholder="nome">
                <label >Endereco</label>
            </div>
            </div>
            <div id="col_sexo" class="item">
                <div class="form-floating w-100">
                    <select class="form-control form-select texto" id="Genero">
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                    <label>Género</label>
                </div>

            </div>
            <div id="col_ser" class="item">
                <div class="form-floating w-100">
                    <select id="Servico" class="form-control form-select texto">

                    </select>
                    <label id="lbServicos" for="Servico">Selecionar Serviço</label>
                </div>
            </div>


            <div id="col_mar" class="item w-100">
                 <div class="form-floating w-100">
                    <input type="text" onfocusin="this.type='date'" onfocusout="this.type='text'" id="dataMarcacao" class="form-control w-100 texto" placeholder="Data Consulta">
                     <label for="dataMarcacao">Data da Marcação</label>
                 </div>
            </div>
            <div id="col_hora" class="w-100 item">
            <div class="form-floating w-100">
                <input type="text" onfocusin="this.type='time'" onfocusout="this.type='text'" id="horaMarcacao" style="text-align: center" class="form-control w-100 texto" placeholder="Data Consulta">
                <label for="dataMarcacao">Hora da Marcação</label>
            </div>
            </div>
            <div id="col_denstista" class="item">
                <div class="form-floating w-100">
                    <select id="Dentista" class="form-control form-select texto">

                    </select>
                    <label id="lb_dentista" for="Dentista">Selecionar dentista</label>
                </div>
            </div>

            <div id="col_total" class="item w-100">
                <div class="form-floating w-100">
                    <input readonly  id="total" class="form-control w-100 texto" placeholder="Total">
                    <label id="lbTotal" for="total">Total a Pagar</label>
                </div>

            </div>
                <div id="col_cad" class="item">
                    <button type="button" id="Cadastrar" class="form-control w-100 btn-outline-primary btn btn-lg"><i><img width="5%" src="icones/save_96px.png"></i>Cadastrar</button>
                </div>

                <div id="col_pes" class="item">
                    <button type="button" id="Pesquisar" class="form-control w-100 btn-outline-secondary btn btn-lg"><i><img width="5%" src="icones/search_client_30px.png"></i>Pesquisar</button>
                </div>
                <div id="col_act" class="item">
                    <button type="button" id="Actualizar" class="form-control w-100 btn-outline-primary btn btn-lg"><i><img width="5%" src="icones/available_updates_96px.png"></i>Actualizar</button>
                </div>
                <div id="col_el" class="item">
                    <button type="button" id="Eliminar" class="form-control w-100 btn-outline-danger btn btn-lg"><i><img width="5%" src="icones/reset_96px.png"></i>Limpar</button>
                </div>
                <div id="col_lim" class="item">
                    <button style="color: black" type="reset" id="Limpar" class="form-control w-100 btn-outline-light btn btn-lg"><i><img width="5%" src="icones/delete_96px.png"></i>Limpar</button>
                </div>
            <div id="col_alt" class="item">
                <div style="width: 60%; display: block;margin: auto">
            <input id="Alterar" type="checkbox"  class="form-check-inline">
            <label class="form-check-label" for="Alterar">Pesquisar e Alterar Dados do Paciente</label>
            </div>
            </div>
        </form>


</body>
</html>