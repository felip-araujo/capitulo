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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>CI 2024</title>
</head>
<body> 
    <div class="header">

        <h1 class="h3">Bem-vindo ao Capítulo Inspetorial 2024 </h1>
    </div>
    <p>Conteúdo protegido. Apenas usuários autenticados podem acessar esta página.</p>
    <p><a href="logout.php"i class="fa-solid fa-arrow-right-from-bracket"></a></p>
</body>

<script async src="https://kit.fontawesome.com/d4755c66d3.js" crossorigin="anonymous"></script>

<!-- CSS do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript do Bootstrap (opcional, mas necessário para funcionalidades como dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
