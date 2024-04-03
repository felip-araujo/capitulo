<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da Votação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Dados Completos</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tópico</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Aprovado</th>
                        <th scope="col">Não Aprovado</th>
                        <th scope="col">Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $resultado) : ?>
                        <tr>
                            <td><?= $resultado['topico'] ?></td>
                            <td><?= $resultado['usuario'] ?></td>
                            <td><?= $resultado['aprovado'] ?></td>
                            <td><?= $resultado['nao_aprovado'] ?></td>
                            <td><?= $resultado['observacoes'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
