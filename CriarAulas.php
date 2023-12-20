<!DOCTYPE html>
<html>
<head>
    <title>Criar Aulas</title>
</head>
<body>
    <h1>Criar Aulas</h1>
    <form action="processar_aulas.php" method="post">
        <label for="dia_semana">Dia da semana:</label>
        <select name="dia_semana" id="dia_semana">
            <option value="segunda">Segunda-feira</option>
            <option value="quarta">Quarta-feira</option>
            <option value="sexta">Sexta-feira</option>
        </select><br><br>

        <label for="horario">Horário:</label>
        <input type="text" name="horario" placeholder="HH:MM"><br><br>

        <input type="submit" value="Criar Aula">
    </form>
</body>
</html>

