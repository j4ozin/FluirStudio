<?php
session_start();

// Verifica se o usuário não está logado como professor
if (!isset($_SESSION['id']) || $_SESSION['papel'] !== 'professor') {
    header("Location: login.php");
    exit;
}

// Se o botão de logout for pressionado, destrói a sessão e redireciona para a página de login
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fluir studio de Dança</title>
    <link rel="stylesheet" type="text/css" href="stylefluir.css">
</head>
<body>

    <form class= "sair" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="logout" value="sair">
    </form>

    <div id="logomarca">
        <a href="home.html"><img src="img/logo.jpeg" alt="logo"></a>
    </div>
    
    <div id="content">
        <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?></h2><br>
    </div>

    <div id="line"></div>

    <div id="menu">
        <ul>
             <li><a href="gerenciar_usuarios.php">Gerenciar usuários</a></li>
             <li><a href="criar_aulas.php">Criar aulas</a></li>
             <li><a href="visualizar_presencas.php">Visualizar presenças</a></li>
        </ul>
    </div>

</body>
</html>

