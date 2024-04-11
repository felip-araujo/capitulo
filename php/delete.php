<?php

$dia_evento = isset($_GET['dia_evento']) ? $_GET['dia_evento'] : '';
$mensagem = '';

if (isset($_POST['arquivo']) && isset($_POST['tipo'])) {
    $arquivo_para_deletar = '../files/' . $_POST['dia_evento'] . '/' . $_POST['tipo'] . '/' . $_POST['arquivo'];
    if (file_exists($arquivo_para_deletar)) {
        unlink($arquivo_para_deletar);
        $mensagem = "<div class='alert alert-success' role='alert'>Arquivo '{$_POST['arquivo']}' excluído com sucesso.</div>";
    } else {
        $mensagem = "<div class='alert alert-danger' role='alert'>O arquivo '{$_POST['arquivo']}' não foi encontrado.</div>";
    }
}

function listarArquivos($diretorio, $extensoes, $dia_evento) {
    $arquivos = scandir($diretorio);
    foreach ($arquivos as $arquivo) {
        $extensao_arquivo = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
        if ($arquivo != '.' && $arquivo != '..' && in_array($extensao_arquivo, $extensoes)) {
            echo '<div class="mb-2">';
            if (in_array($extensao_arquivo, ['jpg'])) {
                echo '<img src="' . $diretorio . $arquivo . '" alt="' . $arquivo . '" class="img-thumbnail" style="width: 100px; height: auto;">';
            } else {
                echo '<a href="' . $diretorio . $arquivo . '" class="me-2">' . $arquivo . '</a>';
            }
            echo '<form method="post" class="d-inline">';
            echo '<input type="hidden" name="arquivo" value="' . $arquivo . '">';
            echo '<input type="hidden" name="tipo" value="' . pathinfo($diretorio, PATHINFO_BASENAME) . '">';
            echo '<input type="hidden" name="dia_evento" value="' . $dia_evento . '">';
            echo '<button type="submit" class="btn btn-danger btn-sm">Deletar</button>';
            echo '</form>';
            echo '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Arquivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <?php if ($mensagem != '') echo $mensagem; ?>
        
        <form method="get" action="">
            <select name="dia_evento" onchange="this.form.submit()" class="form-select mb-4">
                <option value="">Selecione um Dia</option>
                <option value="9" <?php if ($dia_evento == "9") echo "selected"; ?>>Dia 9</option>
                <option value="10" <?php if ($dia_evento == "10") echo "selected"; ?>>Dia 10</option>
                <option value="11" <?php if ($dia_evento == "11") echo "selected"; ?>>Dia 11</option>
                <option value="12" <?php if ($dia_evento == "12") echo "selected"; ?>>Dia 12</option>
            </select>
        </form>

        <?php
        if ($dia_evento != '') {
            echo "<div class='row'>";
            echo "<div class='col-md-6'>";
            echo "<h2>Imagens</h2>";
            listarArquivos("../files/$dia_evento/image/", ['jpg'], $dia_evento);
            echo "</div>";

            echo "<div class='col-md-6'>";
            echo "<h2>Documentos</h2>";
            listarArquivos("../files/$dia_evento/pdf/", ['pdf'], $dia_evento);
            listarArquivos("../files/$dia_evento/word/", ['docx', 'doc'], $dia_evento); // Corrigido para incluir Word
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
