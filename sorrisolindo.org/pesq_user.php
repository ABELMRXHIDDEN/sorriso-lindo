<?php
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
        $preco = $produto['Preco'];
        $dec=$produto['Des'];
        $id = $produto['Id'];


        echo "
    <div class='fundo'>
    
    <figure>
    
    <img src=\"$foto\" alt=\"$nome\"  style=' width: 230px;height: 200px;' class='foto_prod'>
    
    <figcaption style='background-color: white'>
    <label class='nome'>$nome</label><br>
    <label class='des'>$dec</label><br>
    
   
   
    </figcaption>
    </figure>
    
 <form method='post' action='gerir.php' style='background-color: white'>
    <input style='opacity: 0' type='text' name='idd' value='$id'>
    <input type=\"submit\"  value='Gerir' name='gerir' style='border-left: 0px; cursor: pointer; border: none; color: black; font-weight: bold;background-color: #dddddd; padding: 5px;position: relative;left: -162px'  width='100px'>
     </form>
    </div>
    
    ";
    }
}
else {
    echo "Usuário não Encontrado";
}
