<?php
// Incluir arquivo de conexão com o banco de dados
require 'conexao.php';

// Consulta SQL para obter todos os dados de votação
$sql = "SELECT 
            t.nome AS topico,
            u.nome AS usuario,
            SUM(CASE WHEN v.voto = 'aprovo' THEN 1 ELSE 0 END) AS aprovado,
            SUM(CASE WHEN v.voto = 'nao_aprovo' THEN 1 ELSE 0 END) AS nao_aprovado,
            GROUP_CONCAT(v.observacao SEPARATOR '<br>') AS observacoes
        FROM 
            votos v
        INNER JOIN 
            topicos t ON v.topico_id = t.id
        INNER JOIN 
            usuarios u ON v.usuario_id = u.id
        GROUP BY
            t.nome, u.nome";

// Preparar e executar a consulta
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);  



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Observações da Votação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Observações</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tópico</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $resultado) : ?>
                        <?php if (!empty($resultado['observacoes'])) : ?>
                            <tr>
                                <td><?= $resultado['topico'] ?></td>
                                <td><?= $resultado['usuario'] ?></td>
                                <td><?= $resultado['observacoes'] ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
