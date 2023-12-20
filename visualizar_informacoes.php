<?php
session_start();

// Verifica se o usuário está logado como aluno
if (!isset($_SESSION['id']) || $_SESSION['papel'] !== 'aluno') {
    header("Location: pagina_de_login.php");
    exit;
}

// Verifica se o botão de logout foi acionado
if (isset($_POST['logout'])) {
    // Destrói a sessão
    session_unset();
    session_destroy();
    // Redireciona para a página de login
    header("Location: login.php");
    exit;
}

// Recupera as informações do aluno
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fluir";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$aluno_id = $_SESSION['id'];
$sql = "SELECT * FROM usuarios WHERE id = $aluno_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $cpf = $row['cpf'];
    $telefone = $row['telefone'];
    $email = $row['email'];
    // Você pode adicionar outras informações, se necessário
} else {
    echo "Nenhuma informação encontrada para este aluno.";
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

    <!-- Formulário para realizar o logout -->
    <form class="sair" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="logout" value="Sair">
    </form>

    <div class="container_form">
        <h1>Minhas informações</h1>
                    
        <div class="form_grupo">
            <label for="nome" class="form_label">Nome</label><br>
            <?php echo $nome; ?>
        </div>

        <div class="form_grupo">
            <label for="cpf" class="form_label">CPF</label><br>
            <?php echo $cpf; ?>
        </div>

        <div class="form_grupo">
            <label for="telefone" class="form_label">Telefone</label><br>
            <?php echo $telefone; ?>
        </div>

        <div class="form_grupo">
            <label for="email" class="form_label">E-mail</label><br>
            <?php echo $email; ?>
        </div>
                 
    </div>

</body>
</html>
