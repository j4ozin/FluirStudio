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

// Consulta para obter todos os usuários
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="stylefluir.css">
</head>
<body>

    <form class= "sair" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="logout" value="sair">
    </form>

    <div id="logomarca">
        <a href="home.html"><img src="img/logo.jpeg" alt="logo"></a>
    </div>
    
    <div id="content">
        <h2>Gerenciar usuários</h2>
        <a href="criar_usuario.php"><button class="entrar">Criar novo usuário</button></a>
        <form method="post" action="">
        <a href="pagina_do_professor.php" class="btn-voltar"><button type="button">Voltar</button></a><br>
        </form>
        <br><br>
    </div>

    <div id="line"></div><br>

    <?php
    // Exibir a lista de usuários
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>ID: " . $row['id'] . " | Nome: " . $row['nome'] . " | CPF: " . $row['cpf'] . " | Email: " . $row['email'] . " | ";
            echo "<a href='editar_usuario.php?id=" . $row['id'] . "'>Editar</a> | ";
            echo "<a href='deletar_usuario.php?id=" . $row['id'] . "'>Deletar</a></p>";
        }
    } else {
        echo "Nenhum usuário encontrado.";
    }
    ?>
    <br><br><br><br><br><br>
</body>
</html>
