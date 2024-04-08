<?php
require 'conexao.php';
session_start();

// Busca a quantidade total de usuários
$totalUsuarios = $pdo->query("SELECT COUNT(id) FROM usuarios")->fetchColumn();

// Consulta para buscar todos os tópicos e a contagem de votos para cada um
$consultaTopicos = $pdo->query("
    SELECT t.id, t.nome,
           SUM(CASE WHEN v.voto = 'aprovo' THEN 1 ELSE 0 END) as aprovado,
           SUM(CASE WHEN v.voto = 'nao_aprovo' THEN 1 ELSE 0 END) as nao_aprovado,
           COUNT(v.id) as total_votado,
           ($totalUsuarios - COUNT(v.usuario_id)) as nao_votaram
    FROM topicos t
    LEFT JOIN votos v ON t.id = v.topico_id
    GROUP BY t.id
");

$topicos = $consultaTopicos->fetchAll(PDO::FETCH_ASSOC); 
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da Votação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Dados Completos da Votação</h2>
    <div class="row">
        <!-- Resultado geral de votos -->
        <div class="col-12">
            <h3>Resultado Geral dos Votos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tópico</th>
                        <th>Aprovado</th>
                        <th>Não Aprovado</th>
                        <th>Total Votado</th>
                        <th>Usuários que não votaram</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($topicos as $topico): ?>
                    <tr>
                        <td><?= htmlspecialchars($topico['nome']) ?></td>
                        <td><?= htmlspecialchars($topico['aprovado']) ?></td>
                        <td><?= htmlspecialchars($topico['nao_aprovado']) ?></td>
                        <td><?= htmlspecialchars($topico['total_votado']) ?></td>
                        <td><?= htmlspecialchars($topico['nao_votaram']) ?></td> 
                    </tr>
                    <?php endforeach; ?>
                </tbody> 
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
