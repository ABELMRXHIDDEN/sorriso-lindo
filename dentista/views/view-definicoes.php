<?php
session_start();
$id=$_SESSION['Id_user'];
echo "<input id='idUser' value='$id' style='display: none'>";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/formulario.css">
    <link rel="stylesheet" href="../../css/boostrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/view_2.0.css">
    <script src="../../js/sweetalert2.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../js/definicoes.js"></script>
    <title>Definições</title>

</head>
<body style="overflow: hidden">
<div class="main">

<div style="width: 80%; height: 80%">


        <div class="modal-body">

            <div id="corpo-view">

                <form class="gridf"   enctype="multipart/form-data">
                    <h3 class="infofunc">Informações do Funcionário</h3>
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
                            <input type="text" readonly  class="form-control w-100 texto" required id="cargo" placeholder="nome">
                            <label for="nomeCompleto">Cargo</label>
                        </div>
                    </div>
                    <div id="col_numero" class="item">
                        <div class="form-floating w-100">
                            <input type="text"  class="form-control w-100 texto" required id="numeroTelefone" placeholder="nome">
                            <label for="nomeCompleto">Número de Telefone</label>
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
                            <label >Endereço</label>
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
                    <div id="uk" class="item">

                        <div class="form-floating w-100">
                            <input style="margin-left: 80px;border: none" type="file" name="fotografia"  class="form-control w-75" required id="foto" placeholder="nome">
                            <label >Fotografia</label>
                        </div>
                    </div>
                    <h3 class="bin">Credenciais de Login</h3>
                    <div id="col_eml" class="item">

                        <div class="form-floating w-100">
                            <input type="text"  class="form-control w-100 texto" required id="email" placeholder="nome">
                            <label >Email</label>
                        </div>
                    </div>
                    <div id="col_senha" class="item">
                        <div class="form-floating w-100">
                            <div class="form-floating w-100">
                                <input type="text"  class="form-control w-100 texto" required id="senha" placeholder="nome">
                                <label >Senha</label>
                            </div>
                        </div>

                    </div>

                    <div id="col_cad" class="item">
                        <button type="button" id="Actualizar" class="form-control w-100 btn-outline-primary btn btn-lg">Actualizar</button>
                    </div>





                    <div id="col-sms" class="item">
                        <div class="Mensagem">

                        </div>

                    </div>
                </form>

            </div>
        </div>
</div>

</div>
</body>
</html>