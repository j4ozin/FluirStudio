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

// Verifica se o ID do usuário a ser editado foi fornecido na URL
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

// Busca as informações do usuário com o ID fornecido
$sql = "SELECT * FROM usuarios WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Usuário não encontrado.";
    exit;
}

$row = $result->fetch_assoc();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os novos dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Atualiza os dados do usuário no banco de dados
    $update_sql = "UPDATE usuarios SET nome = '$nome', cpf = '$cpf', telefone = '$telefone', email = '$email' 
    WHERE id = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Usuário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar usuário: " . $conn->error;
    }
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
        <h1>Edite seu aluno</h1>
        <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $user_id; ?>" enctype="multipart/form-data">
            
            <div class="form_grupo">
                <label for="nome" class="form_label">Nome</label>
                <input type="nome" name="nome" value="<?php echo $row['nome']; ?>" class="form_input" id="nome" placeholder="digite o nome do aluno" required>
            </div>

            <div class="form_grupo">
                <label for="cpf" class="form_label">CPF</label>
                <input type="cpf" name="cpf" value="<?php echo $row['cpf']; ?>" class="form_input" id="cpf" placeholder="digite o CPF do aluno" required>
            </div>

            <div class="form_grupo">
                <label for="telefone" class="form_label">Telefone</label>
                <input type="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" class="form_input" id="telefone" placeholder="(DDD) + número de telefone" required>
            </div>

            <div class="form_grupo">
                <label for="email" class="form_label">E-mail</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form_input" id="email" placeholder="digite o e-mail do aluno" required>
            </div>
                                  
            <div class="card-footer">
                <button type="submit" name="submit" value="Salvar Alterações" class="submit">Salvar</button>
                <a href="gerenciar_usuarios.php"><button type="button">Voltar</button></a>

            </div>
                 
        </form>
    </div>

</body>
</html>
