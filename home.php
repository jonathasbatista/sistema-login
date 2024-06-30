<?php 
require_once 'db_connect.php';

session_start();

if(!isset($_SESSION['logado'])){
    header('Location: index.php');
}

$id = $_SESSION['id-usuario']; 
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1> Olá <?php echo $dados['nome']; ?> </h1>
        <a href="logout.php"> Sair </a>
    </div>
</body>
</html>
