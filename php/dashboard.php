<?php
session_start();
require 'conexao.php';

// Verificar se o usuário está autenticado
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    echo "<script>alert('Usuário não autenticado!');</script>";
    echo "<script>window.location.href = '../index.html';</script>";
    exit;
}

$dia_evento = isset($_GET['dia_evento']) ? $_GET['dia_evento'] : '';
$conteudo_imagens = '';
$conteudo_pdfs = '';

// Função para gerar URL da imagem de alta definição com base no dia do evento
function gerarUrlImagemAltaDefinicao($dia_evento)
{
    $links = [
        "9" => "https://gofile.me/73poV/EfG7YqWku",
        "10" => "https://gofile.me/73poV/odWcnG1Ql",
        // Adicione os links para outros dias aqui conforme eles estiverem disponíveis
    ];

    return isset($links[$dia_evento]) ? $links[$dia_evento] : "#";
}

// Preparar o conteúdo das imagens e PDFs, caso um dia tenha sido selecionado
if ($dia_evento != '') {
    $diretorio_imagem = "../files/$dia_evento/image/";
    $diretorio_pdf = "../files/$dia_evento/pdf/";
    $diretorio_word = "../files/$dia_evento/word/";

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

    // Arquivos Word
    $arquivos_word = scandir($diretorio_word);
    $conteudo_word = ''; // Inicialize a variável para armazenar links de arquivos Word
    foreach ($arquivos_word as $arquivo) {
        if ($arquivo != '.' && $arquivo != '..' && (strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'docx' || strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == 'doc')) {
            $conteudo_word .= '<a href="' . $diretorio_word . $arquivo . '" class="btn btn-secondary mb-3">' . $arquivo . '</a><br>';
        }
    }





    // Gera o URL para o botão de alta definição
    $url_alta_definicao = gerarUrlImagemAltaDefinicao($dia_evento);
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
            <div class="alert alert-warning">Caso este seja o seu primeiro login, recomendamos que altere sua senha.</div>
            <a class="btn btn-outline-dark" href="logout.php">Sair</a>
            <!-- <a class="btn btn-outline-dark" href="votacoes.php">Votações</a> Descomentar esta linha -->
            <a class="btn btn-outline-dark" href="alterar-senha.html">Alterar minha senha</a>
        </div>
    </div>
    <div class="container">
        <div class="area">
            <div class="alert alert-warning">Selecione um dia para exibir o conteúdo (Fotos e Documentos)</div>
            <form method="get" action="dashboard.php">
                <select name="dia_evento" onchange="this.form.submit()" class="form-control">
                    <option value="">Selecione um dia (Ex: 09-04-2024 )</option>
                    <option value="9">09-04-2024</option>
                    <option value="10">10-04-2024</option>
                    <option value="11">11-04-2024</option>
                    <option value="12">12-04-2024</option>
                </select>
            </form> 
            <?php if ($dia_evento != '') : ?>
                <div class="container">
                    <br>
                    <h3 class="alert alert-success">Imagens do dia <?php echo $dia_evento; ?>/04</h3>
                    <!-- Botão para download de fotos de alta definição -->
                    <a href="<?php echo $url_alta_definicao; ?>" class="btn btn-success" target="_blank">Baixar Fotos com Alta Definição</a><br></br>
                    <?php echo $conteudo_imagens; ?>
                    <div class="area" style="text-align: center;">
                        <div class="area" style="text-align: center;">
                            <h3 class="alert alert-success">Documentos do dia <?php echo $dia_evento; ?>/04</h3>
                            <?php echo $conteudo_pdfs; ?>
                            <?php echo $conteudo_word; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script async src="https://kit.fontawesome.com/d4755c66d3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>