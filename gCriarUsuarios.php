<?php
session_start();
require 'tdbcon.php';

if (isset($_POST['save_user'])) {
    $CPF = mysqli_real_escape_string($con, $_POST['CPF']);
    $senha = mysqli_real_escape_string($con, $_POST['senha']);
    $papel = mysqli_real_escape_string($con, $_POST['papel']);
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $idade = mysqli_real_escape_string($con, $_POST['idade']);
    $sexo = mysqli_real_escape_string($con, $_POST['sexo']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);
    $plano_aula = mysqli_real_escape_string($con, $_POST['plano_aula']);

    $query = "INSERT INTO usuarios (CPF, senha, papel, nome, idade, sexo, email, telefone, plano_aula) VALUES ('$CPF', '$senha', '$papel', '$nome', '$idade', '$sexo', '$email', '$telefone', '$plano_aula')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Usuário cadastrado com sucesso!";
        header("Location: GerenciarUsuariosIndex.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Usuário não cadastrado";
        header("Location: gCriarUsuarios.php");
        exit(0);
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Cabeçalhos necessários -->
</head>
<body>

<div class="container mt-5">

    <?php include('GerenciarUsuariosMessage.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adicionar Usuário
                        <a href="GerenciarUsuariosIndex.php" class="btn btn-danger float-end">VOLTAR</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="gCriarUsuarios.php" method="POST">

                        <div class="mb-3">
                            <label>CPF</label>
                            <input type="text" name="CPF" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Senha</label>
                            <input type="password" name="senha" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Papel</label>
                            <select name="papel" class="form-control" required>
                                <option value="aluno">Aluno</option>
                                <option value="professor">Professor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Idade</label>
                            <input type="number" name="idade" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Sexo</label>
                            <select name="sexo" class="form-control" required>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Plano Aula</label>
                            <input type="number" name="plano_aula" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="save_user" class="btn btn-primary">Salvar Usuário</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
