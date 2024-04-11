<?php
require 'conexao.php'; // Supondo que você tenha um arquivo de conexão 

// Buscar todos os turnos disponíveis
$stmt = $pdo->prepare("SELECT id, descricao FROM turnos ORDER BY id ASC");
$stmt->execute();
$turnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ID do primeiro turno - você pode ter isso armazenado de alguma maneira ou simplesmente sabê-lo
$primeiroTurnoId = 1;
$consultaTurno = $pdo->query("SELECT id FROM turnos WHERE ativo = TRUE LIMIT 1");

$stmt = $pdo->prepare("
    SELECT u.nome AS candidato_nome, COUNT(v.id) AS total_votos
    FROM votos v
    JOIN candidatos c ON v.candidato_id = c.id
    JOIN usuarios u ON c.usuario_id = u.id
    WHERE v.turno_id = :turno_id
    GROUP BY v.candidato_id
    ORDER BY total_votos DESC
");
$stmt->execute([':turno_id' => $primeiroTurnoId]);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>





<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Resultados do Primeiro Turno</title>
    <!-- Inclua o CSS do Bootstrap para facilitar a estilização -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Resultados do Turno</title>
    <!-- Incluir estilos do Bootstrap para melhorar a aparência -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Selecionar Turno para Visualizar Resultados</h2>
        <form action="visualizar_resultados_turno.php" method="get">
            <div class="form-group">
                <label for="turno">Turno:</label>
                <select name="turno_id" id="turno" class="form-control">
                    <?php foreach ($turnos as $turno): ?>
                        <option value="<?= $turno['id'] ?>"><?= htmlspecialchars($turno['descricao']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Visualizar Resultados</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>

</html>