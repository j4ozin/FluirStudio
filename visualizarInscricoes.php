<?php
session_start();
require 'tdbcon.php';


// Processar marcação de presença
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['marcar_presenca'])) {
    $id_usuario = mysqli_real_escape_string($con, $_POST['id_usuario']);
    $id_aula = mysqli_real_escape_string($con, $_POST['id_aula']);
    $presenca = mysqli_real_escape_string($con, $_POST['presenca']);

    // Consulta SQL para verificar se a presença já foi marcada
    $query = "SELECT * FROM historico WHERE id_usuario = '$id_usuario' AND id_aula = '$id_aula'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        // Se a presença ainda não foi marcada, insira no banco de dados
        $query_insert = "INSERT INTO historico (id_usuario, id_aula, data, presente) VALUES ('$id_usuario', '$id_aula', CURDATE(), '$presenca')";
        $query_run = mysqli_query($con, $query_insert);

        if ($query_run) {
            $_SESSION['message'] = "Presença marcada com sucesso.";
        } else {
            $_SESSION['message'] = "Erro ao marcar presença: " . mysqli_error($con);
        }
    } else {
        $_SESSION['message'] = "Presença já marcada para este aluno nesta aula.";
    }
}

// Consulta SQL para obter inscrições nas aulas de segunda, quarta e sexta
$query = "SELECT u.id, u.nome, a.id as id_aula, a.dia_semana, a.horario 
            FROM inscricoes i
            INNER JOIN usuarios u ON i.id_usuario = u.id
            INNER JOIN aulas a ON i.id_aula = a.id
            WHERE a.dia_semana IN ('segunda', 'quarta', 'sexta')";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Adicione os cabeçalhos necessários -->
    <title>Visualizar Inscrições</title>
    <link rel="stylesheet" href="seu_estilo.css"> <!-- Lembre-se de substituir 'seu_estilo.css' pelo seu arquivo de estilo -->
</head>
<body>
    <div class="container mt-4">
        <h4>Alunos Inscritos nas Aulas de Segunda, Quarta e Sexta-feira</h4>
        <?php include('GerenciarUsuariosMessage.php'); ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Dia da Aula</th>
                    <th>Horário da Aula</th>
                    <th>Presença</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['nome']}</td>";
                    echo "<td>{$row['dia']}</td>";
                    echo "<td>{$row['horario']}</td>";
                    echo "<td>";
                    echo "<form action='visualizarInscricoes.php' method='POST'>";
                    echo "<input type='hidden' name='id_usuario' value='{$row['id']}'>";
                    echo "<input type='hidden' name='id_aula' value='{$row['id_aula']}'>";
                    echo "<select name='presenca'>";
                    echo "<option value='P'>Presente</option>";
                    echo "<option value='F'>Falta</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo "<button type='submit' name='marcar_presenca' class='btn btn-primary'>Marcar Presença</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
