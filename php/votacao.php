<?php
require 'main.php';
// session_start();

$mensagem = '';

if (isset($_POST['enviar'])) {
    include 'conexao.php';

    $topico_id = $_POST['topico'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar se o usuário já votou nesse tópico
    $qrvoto_existente = $pdo->prepare("SELECT * FROM votos WHERE topico_id = :topico_id AND usuario_id = :usuario_id");
    $qrvoto_existente->bindParam(':topico_id', $topico_id);
    $qrvoto_existente->bindParam(':usuario_id', $usuario_id);
    $qrvoto_existente->execute();

    if ($qrvoto_existente->rowCount() > 0) {
        $mensagem = 'Você já realizou o seu voto neste tópico e não pode mais votar.';
    } else {
        // Verifica se todos os campos do formulário foram preenchidos
        if (!empty($_POST['voto'])) {
            $voto = $_POST['voto'];
            $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : null;

            // Realiza a inserção dos dados no banco de dados
            $qrvoto = $pdo->prepare("INSERT INTO votos (topico_id, voto, observacao, usuario_id) VALUES (:topico_id, :voto, :observacao, :usuario_id)");
            $qrvoto->bindParam(':topico_id', $topico_id);
            $qrvoto->bindParam(':voto', $voto);
            $qrvoto->bindParam(':observacao', $observacao);
            $qrvoto->bindParam(':usuario_id', $usuario_id);

            if ($qrvoto->execute()) {
                $mensagem = 'Voto enviado com sucesso!';
            } else {
                $mensagem = 'Erro ao enviar o voto. Por favor, tente novamente.';
            }
        } else {
            $mensagem = 'Por favor, selecione uma opção de voto.';
        }
    }
}

// Consulta os tópicos disponíveis
$qr_consulta_toppicos = $pdo->prepare("SELECT * FROM topicos");
$qr_consulta_toppicos->execute();
$topicos = $qr_consulta_toppicos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Votação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Formulário de Votação</h2>
        <!-- Exibir mensagem de feedback -->
        <?php if (!empty($mensagem)) : ?>
            <div class="alert alert-primary" role="alert">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="topico">Selecione o Tópico:</label>
                <select class="form-select" id="topico" name="topico">
                    <!-- Adicione opções dinamicamente a partir do banco de dados -->
                    <?php foreach ($topicos as $topico) : ?>
                        <option value="<?= $topico['id'] ?>"><?= $topico['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <!-- <label>Voto:</label><br> -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="voto" id="aprovo" value="aprovo">
                    <label class="form-check-label btn btn-success" for="aprovo">Aprovo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="voto" id="nao_aprovo" value="nao_aprovo">
                    <label class="form-check-label btn btn-danger" for="nao_aprovo">Não Aprovo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="voto" id="observacao" value="observacao">
                    <label class="form-check-label btn btn-warning" for="observacao">Observação</label>
                </div>
            </div>
            <div class="mb-3" id="observacaoField" style="display: none;">
                <label for="observacao">Observação:</label><br>
                <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar Voto</button>
        </form>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioObservacao = document.getElementById('observacao');
            const observacaoField = document.getElementById('observacaoField');

            radioObservacao.addEventListener('change', function() {
                if (this.checked) {
                    observacaoField.style.display = 'block';
                } else {
                    observacaoField.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
