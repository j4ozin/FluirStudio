<?php
session_start();
require 'tdbcon.php';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Adicione os cabeçalhos necessários -->
</head>
<body>
    <div class="container mt-4">
        <?php include('GerenciarUsuariosMessage.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes do Usuário
                            <a href="gCriarUsuarios.php" class="btn btn-primary float-end">Adicionar Usuário</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <!-- Exiba a lista de usuários -->
                            <thead>
                                <tr>
                                    <th>ID</th>                                  
                                    <th>CPF</th>
                                    <th>Senha</th>
                                    <th>Papel</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM usuarios";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0) {
                                        foreach($query_run as $usuarios) {
                                ?>
                                <tr>
                                    <td><?= $usuarios['id']; ?></td>
                                    <td><?= $usuarios['CPF']; ?></td>
                                    <td><?= $usuarios['senha']; ?></td>
                                    <td><?= $usuarios['papel']; ?></td>
                                    <td>
                                        <a href="gVisualizarUsuarios.php?id=<?= $usuarios['id']; ?>" class="btn btn-info btn-sm">Visualizar</a>
                                        <a href="gEditarUsuarios.php?id=<?= $usuarios['id']; ?>" class="btn btn-success btn-sm">Editar</a>

                                        <form action="gerenciarusuarios.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_user" value="<?= $usuarios['id']; ?>" class="btn btn-danger btn-sm">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    } else {
                                        echo "<h5>Nenhum usuário cadastrado</h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
