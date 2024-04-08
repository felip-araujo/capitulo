<?php
// Iniciar a sessão
session_start();

require 'conexao.php';

if (isset($_POST['enviar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $qr = $pdo->prepare('SELECT u.*, f.nome as funcao FROM usuarios u LEFT JOIN usuario_funcao uf ON u.id = uf.usuario_id LEFT JOIN funcoes f ON uf.funcao_id = f.id WHERE u.email = :email');
    $qr->execute(['email' => $email]);
    $usuario = $qr->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $usuario['senha'] === $senha) {
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario_id'] = $usuario['id'];

        // Verificar se o usuário é um admin
        if ($usuario['funcao'] === 'admin') {
            $_SESSION['nivel_acesso'] = 'admin';
            header('Location: admin-dash.php');
            exit;
        } else {
            // Usuário comum
            header('Location: dashboard.php'); // Ajuste o caminho para o dashboard do usuário comum
            exit;
        }
    } else {
        // Exibir mensagem de erro
        echo "<script>alert('E-mail ou Senha Incorretos');</script>";
        echo "<script>window.location.href = '../index.html';</script>";
    }
}
?>
