<?php
session_start();
require 'tdbcon.php';

// Excluir usuário
if (isset($_POST['delete_user'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_user']);
    $query = "DELETE FROM usuarios WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Usuário excluído com sucesso";
    } else {
        $_SESSION['message'] = "Não foi possível excluir o usuário";
    }
    header("Location: GerenciarUsuariosIndex.php");
    exit(0);
}

// Atualizar usuário
if (isset($_POST['update_user'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $CPF = mysqli_real_escape_string($con, $_POST['CPF']);
    $senha = mysqli_real_escape_string($con, $_POST['senha']);
    $papel = mysqli_real_escape_string($con, $_POST['papel']);

    $query = "UPDATE usuarios SET CPF='$CPF', senha='$senha', papel='$papel' WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Usuário atualizado com sucesso";
    } else {
        $_SESSION['message'] = "Usuário não atualizado";
    }
    header("Location: GerenciarUsuariosIndex.php");
    exit(0);
}

// Criar novo usuário
if (isset($_POST['save_user'])) {
    $CPF = mysqli_real_escape_string($con, $_POST['CPF']);
    $senha = mysqli_real_escape_string($con, $_POST['senha']);
    $papel = mysqli_real_escape_string($con, $_POST['papel']);

    $query = "INSERT INTO usuarios (CPF, senha, papel) VALUES ('$CPF', '$senha', '$papel')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Usuário cadastrado com sucesso!";
    } else {
        $_SESSION['message'] = "Usuário não cadastrado";
    }
    header("Location: gCriarUsuarios.php");
    exit(0);
}

mysqli_close($con);
?>
