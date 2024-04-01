<?php

// Diretório onde as imagens estão armazenadas
$diretorio_destino = '../files/';

// Verifica se o formulário foi submetido e se um arquivo foi selecionado para exclusão
if (isset($_POST['arquivo'])) {
    // Obtém o nome do arquivo a ser excluído
    $arquivo = $_POST['arquivo'];

    // Verifica se o arquivo existe no diretório
    if (file_exists($diretorio_destino . $arquivo)) {
        // Exclui o arquivo
        unlink($diretorio_destino . $arquivo);
        echo "Arquivo '$arquivo' excluído com sucesso.";
    } else {
        echo "O arquivo '$arquivo' não foi encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Imagem</title>
</head>

<body>

    <?php
    // Listar todos os arquivos JPG no diretório de destino
    $arquivos = scandir($diretorio_destino);
    foreach ($arquivos as $arquivo) {
        if ($arquivo != '.' && $arquivo != '..' && pathinfo($arquivo, PATHINFO_EXTENSION) == 'jpg') {
            // Exibe a imagem
            echo '<div>';
            echo '<img src="' . $diretorio_destino . $arquivo . '" alt="' . $arquivo . '" class="img-thumbnail mb-3">';

            // Adiciona o formulário para deletar a imagem (apenas se o usuário for um administrador)
            echo '<form method="post">';
            echo '<input type="hidden" name="arquivo" value="' . $arquivo . '"> ';
            echo '<button type="submit" class=" btn btn-danger">Deletar</button>';
            echo '</form>';

            echo '</div>';
        }
    }
    ?>

</body>

<!-- CSS do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JavaScript do Bootstrap (opcional, mas necessário para funcionalidades como dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>