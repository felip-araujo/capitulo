<?php
// Incluir arquivo de conexão com o banco de dados
require 'conexao.php';

// Consulta SQL para obter os resultados da votação com informações do usuário
$sql = "SELECT 
            t.nome AS topico,
            u.nome AS usuario,
            v.voto,
            v.observacao
        FROM 
            votos v
        INNER JOIN 
            topicos t ON v.topico_id = t.id
        INNER JOIN 
            usuarios u ON v.usuario_id = u.id";

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
        <h2>Resultados da Votação</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tópico</th>
                    <th>Usuário</th>
                    <th>Voto</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $resultado) : ?>
                    <tr>
                        <td><?= $resultado['topico'] ?></td>
                        <td><?= $resultado['usuario'] ?></td>
                        <td><?= $resultado['voto'] ?></td>
                        <td><?= $resultado['observacao'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
