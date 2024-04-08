<?php
session_start();
require 'conexao.php';

if ($_SESSION['nivel_acesso'] !== 'admin') {
    echo "Acesso negado!";
    exit;
}

$mensagem = "";
$usuarioId = $nome = $email = $funcaoId = "";
$editar = false;

if (isset($_GET['editar_id'])) {
    $usuarioId = $_GET['editar_id'];
    $editar = true;
    
    $stmt = $pdo->prepare("SELECT u.*, uf.funcao_id FROM usuarios u LEFT JOIN usuario_funcao uf ON u.id = uf.usuario_id WHERE u.id = ?");
    $stmt->execute([$usuarioId]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $nome = $usuario['nome'];
        $email = $usuario['email'];
        $funcaoId = $usuario['funcao_id'];
    } else {
        $mensagem = "Usuário não encontrado.";
        $editar = false;
    }
}

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $funcaoId = $_POST['funcao'];
    $usuarioId = $_POST['usuario_id'];

    if ($editar) {
        if (!empty($senha)) {
            $query = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nome, $email, $senha, $usuarioId]);
        } else {
            $query = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nome, $email, $usuarioId]);
        }
        $stmtFuncao = $pdo->prepare("REPLACE INTO usuario_funcao (usuario_id, funcao_id) VALUES (?, ?)");
        $stmtFuncao->execute([$usuarioId, $funcaoId]);
        $mensagem = "Usuário atualizado com sucesso.";
    } else {
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nome, $email, $senha]);
        $novoUsuarioId = $pdo->lastInsertId();
        
        $stmtFuncao = $pdo->prepare("INSERT INTO usuario_funcao (usuario_id, funcao_id) VALUES (?, ?)");
        $stmtFuncao->execute([$novoUsuarioId, $funcaoId]);
        $mensagem = "Novo usuário cadastrado com sucesso.";
    }
    header('Location: gerenciar_usuario.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editar ? "Editar Usuário" : "Cadastrar Novo Usuário" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2><?= $editar ? "Editar Usuário" : "Cadastrar Novo Usuário" ?></h2>
    <form action="" method="POST">
        <input type="hidden" name="usuario_id" value="<?= $usuarioId ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $nome ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" <?= $editar ? '' : 'required' ?>>
            <?php if ($editar): ?>
                <small class="text-muted">Deixe em branco para manter a senha atual.</small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="funcao" class="form-label">Função:</label>
            <select class="form-select" id="funcao" name="funcao" required>
                <option value="">Selecione uma função</option>
                <?php
                $funcoes = $pdo->query("SELECT id, nome FROM funcoes")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($funcoes as $funcao) {
                    echo "<option value='{$funcao['id']}'" . ($funcaoId == $funcao['id'] ? " selected" : "") . ">{$funcao['nome']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="enviar"><?= $editar ? "Atualizar" : "Cadastrar" ?></button>
        <div class="btn btn-secondary">
            <a href="admin-dash.php" style="list-style: none; text-decoration:none;color:#eee;">Voltar</a>
        </div>
    </form>
</div>
</body>
</html>
