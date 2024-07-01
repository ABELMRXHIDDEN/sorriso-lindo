<?php
session_start();
$id=$_SESSION['Id_user'];
echo "<input type='text' value='$id' style='display: none' id='IdUser'>"
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
    <script src="../js/atender.js"></script>
    <title>Atender Paciente</title>

</head>
<body style="overflow-y: scroll">

<div>
    <h2 id="Nome" style="text-align: center"></h2>
    <button class="btn btn-sm btn-secondary" id="infor-add">Informações Adicionais</button>
    <button class="btn btn-sm btn-primary" id="md_Rec">Emitir Receita</button>
    <button class="btn btn-sm btn-secondary" id="rel">Relatório</button>
    <button class="btn btn-sm btn-primary" id="terminar">Terminar Consulta</button>
<dialog id="perguntas">
    <div class="modal-header">
        <h3 class="modal-title">Informações Sobre o Paciente</h3>
        <button class="btn-close" id="fechar"></button>
    </div>
    <form method="post">
        <div class="cabecalho-perguntas">
            <div class="form-floating" id="pr-per">
                <input id="pergunta-nm" placeholder="Pergunta" type="text" class="form-control">
                <label>Pergunta</label>
            </div>
         <div id="pr-res" class="form-floating">
             <select class="form-select" id="opcao">
                 <option value="Sim">Sim</option>
                 <option value="Não">Não</option>
             </select>
             <label>Resposta</label>
         </div>
            <button id="add" type="button" class="form-control btn btn-lg btn-outline-secondary">Adicionar</button>
        </div>

        <input style="display: none" type="text" id="idpac">
        <div class="perg">

        </div>

        <button type="button" style="display: none" id="Salvar" class="form-control btn-lg btn-outline-primary">Salvar</button>
    </form>
</dialog>
    <div style="width: 60%;display: block;margin: auto" id="Servico">
        <div class="modal-header">
            <h3 class="modal-title">Serviços</h3>

        </div>
        <form method="post">
            <div class="cabecalho-perguntas">
                <div class="form-floating" id="pr-per">

                    <select class="form-select" id="opcaoSer">

                    </select>
                    <label>Serviços</label>

                </div>
                <div id="pr-res" class="form-floating">
                    <input id="qtdSer" placeholder="Quantidade" type="text" class="form-control">
                    <label>Qtd</label>
                </div>
                <button id="add2" type="button" class="form-control btn btn-lg btn-outline-secondary">Adicionar</button>
            </div>

            <input style="display: none" type="text" id="idpac">
            <div class="srvRes" style="height: 350px;overflow: auto">

            </div>

            <button type="button" id="Guardar" class="form-control btn-lg btn-outline-primary">Salvar</button>
        </form>
    </div>
    <dialog id="Relatorio">
        <div class="modal-header">
            <h3 class="modal-title">Relatório</h3>
            <button class="btn-close" id="fechar1"></button>
        </div>
        <form method="post">
            <div class="form-floating">
         <textarea style="height: 70%" rows="10" class="form-control" id="txt-rel" placeholder="Relatorio">

         </textarea>
                <label>Escreva O Relatório</label>
            </div>
            <button type="button" id="salvarRelatorio" class="btn btn-lg btn-outline-primary form-control">Salvar</button>
        </form>
    </dialog>
    <dialog id="Receita">
        <div class="modal-header">
            <h3 class="modal-title">Receita</h3>
            <button class="btn-close" id="fechar2"></button>
        </div>
        <form method="post">
            <div class="form-floating">
                <input type="number" class="form-control" id="qtdRec" placeholder="Relatorio">
                <label for="qtd-rec">Quantidade de Medicamentos</label>
            </div>
            <div id="Medicamentos">


            </div>
            <button type="button" id="Emitir" class="btn btn-lg btn-outline-primary form-control">Emitir</button>
        </form>
    </dialog>




</div>
</body>
</html>