<?php
// Incluir arquivo de conexão com o banco de dados
require 'conexao.php';

// Consulta SQL para obter os resultados da votação
$sql = "SELECT 
            t.nome AS topico,
            SUM(CASE WHEN v.voto = 'aprovo' THEN 1 ELSE 0 END) AS votos_aprovo,
            SUM(CASE WHEN v.voto = 'nao_aprovo' THEN 1 ELSE 0 END) AS votos_nao_aprovo
        FROM 
            votos v
        INNER JOIN 
            topicos t ON v.topico_id = t.id
        GROUP BY 
            t.id, t.nome";

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
    <title>Resultados da Votação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Resultado Geral</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tópico</th>
                        <th scope="col">Aprovado</th>
                        <th scope="col">Não Aprovado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $resultado) : ?>
                        <tr>
                            <td><?= $resultado['topico'] ?></td>
                            <td><?= $resultado['votos_aprovo'] ?></td>
                            <td><?= $resultado['votos_nao_aprovo'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

