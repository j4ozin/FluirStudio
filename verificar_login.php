<?php
require 'tdbcon.php';

session_start();

$cpf = $_POST['cpf'];
$_SESSION['cpf'] = $cpf;
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE CPF='$cpf' AND senha='$senha'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $papel = $row['papel'];
    $response = array("success" => true, "papel" => $papel);
} else {
    $error = "CPF ou senha incorretos.";
    $response = array("success" => false, "error" => $error);
}

echo json_encode($response);

mysqli_close($con);
?>
