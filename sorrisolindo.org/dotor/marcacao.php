<?php
session_start();
require_once 'conexão.php';
if (isset($_SESSION['Balc'])){
    $id=$_SESSION['id'];
    $sql = "select * from usuario where Id='$id'";
    $user=$conexao->query($sql);
    while ($info=mysqli_fetch_assoc($user)) {
        $foto=$info['Foto'];
    }
}
else{
    header("Location: login.php");
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
    <script lang="javascript" src="js/script.js"></script>
    <script src="js/animacao.js"></script>
    <script>
$(()=>{
    $("#bar").click(()=>{
        document.querySelector("#sms2").showModal()
    })
})
    </script>

    <title>Cadastrar Paciente</title>
</head>
<body>

<dialog id="sms" class="modal-sm">

<h2 class="modal-header">OI</h2>
</dialog>
<dialog id="sms2"  class="modal-lg" style="width:100%">
    <form action="" method="post">
<input type="submit" value="Terminar Sessão" name="sair" class="btn btn-outline-primary btn-lg" >
</form>
</dialog>

<dialog id="sms3"  class="modal-dialog">
    <div class="modal-header">
        <h1 class="modal-title">Sucesso!</h1>
    </div>
    <div class="modal-body">
        <p>Paciente Cadastrado Com Sucesso!</p>
    </div>
</dialog>
<div id="interface">
<main class="principal text-center container">
     <div class="Cadastrar">
     <form action="inc/marcacao.inc.php" id="formulario" style="width: 98%;display: block;" class="form" method="post">

        <div class="form-floating">

            <input type="text" id="Nome" class="form-control w-100 texto" placeholder="Nome Completo" required  name="Nome">
            <label for="Nome">Nome Completo</label>
        </div>
        <div class="w-100 alinhar">
            <table class="w-100">
                <tr>
                    <td  class="w-50">
                         <div class="form-floating w-100"><input type="text" id="BI" required name="BI" placeholder="NBI"  class="form-control w-100 texto">
                         <label for="BI">Nº do BI</label>
                         </div>
                    </td>
                    <td class="w-50">
            <div class="form-floating w-100">
                 <input type="text" required name="Data_nas" onfocus="this.type='date'" onfocusout="this.type='text'" placeholder="Data de Nascimento"  id="ano" class="texto form-control w-100">
                 <label for="ano">Data de Nascimento</label>
             </div>
            </td>
        </tr>
        </table>
        </div>

        <div class="w-100 alinhar">
            <table class="w-100">
                <tr>
                    <td style="width: 50%">
                        <div style="width: 100%" class="form-floating"><select type="text" id="Sexo"  required name="sexo" placeholder="Sexo" style="width: 100%"  class="texto form-control">
                                <option  value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>

                            </select>
                            <label for="Sexo">Sexo</label>
                        </div>
                    </td>
                    <td style="width: 50%">
                        <div style="width: 100%" class="form-floating">
                            <input type="text" required name="tel" placeholder="Nº Tel"  id="tel" class="form-control texto">
                            <label for="ano">Número de Telefone</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="alinhar w-100">
            <table class="w-100">
                <tr>
                    <td class="w-50">
                        <div class="form-floating w-100"><select type="text"  id="Servico" required name="servico" placeholder="Servico" style="width: 100%"  class="texto form-control">
                                <option  value="Radioligia">Radiologia  </option>
                                <option value="Limpeza">Limpeza</option>
                                <option value="Exames">Exames</option>
                                <option value="Restauração">Restauração</option>

                            </select>
                            <label for="Sexo">Tipo de Serviço</label>
                        </div>
                    </td>
                    <td class="w-50">
                        <div class="form-floating">
                            <input type="text" required  name="morada" placeholder="Morada"  id="morada"  class="form-control w-100 texto">
                            <label for="ano">Morada</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>



        <label><input type="checkbox"  id="mudar"> Especificar a data e Hora da Marcação </label><br>

        <div class="w-100 alinhar Marcar">
            <table class="w-100">
                <tr>
                    <td class="w-50">
                        <div style="display: none" class="form-floating w-100 mudar"><input type="text" onfocus="this.type='date'" id="mar" onfocusout="this.type='text'"  name="marcacao"   placeholder="Marcação"  class="form-control w-100 texto">
                            <label for="BI">Data Da Consulta</label>
                        </div>
                    </td>
                    <td class="w-50">
                        <div style="display: none" class="form-floating mudar w-100">
                            <input type="text"  name="hora" onfocus="this.type='time'" id="hora" style="text-align: center; " onfocusout="this.type='text'" placeholder="Data de Nascimento"  class="form-control w-100 texto">
                            <label for="ano">Hora Da Consulta</label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

       <input type="text" name="id" id="identificador" style="display: none">


        <div class="form-floating">
            <input type="text" class="form-control" placeholder="total" id="total" readonly name="Total">
            <label for="total">Total em KZ</label>
        </div>


         <button type="button" class="btn btn-primary btn-lg w-100" id="cadastrar"><i><img width="40px" src="icones/save_96px.png"></i> Cadastrar Paciente</button>

         <button type="button" class="btn btn-secondary btn-lg w-100" id="pesquisar"><i><img width="40px" src="icones/search_96px.png"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pesquisar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </button>
        <table class="w-100">
            <tr>
                <td class="w-50">
                    <button type="button" id="atualizar" class="btn btn-outline-primary btn-lg w-100 w-100"><i><img width="40px" src="icones/available_updates_96px.png"></i>Actualizar</button>

                </td>
                <td class="w-50">
                    <button type="button" id="eliminar" class="btn btn-outline-danger btn-lg w-100"><i><img width="40px" src="icones/reset_96px.png"></i>Eliminar</button>

                </td>
            </tr>
        </table>
        <button type="reset" class="btn-lg btn btn-light w-100" id="BotaoLimpar"><i><img width="40px" src="icones/delete_96px.png"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Limpar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
<br>
        <label for="editar"><input type="checkbox"  id="editar"> Pesquisar/ Alterar Marcação </label><br>
        <div class="res" style="display: none">

        </div>
<?php
$id=$_SESSION['id'];
echo "<input type='text' value='$id' id='id_user' style='display: none'>"
?>
    </form>
     </div>
</main>
</div>

</body>
</html>