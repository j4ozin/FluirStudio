<!DOCTYPE html>
<html>
<head>
    <title>Tela de Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_login.css">
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-container">
    <img src="Imagens/logopng.png" alt="logo">
    <h2>Login</h2>
    <form>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf"><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br><br>
        <button type="button" id="btnLogin">Login</button>
    </form>

    <div id="mensagem"></div>

    <script src="script.js"></script>
</div>

</body>

<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ");
    exit;
}
?>

</html>
