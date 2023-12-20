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

// Se o formulário for submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $papel = $_POST['papel'];

    // Valide e sanitize os dados antes de inserir no banco de dados
    // ...

    // Insere o novo usuário no banco de dados
    $insert_sql = "INSERT INTO usuarios (nome, cpf, senha, telefone, email, papel) VALUES ('$nome', '$cpf', '$senha', '$telefone', '$email', '$papel')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Novo usuário criado com sucesso!";
    } else {
        echo "Erro ao criar novo usuário: " . $conn->error;
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fluir studio de dança</title>
    <link rel="stylesheet" type="text/css" href="stylefluir.css">
    <style>
        /* Estilos CSS adicionais */
        .logout-btn {
            position: absolute;
        top: 1%;
        right: 5%; /* Ajuste para a porcentagem desejada */
        }
    </style>
</head>
<body>

    <div id="logomarca2">
        <a href="home.html"><img src="img/logo2.jpeg" alt="logo"></a>
    </div>

    <form method="post" action="" class="logout-btn">
        <input type="submit" name="logout" value="Sair">
    </form>

    <div class="container_form">
        <h1>Cadastre o novo usuário</h1>
        <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            
            <div class="form_grupo">
                <label for="nome" class="form_label">Nome</label>
                <input type="text" name="nome" class="form_input" id="nome" placeholder="Digite o nome completo" required>
            </div>

            <div class="form_grupo">
                <label for="cpf" class="form_label">CPF</label>
                <input type="text" name="cpf" class="form_input" id="cpf" placeholder="Digite o CPF" required>
            </div>

            <div class="form_grupo">
                <label for="senha" class="form_label">Senha</label>
                <input type="password" name="senha" class="form_input" id="senha" placeholder="Digite a senha" required>
            </div>

            <div class="form_grupo">
                <label for="telefone" class="form_label">Telefone</label>
                <input type="text" name="telefone" class="form_input" id="telefone" placeholder="(DDD) + número de telefone" required>
            </div>

            <div class="form_grupo">
                <label for="email" class="form_label">E-mail</label>
                <input type="email" name="email" class="form_input" id="email" placeholder="Digite o e-mail" required>
            </div>
                                  
            <div class="form_grupo">
                <label for="papel" class="form_label">Tipo de usuário</label><br><br>
                <input type="radio" name="papel" value="aluno"> Aluno
                <input type="radio" name="papel" value="professor"> Professor<br> 
            </div>      

            <div class="card-footer">
                <button type="submit" name="submit" value="Cadastrar" class="submit">Cadastrar</button>
                <a href="gerenciar_usuarios.php" class="btn-voltar"><button type="button">Voltar</button></a><br>
            </div>
        </form>
    </div>

</body>
</html>
