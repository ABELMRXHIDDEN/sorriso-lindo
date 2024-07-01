<?php
if (isset($_POST['sair'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
}
if(isset($_POST['edicao'])){
    $id_user=$_POST['idd'];
    session_start();
    $_SESSION[idd]=$id_user;
    header("Location: gerir.php");

}
//Incluir a conexão com banco de dados
include_once 'conexão.php';

$produtos = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

//Pesquisar no banco de dados nome do usuario referente a palavra digitada
$sql = "SELECT * FROM usuario WHERE Nome LIKE '%$produtos%'";
$result = mysqli_query($conexao, $sql);

if(($result) and ($result->num_rows != 0 )){
    while($produto = mysqli_fetch_assoc($result)){
      $foto = $produto['Foto'];
        $nome = $produto['Nome'];
        $email = $produto['Email'];
        $id = $produto['Id'];

        $cargo = $produto['Cargo'];

        echo "
        <div class='fundo'>
    
        <figure>
        
        <img src=\"$foto\" alt=\"$nome\" class='foto_prod'>
        
        <figcaption style='background-color: white'>
        <label class='nome'>$nome</label><br>
        <label class='des'>$email</label><br>
        <label class='preco'>Cargo: $cargo</label>
       <form action=\"\" method=\"post\" style='background: white'>
        <input style='opacity: 0' type='text' name='idd' value='$id'>
       <input type=\"submit\"  value='' name='edicao' style=\"background: url('icones/icons8_add.ico') no-repeat;background-size: 30px 30px;margin-top: -18px;background-position: 50% 50%\" class='bt-enviar'>
        </figcaption>
        </figure>
        
       
     </form>
        </div>
    
    ";
    }
}
else {
    echo "Usuário não Encontrado";
}
