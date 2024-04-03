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
        <img class="logo" src="../assets/image/logo_CI21_mini.png" alt="logo-capituo-inspetorial">
        <h1 class="h3">Capítulo Inspetorial 2024</h1>

    </div>
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="alert alert-warning">Caso este seja o seu primeiro login, recomendamos que altere sua senha.

            </div>
            <a class="btn btn-outline-dark" href="logout.php">Sair</a>
            <a class="btn btn-outline-dark" href="dashvotos.php">Votações</a>
            <a class="btn btn-outline-dark" href="alterar-senha.html">Alterar minha senha</a>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="area">
                    <div class="alert alert-danger">Material do dia 09/04</div>
                    <button class="btn btn-outline-dark" href="dash9.php">
                        <a href="dash9.php"><i class="fa-solid fa-folder"></i></a>
                    </button>
                </div>
            </div>
            <div class="col-sm">
                <div class="area">
                    <div class="alert alert-danger">Material do dia 10/04</div>
                    <button class="btn btn-outline-dark">
                        <i class="fa-solid fa-folder"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm">
                <div class="area">
                    <div class="alert alert-danger">Material do dia 11/04</div>
                    <button class="btn btn-outline-dark">
                        <i class="fa-solid fa-folder"></i>
                    </button>
                </div>
            </div>
            <div class="col-sm">
                <div class="area">
                    <div class="alert alert-danger">Material do dia 12/04</div>
                    <button class="btn btn-outline-dark">
                        <i class="fa-solid fa-folder"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>





</body>

<script async src="https://kit.fontawesome.com/d4755c66d3.js" crossorigin="anonymous"></script>

<!-- CSS do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript do Bootstrap (opcional, mas necessário para funcionalidades como dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>