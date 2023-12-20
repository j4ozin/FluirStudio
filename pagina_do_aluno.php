<?php
session_start();

// Verifica se o usuário não está logado como aluno
if (!isset($_SESSION['id']) || $_SESSION['papel'] !== 'aluno') {
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
             <li><a href="alterar_senha.php">Alterar senha</a></li>
             <li><a href="visualizar_informacoes.php">Visualizar informações</a></li>
             <li><a href="visualizar_aulas.php">Visualizar aulas</li>
        </ul>
    </div>

</body>
</html>



<!--
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página do Aluno</title>
    <link rel="stylesheet" href="stylePGaluno.css">
</head>
<body>
    <div class="menu-lateral">
        <h2>Menu</h2>
        <a href="alterar_senha.php">Alterar Senha</a>
        <a href="visualizar_informacoes.php">Visualizar Informações</a>
        <a href="visualizar_aulas.php">Visualizar Aulas</a>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>

    <div class="conteudo">
        <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?> (Aluno)</h2>
        <!-- Restante do conteúdo da sua página -->
    </div>
</body>
</html>

