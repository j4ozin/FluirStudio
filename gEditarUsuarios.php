<?php
session_start();
require 'tdbcon.php';

// Verificar se o ID do usuário foi passado pela URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Consulta SQL para buscar dados do usuário
    $query = "SELECT * FROM usuarios WHERE id='$id'";
    $result = mysqli_query($con, $query);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
        // Verificar se há algum registro retornado
        if (mysqli_num_rows($result) > 0) {
            // Obter os dados do usuário
            $usuario = mysqli_fetch_assoc($result);
        } else {
            $_SESSION['message'] = "Nenhum usuário encontrado com o ID fornecido.";
            header("Location: GerenciarUsuariosIndex.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Erro na consulta: " . mysqli_error($con);
        header("Location: GerenciarUsuariosIndex.php");
        exit;
    }
} else {
    $_SESSION['message'] = "ID do usuário não especificado.";
    header("Location: GerenciarUsuariosIndex.php");
    exit;
}

// Se o formulário for submetido para atualizar o usuário
if (isset($_POST['update_user'])) {
    // Recebendo os dados do formulário
    $CPF = mysqli_real_escape_string($con, $_POST['CPF']);
    $senha = mysqli_real_escape_string($con, $_POST['senha']);
    $papel = mysqli_real_escape_string($con, $_POST['papel']);
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $idade = mysqli_real_escape_string($con, $_POST['idade']);
    $sexo = mysqli_real_escape_string($con, $_POST['sexo']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);
    $plano_aula = mysqli_real_escape_string($con, $_POST['plano_aula']);

    // Consulta SQL para atualizar os dados do usuário
    $query = "UPDATE usuarios SET CPF='$CPF', senha='$senha', papel='$papel', nome='$nome', idade='$idade', sexo='$sexo', email='$email', telefone='$telefone', plano_aula='$plano_aula' WHERE id='$id'";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Usuário atualizado com sucesso.";
        header("Location: GerenciarUsuariosIndex.php");
        exit;
    } else {
        $_SESSION['message'] = "Erro ao atualizar usuário: " . mysqli_error($con);
        header("Location: GerenciarUsuariosIndex.php");
        exit;
    }
}

mysqli_close($con);
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styleEdUsu.css">

    <title>Editar Usuário</title>
</head>
<body>
    <div class="container mt-5">
        <?php include('GerenciarUsuariosMessage.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Usuário
                            <a href="GerenciarUsuariosIndex.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="gEditarUsuarios.php?id=<?= $id; ?>" method="POST">
                            <!-- Campos para editar informações do usuário -->
                            <div class="mb-3">
                                <label for="CPF">CPF</label>
                                <input type="text" name="CPF" class="form-control" value="<?= $usuario['CPF']; ?>" required>
                            </div>
                            <div class="mb-3">
                                 <label for="senha">Senha</label>
                                <input type="text" name="senha" class="form-control" value="<?= $usuario['senha']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="papel">Papel</label>
                                <input type="text" name="papel" class="form-control" value="<?= $usuario['papel']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control" value="<?= $usuario['nome']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="idade">Idade</label>
                                <input type="text" name="idade" class="form-control" value="<?= $usuario['idade']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="sexo">Sexo</label>
                                <input type="text" name="sexo" class="form-control" value="<?= $usuario['sexo']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $usuario['email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefone">Telefone</label>
                                <input type="text" name="telefone" class="form-control" value="<?= $usuario['telefone']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="plano_aula">Plano Aula</label>
                                <input type="text" name="plano_aula" class="form-control" value="<?= $usuario['plano_aula']; ?>">
                            </div>
                            <!-- Botão para atualizar usuário -->
                            <button type="submit" name="update_user" class="btn btn-primary">Atualizar Usuário</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
