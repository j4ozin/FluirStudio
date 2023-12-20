<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

$cpf = $_SESSION['cpf'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_aluno.css">
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
    <title>Área do Aluno</title>
    <style>
        body {
            font-family: 'Bruno Ace SC', sans-serif;
        }

        .content {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
            margin-top: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
        }

        button {
            padding: 10px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="content">
    <?php if (isset($_SESSION['nome'])) : ?>
        <h1>Olá <?php echo $_SESSION['nome']; ?></h1>
    <?php else : ?>
        <h1>Olá Aluno</h1>
    <?php endif; ?>

    <p>Escolha uma opção:</p>

    <a href="alterar_senha.php"><button>Alterar Senha</button></a>
    <a href="marcar_presenca.php"><button>Marcar Presença</button></a>
    <a href="visualizar_aulas.php"><button>Visualizar Aulas</button></a>


    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</div>

</body>
</html>

<style>
        body {
            font-family: 'Bruno Ace SC', sans-serif;
        }

        .content {
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
            margin-top: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
        }

        button {
            padding: 10px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
    </style>