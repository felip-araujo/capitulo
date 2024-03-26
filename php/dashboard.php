<?php

// Iniciar a sessão
session_start(); 

// Verificar se o usuário está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Se não estiver autenticado, redirecionar para a página de login
    echo "<script>alert('Usuário não autenticado!')</script>"; 
    echo "<script>window.location.href = '../index.html';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>CI 2024</title>
</head>
<body> 
    <h1>Bem-vindo ao Capítulo Inspetorial 2024</h1>
    <p>Conteúdo protegido. Apenas usuários autenticados podem acessar esta página.</p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>
