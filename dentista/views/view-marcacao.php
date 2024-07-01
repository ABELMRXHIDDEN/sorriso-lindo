<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../css/formulario.css">
    <link rel="stylesheet" href="../../css/boostrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/view_2.0.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../js/marcacao.js"></script>
    <title>Adicionar Marcação</title>

</head>
<body style="overflow: scroll">
<div class="main">
    <div class="search">
        <label>
            <input type="text" id="PesCol" placeholder="Pesquisar">
            <img  src="../../img/icones/search_96px.png">
        </label>
    </div>
    <div id="exibirCadastro">
    <img id="" width="100%" src="../../img/icones/add_96px.png" class="btn btn-lg">
        <p style="display: none" id="sms-cadas"></p>
    </div>
    <table class="tabelaPaciente">

    </table>
    <dialog class="view">

        <div class="modal-header">
            <h4 id="tituloModal" class="modal-title align-content-center">Adicionar Marcação</h4>
            <button type="button" id="fechar-cad" class="btn-close"></button>
        </div>
        <div class="modal-body">
        <div id="corpo-view">
        <form class="gridf">
           <div class="item" id="col_nome">
               <div class="form-floating">
                   <input readonly type="text" class="form-control texto"  id="nomeCompleto" placeholder="nome">
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

            </div>
            <div id="col_numero" class="item">
       <input style=" display: none" id="idMarcacao">

            </div>

            <div id="col_datanas" class="item w-100">
             <div class="form-floating">
                 <input type="text" readonly id="dataNascimento" class="form-control texto w-100" onfocusin="this.type='date'" onfocusout="this.type='text'" placeholder="Data de Nascimento">
                 <label for="dataNascimento">Data de Nascimento</label>
             </div>
            </div>

            <div id="col_morada" class="item">
            <div class="form-floating w-100">
                <input type="date" id="dataMarcacao" class="texto form-control">
                <label>Data da Marcação</label>
            </div>
            </div>
            <div id="col_sexo" class="item">
                <div class="form-floating w-100">
                    <input type="time" id="horaMarcacao" class="texto form-control" style="text-align: center">
                    <label>Hora da Marcação</label>
                </div>

            </div>

                <div id="col_cad" class="item">
                    <button disabled type="button" id="Adicionar" class="form-control w-100 btn-outline-primary btn btn-lg">Adicionar</button>
                </div>

            <div id="col_act" class="item">
                <button type="button" id="Actualizar" class="form-control w-100 btn-outline-primary btn btn-lg">Actualizar</button>
            </div>


            <div id="col_lim" class="item">
                <button type="reset" id="Limpar" class="form-control w-100 btn-light btn btn-lg">Limpar</button>
            </div>

            <div id="col-sms" class="item">
                <div class="Mensagem">

                </div>

            </div>
        </form>

        </div>
        </div>
        </dialog>
    
</div>
</body>
</html>