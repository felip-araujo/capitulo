
<?php

include 'conexao.php';
// Consulta SQL para obter os resultados da votação
$sql = "SELECT 
            u.nome AS usuario,
            COUNT(*) AS total_votos
        FROM 
            votos_cargos vc
        INNER JOIN 
            usuarios u ON vc.voto_para = u.id
        WHERE 
            vc.cargo_id = 1
        GROUP BY 
            u.nome";

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
        <h2>Resultados da Votação para Delegado do CG29</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Total de Votos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $resultado) : ?>
                    <tr>
                        <td><?= $resultado['usuario'] ?></td>
                        <td><?= $resultado['total_votos'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
