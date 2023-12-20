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

// Processar os dados do formulário para criar a aula
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fluir";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    $data_aula = $_POST['data_aula'];
    $horario = $_POST['horario'];
   
    // Verifica se os campos não estão vazios
    if (!empty($data_aula) && !empty($horario)) {
        // Insere os dados da aula na tabela 'aulas'
        $professor_id = $_SESSION['id'];
        $sql = "INSERT INTO aulas (professor_id, data_aula, horario) VALUES ('$professor_id', '$data_aula', '$horario')";

        if ($conn->query($sql) === TRUE) {
            echo "Aula criada com sucesso!";
        } else {
            echo "Erro ao criar aula: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Aulas</title> 
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
    
    <!-- Formulário para o botão de logout -->
    <form method="post" action="" class="logout-btn">
        <input type="submit" name="logout" value="Sair">
    </form>

    <div id="login">
        <form class="card" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="card-header">
                <h2>Criar aulas</h2>
            </div>

            <div class="card-content">
                <div class="card-content-area">
                    <label for="data">Data da aula</label>
                    <input type="date" name="data_aula" required>
                </div>

                <div class="card-content-area">
                    <label for="horario">Horário</label>
                    <input type="time" name="horario" required><br>
                </div>
            </div>

            <div class="card-footer">
                <input type="submit" value="Criar aula" class="submit">
                <a href="pagina_do_professor.php" class="btn-voltar"><button type="button">Voltar</button></a><br>
            </div>
        </form>
    </div>

</body>
</html>
