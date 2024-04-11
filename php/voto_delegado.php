<?php
session_start();
require 'conexao.php';
// Verificar se o usuário está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    echo "<script>alert('Você precisa estar logado para votar.');</script>";
    echo "<script>window.location.href = '../index.html';</script>";
    exit;
}

function buscarTurnoAtivo($pdo)
{
    $sql = "SELECT id FROM turnos WHERE ativo = TRUE LIMIT 1";
    $stmt = $pdo->query($sql);
    $turno = $stmt->fetch(PDO::FETCH_ASSOC);
    return $turno ? $turno['id'] : null;
}

$turnoAtual = buscarTurnoAtivo($pdo);


function buscarCandidatosAtivos($pdo, $turnoId)
{
    $sql = "SELECT u.id, u.nome 
            FROM candidatos c
            JOIN usuarios u ON c.usuario_id = u.id
            WHERE c.turno_id = :turno_id AND c.ativo = TRUE";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':turno_id', $turnoId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    // Suponha que $pdo seja sua conexão PDO e $turnoAtual seja o ID do turno atual
    $candidatos = buscarCandidatosAtivos($pdo, $turnoAtual);
    ?>

    <form action="processar_voto.php" method="post">
        <div class="mb-3">
            <label for="candidato" class="form-label">Selecione o candidato:</label>
            <select class="form-select" id="candidato" name="voto_para" required>
                <option value="" selected disabled>Escolha um candidato</option>
                <?php foreach ($candidatos as $candidato) : ?>
                    <option value="<?= htmlspecialchars($candidato['id']) ?>">
                        <?= htmlspecialchars($candidato['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select> 
            <button name="enviar" id="enviar">Enviar</button>
        </div>
        <button type="submit" class="btn btn-primary">Votar</button>
    </form>

</body>

</html>