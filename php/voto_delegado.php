<?php
session_start();
require 'conexao.php';


$mensagem = ''; // Inicialização da variável de mensagem

// Verificar se o usuário está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Se não estiver autenticado, redirecionar para a página de login 
    echo "<script>alert('Usuário não autenticado!')</script>";
    echo "<script>window.location.href = '../index.html';</script>";
    exit;
}

// Consulta SQL para obter todos os usuários
$sql = "SELECT id, nome FROM usuarios WHERE id BETWEEN 2 AND 22";

// Preparar e executar a consulta
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['enviar'])) {
    $usuario_id = $_SESSION['usuario_id'];
    $cargo_id = 1;

    // Consulta para verificar se o usuário já votou para o cargo de delegado do CG29
    $consulta_voto = $pdo->prepare("SELECT * FROM votos_cargos WHERE usuario_id = :usuario_id AND cargo_id = :cargo_id");
    $consulta_voto->bindParam(':usuario_id', $usuario_id);
    $consulta_voto->bindParam(':cargo_id', $cargo_id);
    $consulta_voto->execute();

    if ($consulta_voto->rowCount() > 0) {
        $mensagem = "Você já votou para o cargo de Delegado do CG29.";
    } else {
        // Inserir o voto na tabela votos_cargos
        $inserir_voto = $pdo->prepare("INSERT INTO votos_cargos (usuario_id, cargo_id, voto_para) VALUES (:usuario_id, :cargo_id, :voto_para)");
        $voto_para = $_POST['voto_para'];
        $inserir_voto->bindParam(':usuario_id', $usuario_id);
        $inserir_voto->bindParam(':cargo_id', $cargo_id);
        $inserir_voto->bindParam(':voto_para', $voto_para);

        if ($inserir_voto->execute()) {
            $mensagem = "Voto para delegado do CG29 registrado com sucesso.";
        } else {
            $mensagem = "Erro ao registrar o voto. Por favor, tente novamente.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Votação para Delegado do CG29</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div class="header">
        <img class="logo" src="../assets/image/logo_CI21_mini.png" alt="logo-capituo-inspetorial">
        <h1 class="h3">Capítulo Inspetorial 2024</h1>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 mb-3">
                <a class="btn btn-outline-dark" href="dashboard.php">Voltar</a>
            </div>
            <div class="col-md-6 mb-3 text-md-end">
            </div>
        </div>
        <div class="container mt-5">
            <!-- Mensagem de sucesso após o registro do voto -->
            <?php if (!empty($mensagem)) : ?>
                <div class="alert alert-success"><?= $mensagem ?></div>
            <?php endif; ?>

            <!-- Formulário de votação para Delegado do CG29 -->
            <h2>Votação para Delegado do CG29</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="usuario">Selecione o participante:</label>
                    <select class="form-select" id="usuario" name="voto_para" required>
                        <option value="" selected disabled>Selecione o participante</option>
                        <!-- Preencher dinamicamente as opções com os usuários -->
                        <?php foreach ($usuarios as $usuario) : ?>
                            <option value="<?= $usuario['id'] ?>"><?= $usuario['nome'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="enviar">Enviar Voto</button>
            </form>
        </div>
        <br></br>
        <?php require 'resultado_delegado.php'; ?>
</body>

</html>