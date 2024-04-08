<?php
require 'conexao.php'; // Seu script de conexão ao banco de dados
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    echo "<script>alert('Usuário não autenticado!'); window.location.href = '../index.html';</script>";
    exit;
}

$qr_votos = $pdo->query("
    SELECT
        votos.id,
        topicos.nome AS topico_nome,
        usuarios.nome AS usuario_nome,
        votos.voto,
        votos.observacao
    FROM votos
    JOIN topicos ON votos.topico_id = topicos.id
    JOIN usuarios ON votos.usuario_id = usuarios.id
");
$votos = $qr_votos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Votos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Listagem de Votos</h2>
    <table class="table table-striped table-responsive">
        <thead class="table-dark">
            <tr>
                <th>Usuário</th>
                <th>Tópico</th>
                <th>Voto</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($votos as $voto): ?>
            <tr>
                <td><?= htmlspecialchars($voto['usuario_nome']) ?></td>
                <td><?= htmlspecialchars($voto['topico_nome']) ?></td>
                <td><?= htmlspecialchars($voto['voto']) ?></td>
                <td><?= htmlspecialchars($voto['observacao']) ?></td>
                <td>
                    <a href="editar_voto.php?id=<?= $voto['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
