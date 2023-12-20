<?php
require 'tdbcon.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Adicione os cabeçalhos necessários -->
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dados do Usuário 
                            <a href="GerenciarUsuariosIndex.php" class="btn btn-danger float-end">VOLTAR</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $usuarios_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM usuarios WHERE id='$usuarios_id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $usuarios = mysqli_fetch_assoc($query_run);
                                ?>
                                <div class="mb-3">
                                    <label>ID</label>
                                    <p class="form-control"><?= $usuarios['id']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>CPF</label>
                                    <p class="form-control"><?= $usuarios['CPF']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Senha</label>
                                    <p class="form-control"><?= $usuarios['senha']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Papel</label>
                                    <p class="form-control"><?= $usuarios['papel']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Nome</label>
                                    <p class="form-control"><?= $usuarios['nome']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Idade</label>
                                    <p class="form-control"><?= $usuarios['idade']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Sexo</label>
                                    <p class="form-control"><?= $usuarios['sexo']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <p class="form-control"><?= $usuarios['email']; ?></p>
                                </div>
                                <div class="mb-3">
                                    <label>Telefone</label>
                                    <p class="form-control"><?= $usuarios['telefone']; ?></p>
                                </div>
                                <?php
                            } else {
                                echo "<h4>Nenhum ID encontrado</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
