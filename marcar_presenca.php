<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header("Location: login.php");
    exit();
}

$cpf = $_SESSION['cpf'];

require 'tdbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia_aula = mysqli_real_escape_string($con, $_POST['dia_aula']);

    // Obter o ID da aula correspondente ao dia selecionado
    $query_get_aula_id = "SELECT id FROM aulas WHERE dia_semana = '$dia_aula'";
    $result_get_aula_id = mysqli_query($con, $query_get_aula_id);

    if ($result_get_aula_id && mysqli_num_rows($result_get_aula_id) > 0) {
        $row_aula = mysqli_fetch_assoc($result_get_aula_id);
        $id_aula = $row_aula['id'];

        // Restante do seu código para obter o plano de aula e marcar a presença
        // ...

        // Inserir a marcação de presença no histórico com a id_aula obtida
        $data = date('Y-m-d');
        $insert_query = "INSERT INTO historico (id_usuario, data, presente, id_aula) VALUES ((SELECT id FROM usuarios WHERE CPF = '$cpf'), '$data', 'P', '$id_aula')";
        $insert_result = mysqli_query($con, $insert_query);

        if ($insert_result) {
            echo "Presença marcada com sucesso.";
        } else {
            echo "Erro ao marcar a presença: " . mysqli_error($con);
        }
    } else {
        echo "Não foi encontrada aula correspondente ao dia selecionado.";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_aluno.css">
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
    <title>Marcar Presença</title>
</head>
<body>

<div class="content">
    <h2>Marcar Presença</h2>
    
    <form method="post" action="marcar_presenca.php">
        <!-- Adicione campos para selecionar o dia/dias de aula e qualquer outro dado necessário -->
        <label for="dia_aula">Dia da Aula:</label>
        <select id="dia_aula" name="dia_aula">
            <option value="segunda">Segunda-feira</option>
            <option value="quarta">Quarta-feira</option>
            <option value="sexta">Sexta-feira</option>
        </select>
        
        <input type="submit" value="Marcar Presença">
    </form>
</div>

</body>
</html>
