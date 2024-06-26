<?php

// Iniciar a sessão
session_start();
require_once 'conexao.php';

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
        <h1 class="h3">Painel Admistrativo</h1>

    </div>
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="alert alert-danger">Tamanho Máximo 8Mb | Resolução Máxima Fotos 600x600px.</div>
            <a class="btn btn-outline-dark" href="logout.php">Sair</a>
            <a class="btn btn-outline-dark" href="listar-votos.php">Listagem de votos</a>
            <a class="btn btn-outline-dark" href="resultado-primeiro-turno.php">Resultados 1ª Turno</a>
            <a class="btn btn-outline-dark" href="dados-votacao.php">Resultados Detalhados</a>
            <a class="btn btn-outline-dark" href="resultado_delegado.php">Resultados Votacao Delegado CG29</a>
            <a class="btn btn-outline-dark" href="observacao.php">Observacoes</a>
            <a class="btn btn-outline-dark" href="gerenciar_usuario.php">Cadastro e Edição de Usuarios</a>
            <a class="btn btn-outline-dark" href="encerrar_turno.php">Encerrar Turno</a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="area">
            <p class="alert alert-warning">Upload de arquivos (Selecione um dia)</p>
                <?php include 'upload.php' ?>
            </div>
            <div class="area">
                <?php
                    require 'novo-topico.php';
                ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="area">
                <p class="alert alert-warning">Exclusão de arquivos (Selecione um dia)</p>
                <?php include 'delete.php' ?>
                ?>
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