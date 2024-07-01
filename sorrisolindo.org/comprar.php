<?php
if (isset($_POST['comprar'])) {



    }
    ?>
<?php
require_once 'conexão.php';
$id=$_POST['prod'];

$sql = "select * from produtos where Id='$id'";
$result=$conexao->query($sql);

$result=$conexao->query($sql);

while ($produto=mysqli_fetch_assoc($result)) {
    $foto = $produto['Foto'];
    $nome = $produto['Nome'];
    $preco = $produto['Preco'];
    $id = $produto['Id'];
    $des = $produto['Des'];
    $cat = $produto['Cat'];

    echo "
   <head>
   <link rel=\"stylesheet\" href=\"css/estilo.css\">
</head>

     <div class='tela-login'>
    <form>
        <img src='$foto' class='icone-login'><br>
        <label>$nome</label><br><br>
        <label>$preco</label><br><br>
        <label>$des</label><br><br>
        <label>$cat</label><br><br>
        
        <input type=\"submit\" name=\"compar\" class='bt-enviar' value='Comprar'>
       
     
    </form>
</div>
    
      ";
}
