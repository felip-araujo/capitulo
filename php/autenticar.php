<?php

// Iniciar a sessão
session_start();

require 'conexao.php';

if (isset($_POST['enviar']))
    $email = $_POST['email'];
$senha = $_POST['senha'];

$qr = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
$qr->execute(['email' => $email]);
$usuario = $qr->fetch(PDO::FETCH_ASSOC);


if ($email === 'admin@isma.org.br' && $usuario && $usuario['senha'] === $senha ) {
    $_SESSION['autenticado'] = true; 
    $_SESSION['nivel_acesso'] = 'admin';
    header('Location: admin-dash.php');
} else {
    if ($usuario && $usuario['senha'] === $senha) {
        // Autenticação bem-sucedida, definir variável de sessão
        $_SESSION['autenticado'] = true;
        // Redirecionar para a página do dashboard 
        header('Location: dashboard.php'); // Ajuste o caminho para o dashboard
        exit;
    } else {
        // Exibir mensagem de erro
        echo "<script>alert('E-mail ou Senha Incorretos')</script>";
        echo "<script>window.location.href = '../index.html';</script>";
    }
}
