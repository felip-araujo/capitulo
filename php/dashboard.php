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
    <div class="header2">

        <h1 class="h3">Capítulo Inspetorial 2024</h1>  
        <a class="log" href="logout.php">Sair</a>
    </div>


    <div class="row mt-5">
        <div class="col-md-6">
            <div class="area">
                <h2 class="h3">Fotos</h2>
                <p class="p">Acompanhe as Fotos do Capítulo Inspetorial</p>
                <?php
                // Listar todos os arquivos JPG no diretório de destino
                $diretorio_destino = '../files/';
                $arquivos = scandir($diretorio_destino);
                foreach ($arquivos as $arquivo) {
                    if ($arquivo != '.' && $arquivo != '..' && pathinfo($arquivo, PATHINFO_EXTENSION) == 'jpg') {
                        echo '<img src="' . $diretorio_destino . $arquivo . '" alt="' . $arquivo . '" class="img-thumbnail mb-3">';
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="area">
                <h2 class="h3">Documentos</h2>
                <p class="p">Clique no documento abaixo para abrir o PDF</p>
                <?php
                // Listar todos os arquivos PDF no diretório de destino
                foreach ($arquivos as $arquivo) {
                    if ($arquivo != '.' && $arquivo != '..' && pathinfo($arquivo, PATHINFO_EXTENSION) == 'pdf') {
                        echo '<a href="' . $diretorio_destino . $arquivo . '" class="btn btn-primary mb-3 ">' . $arquivo . '</a><br>';
                    }
                }
                ?>
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