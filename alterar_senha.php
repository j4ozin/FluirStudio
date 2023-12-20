<?php
session_start();

// Verifica se o usuário não está logado como aluno
if (!isset($_SESSION['id']) || $_SESSION['papel'] !== 'aluno') {
    header("Location: pagina_de_login.php");
    exit;
}

// Processamento da alteração de senha...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fluir";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    $aluno_id = $_SESSION['id'];
    $nova_senha = $_POST['nova_senha'];

    // Verifica se o campo não está vazio
    if (!empty($nova_senha)) {
        // Atualiza a senha do aluno no banco de dados sem hash (não recomendado)
        $update_sql = "UPDATE usuarios SET senha = '$nova_senha' WHERE id = $aluno_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Senha alterada com sucesso!";
        } else {
            echo "Erro ao alterar a senha: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha o campo da nova senha.";
    }

    $conn->close();
}

// Se o botão de logout for pressionado, destrói a sessão e redireciona para a página de login
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title> 
    <link rel="stylesheet" type="text/css" href="stylefluir.css">
</head>
<body>
    
    <div id="logomarca2">
        <a href="home.html"><img src="img/logo2.jpeg" alt="logo"></a>
    </div>

    <!-- Adição do formulário de logout -->
    <form class="sair" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="logout" value="Sair">
    </form>

    <div id="login">
        <form class="card" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
            <div class="card-header">
                <h2>Alterar senha</h2>
            </div>

            <div class="card-content">
                <div class="card-content-area">
                    <label for="nova_senha">Nova senha</label>
                    <input type="text" id="nova_senha" name="nova_senha" autocomplete="off" required>
                </div>

                <div class="card-footer">
                    <input type="submit" value="Alterar senha" class="submit">
                    <a href="pagina_do_aluno.php" class="btn-voltar"><button type="button">Voltar</button></a><br>
                </div>
            </div>
        </form>
    </div>

    <div id="erro">
    <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    </div>
</body>
</html>
