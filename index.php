<?php 
require_once 'db_connect.php';

session_start();

if(isset($_POST['btn-entrar'])){
    $erros = array();
    $login = mysqli_real_escape_string($connect,  $_POST['login']);
    $senha = mysqli_real_escape_string($connect, $_POST['senha']);

    if(empty($login) or empty($senha)){
        $erros[] = " Os campos precisam ser preenchidos ";
    } else {
        $sql = "SELECT login FROM usuarios WHERE login = '$login' ";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) > 0){
            $senha = md5($senha);
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
            $resultado = mysqli_query($connect, $sql);
                if(mysqli_num_rows($resultado) == 1){
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true; 
                    $_SESSION['id-usuario'] = $dados['id']; 
                    header('Location: home.php');
                } else {
                    $erros[] = " Usuário e senha não conferem ";
                }
        } else {
            $erros[] = " Usuário inexistente ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1> Login </h1>
    <?php
    if(!empty($erros)){
        echo '<ul class="errors">';
        foreach($erros as $erro){
            echo $erro;
        }
        echo '</ul>';
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login"><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br>
        <button type="submit" name="btn-entrar"> Entrar </button>
    </form>
</div>
    
</body>
</html>
