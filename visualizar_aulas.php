<?php
session_start();

// Verifica se o usuário está logado como aluno
if (!isset($_SESSION['id']) || $_SESSION['papel'] !== 'aluno') {
    header("Location: pagina_de_login.php");
    exit;
}

// Processamento da marcação de presença
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
    $aula_id = $_POST['aula_id'];

    // Insere ou atualiza a marcação de presença para a aula
    $check_presence_sql = "SELECT * FROM presencas WHERE aluno_id = $aluno_id AND aula_id = $aula_id";
    $check_presence_result = $conn->query($check_presence_sql);

    if ($check_presence_result->num_rows > 0) {
        // Se já existe uma entrada para essa aula, atualiza a presença
        $update_sql = "UPDATE presencas SET presente = 1 WHERE aluno_id = $aluno_id AND aula_id = $aula_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "Presença marcada com sucesso!";
        } else {
            echo "Erro ao marcar presença: " . $conn->error;
        }
    } else {
        // Se não existe uma entrada para essa aula, insere uma nova entrada
        $insert_sql = "INSERT INTO presencas (aluno_id, aula_id, presente) VALUES ($aluno_id, $aula_id, 1)";

        if ($conn->query($insert_sql) === TRUE) {
            echo "Presença marcada com sucesso!";
        } else {
            echo "Erro ao marcar presença: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Aulas</title>
    <link rel="stylesheet" href="stylefluir.css">
</head>
<body>

<div id="logomarca2">
    <a href="home.html"><img src="img/logo2.jpeg" alt="logo"></a>
</div>

<!-- Formulário para realizar o logout -->
<form class="sair" method="post" action="login.php">
    <input type="submit" name="logout" value="Sair">
</form>

<div class="txtcontatotitle">
    <h1>Aulas agendadas</h1>
</div>

<div class="txtcontato">
    <table>
        <tr>
            <th>Data</th>
            <th>Horário</th>
            <th>Marcar Presença</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fluir";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        $aluno_id = $_SESSION['id'];
        $sql = "SELECT a.id, a.data_aula, a.horario, p.presente
                FROM aulas a
                LEFT JOIN presencas p ON a.id = p.aula_id AND p.aluno_id = $aluno_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['data_aula']; ?></td>
                    <td><?php echo $row['horario']; ?></td>
                    <td>
                        <?php
                        if ($row['presente'] == 1) {
                            echo "Presente";
                        } else {
                            ?>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="aula_id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Marcar presença">
                            </form>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "Nenhuma aula agendada.";
        }

        $conn->close();
        ?>
    </table>
    
    <div>
        <a href="pagina_do_aluno.php">
            <button>Voltar</button>
        </a>
    </div>

</body>
</html>
