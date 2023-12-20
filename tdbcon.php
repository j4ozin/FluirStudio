<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fluirstudio";

// Criar conexão
$con = mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexão
if (!$con) {
    die("Conexão falhou: " . mysqli_connect_error());
}
?>
