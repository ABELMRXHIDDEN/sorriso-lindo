 <?php
//Incluir a conexão com banco de dados
include_once 'conexão.php';

$produtos = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

//Pesquisar no banco de dados nome do usuario referente a palavra digitada
$sql = "SELECT * FROM produtos WHERE Nome LIKE '%$produtos%'";
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
    
    <img src=\"$foto\" alt=\"$nome\" style=' width: 230px;height: 200px;'class='foto_prod'>
    
    <figcaption style='background-color: white'>
    <label class='nome'>$nome</label><br>
    <label class='des'>$dec</label><br>
    <label class='preco'>".number_format($preco,2,',','.')."</label>
   <form action=\"\" method=\"get\" style='background: white'>
  <input style='opacity: 0' type='text' name='idd' value='$id'>
   <input type=\"submit\"  value='' name='carrinho' style=\"margin-top: -18px; background: url('icones/icons8_add.ico') no-repeat;background-size: 30px 30px;background-position: 50% 50%\" class='bt-enviar'>
    </figcaption>
    </figure>
    
   
 </form>
    </div>
    
    ";

}

}
else{
	echo "Produto não Encontrado";
}