<?php
require 'conexao.php';

// Verifica se o ID do turno foi enviado pelo formulário
if (isset($_GET['turno_id'])) {
    $turnoId = $_GET['turno_id'];

    // Consulta para buscar os resultados do turno selecionado
    $stmt = $pdo->prepare("
        SELECT u.nome AS candidato_nome, COUNT(v.id) AS total_votos
        FROM votos v
        JOIN candidatos c ON v.candidato_id = c.id
        JOIN usuarios u ON c.usuario_id = u.id
        WHERE v.turno_id = :turno_id
        GROUP BY v.candidato_id
        ORDER BY total_votos DESC
    ");
    $stmt->execute([':turno_id' => $turnoId]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Se nenhum turno for selecionado, redirecionar de volta ou mostrar uma mensagem
    echo "Por favor, selecione um turno para visualizar os resultados.";
    exit;
}
?>

<div class="container mt-4">
    <h2>Resultados do Turno Selecionado</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Candidato</th>
                <th>Total de Votos</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($resultados)): ?>
                <?php foreach ($resultados as $resultado): ?>
                <tr>
                    <td><?= htmlspecialchars($resultado['candidato_nome']) ?></td>
                    <td><?= htmlspecialchars($resultado['total_votos']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Não foram encontrados resultados para este turno.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
