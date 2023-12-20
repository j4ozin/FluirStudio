<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style_prof.css">
	<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
	<title>Página Inicial</title>
</head>
<body>
	<h1>Olá Administrador</h1>
	<div class="bloco">
	
		<p>Escolha uma opção:</p>
		<a href="CriarAulas.php"><button>Clique Aqui para Criar Aulas</button></a>
		<a href="visualizar_presenca.php"><button>Clique Aqui para Ver as Presencas</button></a>
		<a href="visualizarInscricoes.php"><button>Clique Aqui para Visualizar Inscrições</button></a>
		<a href="cadastrar_frequencias.php"><button>Clique Aqui para Gerenciar a Frequência das Turmas</button></a>
		<a href="GerenciarUsuariosIndex.php"><button>Clique Aqui para Gerenciar Logins</button></a>
		
        <br><br><br><br>
		<form action="logout.php" method="post">
    	<button type="submit" value="Logout">Logout</button> 
    	</form>

	</div>

	


	<div class="imagem">
	<img src="Imagens/logopng.png" alt="logo">
</body>
</html>


<?php

session_start();


?>
