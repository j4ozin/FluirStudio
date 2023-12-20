<?php
// Verifica se os dados foram enviados via método POST
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
    $aula_id = $_POST['aula_id'];
    $data_presenca = $_POST['data'];

    // Prepara e executa a query SQL para inserir os dados na tabela historico
    $sql = "INSERT INTO historico (id_usuario, id_aula, data, presente) VALUES (?, ?, ?, ?)";
    
    // Prepara a declaração
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da declaração: " . $conn->error);
    }

    // Define os parâmetros e executa a declaração
    $id_usuario = 1; // Aqui você precisará definir o ID do usuário atual, por exemplo, com base na sessão
    $presenca = 'P'; // Presença padrão, você pode alterar conforme necessário
    
    $stmt->bind_param("iiss", $id_usuario, $aula_id, $data_presenca, $presenca);
    
    if ($stmt->execute()) {
        echo "Presença marcada com sucesso!";
    } else {
        echo "Erro ao marcar presença: " . $stmt->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    echo "Método inválido para processar os dados.";
}
?>
