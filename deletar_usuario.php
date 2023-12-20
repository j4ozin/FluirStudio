<?php
session_start();

// Verifica se o usuário não está logado como professor
if (!isset($_SESSION['id']) || $_SESSION['papel'] !== 'professor') {
    header("Location: login.php");
    exit;
}

// Se o botão de logout for pressionado, destrói a sessão e redireciona para a página de login
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Verifica se o ID do usuário a ser deletado foi fornecido na URL
if (!isset($_GET['id'])) {
    header("Location: gerenciar_usuarios.php");
    exit;
}

$user_id = $_GET['id'];

// Conexão com o banco de dados
// Substitua pelos seus próprios detalhes de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fluir";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Excluir o usuário do banco de dados
$delete_sql = "DELETE FROM usuarios WHERE id = $user_id";

if ($conn->query($delete_sql) === TRUE) {
    echo "Usuário deletado com sucesso.";
} else {
    echo "Erro ao deletar usuário: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fluir studio de dança</title>
    <link rel="stylesheet" type="text/css" href="stylefluir.css">
</head>
<body>

    <div id="logomarca2">
        <a href="home.html"><img src="img/logo2.jpeg" alt="logo"></a>
    </div>
    
    <div class="txtcontatotitle">
        <h1>Atenção!</h1>
    </div>

    <div class="txtcontato">
        <h1>Usuário deletado com sucesso.</h1> 
    </div>
    </body>
    </html>