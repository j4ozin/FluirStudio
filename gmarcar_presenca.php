<?php
if (isset($_GET['id'])) {
    $aula_id = $_GET['id'];
    // Aqui você pode criar um formulário para permitir a marcação de presença na aula com o ID recebido
    echo "<h2>Marcar Presença na Aula ID: $aula_id</h2>";
    echo "<form action='processar_presenca.php' method='post'>";
    echo "<input type='hidden' name='aula_id' value='$aula_id'>";
    echo "Data da Presença: <input type='date' name='data' required><br><br>";
    echo "<input type='submit' value='Marcar Presença'>";
    echo "</form>";
} else {
    echo "Aula não especificada.";
}
?>
