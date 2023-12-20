document.getElementById('btnLogin').addEventListener('click', login);

function login() {
	const cpf = document.getElementById('cpf').value;
	const senha = document.getElementById('senha').value;

	fetch('verificar_login.php', {
		method: 'POST',
		headers: {
			'Content-type': 'application/x-www-form-urlencoded',
		},
		body: `cpf=${cpf}&senha=${senha}`
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			const papel = data.papel;
			switch (papel) {
				case 'aluno':
					window.location.href = 'aluno.php';
					break;
				case 'professor':
					window.location.href = 'adm.php';
					break;
				case 'admin':
					window.location.href = 'adm.php';
					break;
				default:
					break;
			}
		} else {
			const mensagem = document.getElementById('mensagem');
			mensagem.innerHTML = data.error;
		}
	})
	.catch(error => console.error('Erro ao realizar login:', error));
}
