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

// Verificar se o voto foi submetido
if (isset($_POST['enviar'])) {
    $usuario_id = $_SESSION['usuario_id']; // ID do usuário logado
    $candidato_id = $_POST['voto_para']; // ID do candidato selecionado
    $turno_id = buscarTurnoAtivo($pdo); // ID do turno ativo

    // Verificar se o usuário já votou neste turno
    $sql = "SELECT * FROM votos WHERE usuario_id = :usuario_id AND turno_id = :turno_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id);
    $stmt->bindParam(':turno_id', $turno_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Usuário já votou neste turno
        echo "<script>alert('Você já votou neste turno.');</script>";
    } else {
        // Registrar o voto
        $sql = "INSERT INTO votos (usuario_id, candidato_id, turno_id) VALUES (:usuario_id, :candidato_id, :turno_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':candidato_id', $candidato_id);
        $stmt->bindParam(':turno_id', $turno_id);
        
        if ($stmt->execute()) {
            // Voto registrado com sucesso
            echo "<script>alert('Seu voto foi registrado com sucesso.');</script>";
        } else {
            // Falha ao registrar o voto
            echo "<script>alert('Houve um erro ao registrar seu voto. Por favor, tente novamente.');</script>";
        }
    }
}

// Redirecionar de volta para a página de votação (ou onde você preferir)
echo "<script>window.location.href = 'voto_delegado.php';</script>";
?>
