<?php
// Verifica se o formulário foi submetido
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

    // Obtém os dados do formulário
    $dia_semana = $_POST['dia_semana'];
    $horario = $_POST['horario'];

    // Prepara e executa a query SQL para inserir os dados na tabela aulas
    $sql = "INSERT INTO aulas (dia_semana, horario) VALUES ('$dia_semana', '$horario')";

    if ($conn->query($sql) === TRUE) {
        echo "Aula criada com sucesso!";
    } else {
        echo "Erro ao criar aula: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>