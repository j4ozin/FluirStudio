<?php
session_start();

// Verifica se o usuário está logado como professor
if (!isset($_SESSION['id']) || $_SESSION['papel'] !== 'professor') {
    header("Location: pagina_de_login.php");
    exit;
}

// Verifica se foi selecionada uma aula
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aula_id'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fluir";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    $aula_id = $_POST['aula_id'];

    // Recupera a informação da aula selecionada
    $sql = "SELECT data_aula, horario FROM aulas WHERE id = $aula_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data_aula = $row['data_aula'];
        $horario = $row['horario'];

        // Recupera a lista de alunos que marcaram presença nessa aula
        $presenca_sql = "SELECT u.nome, u.cpf
                         FROM presencas p
                         INNER JOIN usuarios u ON p.aluno_id = u.id
                         WHERE p.aula_id = $aula_id AND p.presente = 1";
        $presenca_result = $conn->query($presenca_sql);

        if ($presenca_result->num_rows > 0) {
            ?>
           
           <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <title>Visualizar Presenças</title>
                <link rel="stylesheet" href="stylefluir.css">
            </head>
            <body>

            <div id="logomarca2">
                <a href="home.html"><img src="img/logo2.jpeg" alt="logo"></a>
            </div>
    
            <div class="txtcontatotitle">
                <h1>Alunos confirmados</h1>
            </div>

            <div class="txtcontato">
                <h1>Aula do Dia <?php echo $data_aula; ?> às <?php echo $horario; ?></h1><br>
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                    </tr>
                    <?php
                    while ($row = $presenca_result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cpf']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </body>
            </html>
            <?php
        } else {
            echo "Nenhum aluno presente nesta aula.";
        }
    } else {
        echo "Aula não encontrada.";
    }

    $conn->close();
} else {
    // Caso não tenha sido selecionada uma aula, exibe o formulário para seleção
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fluir";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Obtém as aulas agendadas pelo professor logado
    $professor_id = $_SESSION['id'];
    $aulas_sql = "SELECT id, data_aula, horario FROM aulas WHERE professor_id = $professor_id";
    $aulas_result = $conn->query($aulas_sql);

    if ($aulas_result->num_rows > 0) {
        ?>
        
        
        <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Fluir - Visualizar presenças</title> 
        <link rel="stylesheet" type="text/css" href="stylefluir.css">
    </head>
    <body>


    <form class= "sair" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="logout" value="sair">
    </form>


        <div id="logomarca2">
            <a href="home.html"><img src="img/logo2.jpeg" alt="logo"></a>
        </div>

      

        <div id="login">
        <form class="card" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="card-header">
                <h2>Visualizar presenças confirmadas</h2>
            </div>

            <div class="card-content">
                <div class="card-content-area">
                    <label for="aula">Selecione a aula e o horário</label><br>
                    <select name="aula_id" id="aula_id">
                    <?php
                    while ($row = $aulas_result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['data_aula'] . ' às ' . $row['horario']; ?></option>
                        <?php
                    }
                    ?>
                </select></div><br><br>
                
                <div class="card-footer">
                    <input type="submit" value="Visualizar" class="submit">
                    <a href="pagina_do_professor.php" class="btn-voltar"><button type="button">Voltar</button></a><br>          
                </div> 

            </div>
        <?php
    } else {
        echo "Nenhuma aula agendada por este professor.";
    }

    $conn->close();
}
?>