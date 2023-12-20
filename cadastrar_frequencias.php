<?php

session_start();

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fluirstudio";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificação da conexão
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Processamento do formulário de cadastro
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cadastro"])) {
    $id_aluno = $_GET["id_aluno"];
    $data = $_GET["data"];
    $presente = isset($_GET['presente']) ? 1 : 0;

    // Inserção ou remoção dos dados na tabela
    $sql = "SELECT id FROM frequencia WHERE id_aluno = $id_aluno AND data = '$data'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Registro já existe, então deve ser removido
        $sql = "DELETE FROM frequencia WHERE id_aluno = $id_aluno AND data = '$data'";
        if (mysqli_query($conn, $sql)) {
            echo "Cadastro realizado com sucesso";
            unset($_SESSION['formulario']);
        } else {
            echo "Erro ao remover frequência: " . mysqli_error($conn);
        }
    } else {
        // Registro não existe, então deve ser inserido
        $sql = "INSERT INTO frequencia (id_aluno, data, presente) VALUES ('$id_aluno', '$data', '$presente')";
        if (mysqli_query($conn, $sql)) {
            echo "Cadastro realizado com sucesso";
            unset($_SESSION['formulario']);
        } else {
            echo "Erro ao realizar o cadastro: " . mysqli_error($conn);
        }
    }
}


// Consulta ao banco de dados para obter a lista de alunos
$sql = "SELECT id, nome FROM usuarios";
$result = mysqli_query($conn, $sql);


mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style_freq.css">
	<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
    <title>Gerenciar Frequências</title>
</head>
<body>
    <h1>Cadastro de Frequência</h1>
    <div class="container">
         <form id="formulario" method="get">
            <label for="id_aluno">Aluno:</label>
            <select id="id_aluno" name="id_aluno">
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["nome"]; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data">
            <br>
            <label for="presente">O Aluno faltou hoje?</label>
            <input type="radio" id="presente_sim" name="presente" value= "1">
            <label for="presente_sim">Sim</label>
            <input type="radio" id="presente_nao" name="presente" value= "0">
            <label for="presente_nao">Não</label>
            <br>
            <button type="submit" name="cadastro">Cadastrar</button>
        </form>

        <form action="logout.php" method="post">
        <button  type="submit" value="Logout"> Logout </button> 
        </form>


    </div>                
    <div class="imagem">
	<img src="Imagens/logopng.png" alt="logo">
</body>
</html>
