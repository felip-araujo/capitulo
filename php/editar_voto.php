<?php
// editar_voto.php
require 'conexao.php';
$mensagem = '';

// Verifica se o ID do voto foi passado
if (isset($_GET['id'])) {
    $voto_id = $_GET['id'];

    // Busca informações do voto
    $qr_voto = $pdo->prepare("SELECT * FROM votos WHERE id = :id");
    $qr_voto->execute([':id' => $voto_id]);
    $voto = $qr_voto->fetch(PDO::FETCH_ASSOC);

    // Verifica se o formulário foi submetido
    if (isset($_POST['salvar'])) {
        $observacao = $_POST['observacao'];

        // Atualiza a observação no banco de dados
        $qr_update = $pdo->prepare("UPDATE votos SET observacao = :observacao WHERE id = :id");
        if ($qr_update->execute([':observacao' => $observacao, ':id' => $voto_id])) {
            $mensagem = 'Observação atualizada com sucesso.';
        } else {
            $mensagem = 'Erro ao atualizar a observação.';
        }
    }
} else {
    // Redireciona se o ID não for fornecido
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Observação do Voto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="btn btn-outline-dark"><a href="listar-votos.php">Voltar</a></div>
<div class="container mt-5">
    <?php if (!empty($mensagem)): ?>
        <div class="alert alert-info"><?= $mensagem; ?></div>
    <?php endif; ?>
    
    <form action="" method="post">
        <div class="mb-3">
            <label for="observacao" class="form-label">Observação:</label>
            <textarea class="form-control" id="observacao" name="observacao" rows="3"><?= htmlspecialchars($voto['observacao']) ?></textarea>
        </div>
        <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
    </form>
</div>
</body>
</html>
