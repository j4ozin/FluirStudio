<!DOCTYPE html>
<html>
<head>
	<title>Gerenciamento de Login</title>
</head>
<body>
	<h1>Gerenciamento de Login</h1>

	<?php
		// Conexão com o banco de dados
		$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fluirstudio";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

		// Verifica se houve algum erro de conexão
		if (mysqli_connect_errno()) {
			echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
		}

		// Verifica se foi feita uma requisição POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    // Insere o novo usuário no banco de dados
    if (isset($_POST['inserir'])) {
      $cpf = $_POST['cpf'];  
      $senha = $_POST['senha'];
      $papel = $_POST['papel'];
      $query = "INSERT INTO usuarios (CPF, senha, papel) VALUES ('$cpf', '$senha', '$papel')";
      $result = mysqli_query($conn, $query);
      if ($result) {
        $success_msg = "Usuário adicionado com sucesso!";
      } else {
        $error_msg = "Erro ao adicionar usuário: " . mysqli_error($conn);
      }
    }
    
    // Remove um usuário do banco de dados
    if (isset($_POST['remover'])) {
      $id = $_POST['id'];
      $query = "DELETE FROM usuarios WHERE id=$id";
      $result = mysqli_query($conn, $query);
      if ($result) {
        $success_msg = "Usuário removido com sucesso!";
      } else {
        $error_msg = "Erro ao remover usuário: " . mysqli_error($conn);
      }
    }
    
    // Altera as informações de um usuário no banco de dados
    if (isset($_POST['editar'])) {
      $id = $_POST['id'];
      $cpf = $_POST['cpf'];
      $senha = $_POST['senha'];
      $papel = $_POST['papel'];
      $query = "UPDATE usuarios SET CPF='$cpf', senha='$senha', papel='$papel' WHERE id=$id";
      $result = mysqli_query($conn, $query);
      if ($result) {
        $success_msg = "Usuário alterado com sucesso!";
      } else {
        $error_msg = "Erro ao alterar usuário: " . mysqli_error($conn);
      }
    }

    if (isset($_POST['visualizar'])) {
    $query = "SELECT id, nome, CPF, senha, papel FROM usuarios";
    $result = mysqli_query($conn, $query);

    echo "<h2>Usuários cadastrados</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>CPF</th><th>Senha</th><th>Papel</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['CPF'] . "</td>";
        echo "<td>" . $row['senha'] . "</td>";
        echo "<td>" . $row['papel'] . "</td>";
        echo "</tr>";
    }

        echo "</table>";
    }

  


}

  ?>

<form method="POST">
	<h2>Inserir novo usuário</h2>
	<label for="cpf">CPF:</label>
	<input type="text" name="cpf" required>
	<label for="senha">Senha:</label>
	<input type="password" name="senha" required>
	<label for="papel">Papel:</label>
	<input type="text" name="papel" required>
	<button type="submit" name="inserir">Inserir</button>
</form>

<hr>

<form method="POST">
	<h2>Remover usuário</h2>
	<label for="id">ID:</label>
	<input type="text" name="id" required>
	<button type="submit" name="remover">Remover</button>
</form>

<hr>

<form method="POST">
	<h2>Editar usuário</h2>
	<label for="id">ID:</label>
	<input type="text" name="id" required>
	<label for="cpf">CPF:</label>
	<input type="text" name="cpf" required>
	<label for="senha">Senha:</label>
	<input type="password" name="senha" required>
	<label for="papel">Papel:</label>
	<input type="text" name="papel" required>
	<button type="submit" name="editar">Editar</button>
</form>

<form method="POST">
  <h2>Visualizar usuários</h2>
  <button type="submit" name="visualizar">Visualizar</button>
</form>


</body>
</html>

  