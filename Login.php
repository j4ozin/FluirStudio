<?php
session_start(); // Inicia a sessão

$error = ''; // Inicializa a variável de erro

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (substitua pelos seus próprios dados de conexão)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fluir";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Obtém os dados do formulário se estiverem definidos
    if (isset($_POST['cpf']) && isset($_POST['senha'])) {
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        // Verifica se os campos não estão vazios
        if (!empty($cpf) && !empty($senha)) {
            // Consulta no banco de dados
            $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf' AND senha = '$senha'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['id'];
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['papel'] = $row['papel'];

                // Redireciona com base no papel do usuário (aluno ou professor)
                if ($row['papel'] == 'aluno') {
                    header("Location: pagina_do_aluno.php");
                    exit; // Adiciona um exit para garantir que o código pare de ser executado aqui
                } elseif ($row['papel'] == 'professor') {
                    header("Location: pagina_do_professor.php");
                    exit; // Adiciona um exit para garantir que o código pare de ser executado aqui
                }
            } else {
                $error = "CPF ou senha incorretos.";
            }
        } else {
            $error = "Por favor, preencha todos os campos.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title> 
    <link rel="stylesheet" type="text/css" href="stylefluir.css">
</head>
<body>
    
    <div id="logomarca2">
        <a href="home.html"><img src="img/logo2.jpeg" alt="logo"></a>
    </div>

    <div id="login">
        <form class="card" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="card-header">
                <h2>Login</h2>
            </div>

            <div class="card-content">
                <div class="card-content-area">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" autocomplete="off" required>
                </div>

                <div class="card-content-area">
                    <label for="password">Senha</label>
                    <input type="password" id="senha" name="senha" autocomplete="off" required>
                </div>
            </div>

            <div class="card-footer">
                <input type="submit" value="entrar" class="submit">
                <a href="home.html" class="btn-voltar"><button type="button">Voltar</button></a><br>            
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




