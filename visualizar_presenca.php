<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Presença</title>
</head>
<body>
    <h1>Visualizar Presença pelo Professor</h1>

    <form action="processar_visualizacao.php" method="post">
        <label for="aula_id">Selecione a Aula:</label>
        <select name="aula_id" id="aula_id">
            <?php
            // Conexão com o banco de dados (substitua com suas credenciais)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fluirstudio";

            // Cria a conexão
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verifica a conexão
            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Query para selecionar todas as aulas
            $sql = "SELECT id, dia_semana, horario FROM aulas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Preenche as opções do select com os dados das aulas
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['dia_semana'] . " - " . $row['horario'] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhuma aula encontrada</option>";
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
            ?>
        </select><br><br>

        <input type="submit" value="Visualizar Presença">
    </form>
</body>
</html>
