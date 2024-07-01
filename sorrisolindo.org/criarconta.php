<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <script lang="javascript" src="js/script.js"></script>
    <title>Sorriso Lindo | Adicionar Usuário</title>
</head>
<body>
    <div class="tela-login">
        <h1>Adicionar Usuário</h1>
        <br>
        <br>
        <br>
        <br>
        <br>
    
        <form action="" method="post" enctype="multipart/form-data">
            
            <input type="text" style="width: 450px;" name="Nome" placeholder="Nome de Usúario" class="texto"><br>
            <input type="email"style=" width: 450px; "name="Email" placeholder="E-mail" class="texto"><br>
            <select style="height: 42px; width: 233px;" class="texto" name="cargo">
            <option  value="Adm">Administrador</option>
            <option value="Dotor">Doctor</option>
            <option value="Balc">Balcão</option>
        
        </select>
            <input type="password" name="Senha" placeholder="Senha" class="texto"><br>
            <label>Foto de Perfil <input value="" type="file" style="padding: 5px;cursor: pointer;border: none" name="Foto"></label>
            <input type="submit" value="Adicionar Usuário" name="bt-enviar" class="bt-enviar" id="entrar">
            
            <?php
            require_once 'conexão.php';
            if (isset($_POST['bt-enviar'])){
                    $nome = $_POST['Nome'];
                    $email = $_POST['Email'];
                    $senha = $_POST['Senha'];
                    $cargo=$_POST['cargo'];
                    $foto = $_FILES['Foto'];
            if (empty($nome) or empty($email) or empty($senha) or empty($cargo) or empty($foto)){
                echo "<center><label style='color: red'>Erro: Preencha todos Campos</label></center>";
                die();
            }
            else {
            if ($foto['error']){
                echo "<center><label style='color: red'>Erro: A extensão da Fotografia de Perfil é Inválida</label></center><br>";
                die();
            }
            else{

                $nomefoto= $foto['name'];
                $pasta ="usuario/";
                $novofoto = uniqid($nomefoto);
                $extensao = strtolower(pathinfo($nomefoto,PATHINFO_EXTENSION));

                $deu_certo = move_uploaded_file($_FILES['Foto']['tmp_name'],$pasta.$novofoto.".".$extensao);
                $caminho = $pasta.$novofoto.".".$extensao;
            }
             if ($deu_certo){
                echo "enviou";
                    $sql = "insert into usuario(Id,Nome,Email,Senha,Foto,Cargo) values(0,'$nome','$email','$senha','$caminho','$cargo')";

                    if (mysqli_query($conexao,$sql)){
                        echo "$nome A sua conta foi criada com sucesso";
                        session_start();
                        session_start();
                        $abb=$conexao->query("select * from usuario where  Nome='$nome' and Email='$email' and Senha='$senha'");
                        while ($idd=mysqli_fetch_assoc($abb)){
                            $id=$idd['Id'];
                        }
                        $_SESSION['logado']=true;
                        $_SESSION['id']=$id;
                        $_SESSION['criou']=$nome;
                        header('Location: conta.php');
                    }
                    else{
                        echo "Erro ".mysqli_error($conexao);
                        die();
                    }
                }
            }
            }
            ?>
        </form>
    </div>

</body>
</html>