<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtém o ID da aula selecionada
    $aula_id = $_POST['aula_id'];

    // Consulta SQL para recuperar os alunos que marcaram presença na aula específica

    $sql = "SELECT u.nome AS nome_aluno, h.data 
            FROM historico h
            INNER JOIN usuarios u ON h.id_usuario = u.id
            WHERE h.id_aula = $aula_id AND h.presente = 'P'";





    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibe os resultados
        echo "<h2>Presença dos Alunos na Aula ID: $aula_id</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Aluno</th><th>Data de Presença</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['nome_aluno'] . "</td><td>" . $row['data'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum aluno marcou presença nesta aula.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    echo "Método inválido para processar os dados.";
}
?>
