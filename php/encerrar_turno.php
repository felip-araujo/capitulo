<?php
session_start();
require 'conexao.php';

// Verificar autenticação do administrador
if (!isset($_SESSION['autenticado']) || $_SESSION['nivel_acesso'] !== 'admin') {
    echo "<script>alert('Acesso restrito ao administrador.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

try {
    $pdo->beginTransaction();

    // 1. Identificar o turno atual
    $consultaTurno = $pdo->query("SELECT id FROM turnos WHERE ativo = TRUE LIMIT 1");
    $turnoAtual = $consultaTurno->fetch();
    
    if (!$turnoAtual) {
        throw new Exception("Nenhum turno ativo encontrado.");
    }

    // 2. Contabilizar os votos do turno atual
    $consultaVotos = $pdo->prepare("
        SELECT candidato_id, COUNT(*) AS total_votos
        FROM votos
        WHERE turno_id = :turno_id
        GROUP BY candidato_id
        ORDER BY total_votos DESC
        LIMIT 2
    ");
    $consultaVotos->execute(['turno_id' => $turnoAtual['id']]);
    $candidatosPromovidos = $consultaVotos->fetchAll(PDO::FETCH_ASSOC);

    // 3. Atualizar o status do turno atual para inativo
    $stmt = $pdo->prepare("UPDATE turnos SET ativo = FALSE WHERE id = :turno_id");
    $stmt->execute(['turno_id' => $turnoAtual['id']]);

    // 4. Preparar o próximo turno (este passo pode variar dependendo da sua lógica de turnos)
    $stmt = $pdo->prepare("INSERT INTO turnos (descricao, ativo) VALUES ('Segundo Turno', TRUE)");
    $stmt->execute();
    $novoTurnoId = $pdo->lastInsertId();

    // 5. Atualizar candidatos para o próximo turno
    foreach ($candidatosPromovidos as $candidato) {
        // Aqui você atualiza a relação de candidatos para o próximo turno
        // Isso pode ser um novo registro na tabela `candidatos_turnos` ou uma atualização dos registros de candidatos existentes
    }

    $pdo->commit();
    echo "<script>alert('Turno encerrado com sucesso e próximo turno preparado.');</script>";
    echo "<script>window.location.href = 'admin_turnos.php';</script>";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<script>alert('Erro ao encerrar turno: ".$e->getMessage()."');</script>";
    echo "<script>window.location.href = 'admin_turnos.php';</script>";
}
?>
