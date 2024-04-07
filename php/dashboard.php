<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    echo "<script>alert('Usuário não autenticado!')</script>";
    echo "<script>window.location.href = '../index.html';</script>";
    exit;
}

$dia_evento = isset($_GET['dia_evento']) ? $_GET['dia_evento'] : '';
$conteudo_imagens = '';
$conteudo_pdfs = '';

// Prepara o conteúdo das imagens e PDFs, caso um dia tenha sido selecionado
if ($dia_evento != '') {
    $diretorio_imagem = "../files/$dia_evento/image/";
    $diretorio_pdf = "../files/$dia_evento/pdf/";

    // Imagens
    $arquivos_imagem = scandir($diretorio_imagem);
    foreach ($arquivos_imagem as $arquivo) {
        if ($arquivo != '.' && $arquivo != '..' && strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'jpg') {
            $conteudo_imagens .= '<img src="' . $diretorio_imagem . $arquivo . '" alt="' . $arquivo . '" class="img-thumbnail mb-3">';
            $conteudo_imagens .= '<a href="' . $diretorio_imagem . $arquivo . '" download><i class="fas fa-download"></i></a>';
        }
    }

    // PDFs
    $arquivos_pdf = scandir($diretorio_pdf);
    foreach ($arquivos_pdf as $arquivo) {
        if ($arquivo != '.' && $arquivo != '..' && strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'pdf') {
            $conteudo_pdfs .= '<a href="' . $diretorio_pdf . $arquivo . '" class="btn btn-primary mb-3">' . $arquivo . '</a><br>';
        }
    }
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
        <div class="col-sm">
            <div class="area">
                <form method="get" action="dashboard.php">
                    <select name="dia_evento" onchange="this.form.submit()" class="form-control">
                        <option value="">Selecione um Dia</option>
                        <option value="9">Dia 9</option>
                        <option value="10">Dia 10</option>
                        <option value="11">Dia 11</option>
                        <option value="12">Dia 12</option>
                    </select>
                </form>

            </div>
        </div>
    </div>
    <!-- Outros elementos HTML -->

    <div class="container">
        <!-- Seção de Imagens -->
        <div class="col-sm">
            <div class="area">
                <h3 class="alert alert-success">Imagens do dia <?php echo $dia_evento  . '/04' ?> </h3>
                <?php echo $conteudo_imagens; ?>
            </div>
        </div>

        <!-- Seção de PDFs -->
        <div class="area" style="text-align: center;">
            <h3 class="alert alert-success">Documentos do dia <?php echo $dia_evento  . '/04' ?> </h3>
            <?php echo $conteudo_pdfs; ?>
        </div>
    </div>

    <!-- Outros elementos HTML -->






</body>

<script async src="https://kit.fontawesome.com/d4755c66d3.js" crossorigin="anonymous"></script>

<!-- CSS do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript do Bootstrap (opcional, mas necessário para funcionalidades como dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>