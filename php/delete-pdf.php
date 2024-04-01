<?php

// Diretório onde os arquivos estão armazenados
$diretorio_destino = '../files/';

// Verifica se o formulário foi submetido e se um arquivo foi selecionado para exclusão
if(isset($_POST['arquivo'])) {
    // Obtém o nome do arquivo a ser excluído
    $arquivo = $_POST['arquivo'];

    // Verifica se o arquivo existe no diretório
    if(file_exists($diretorio_destino . $arquivo)) {
        // Exclui o arquivo
        unlink($diretorio_destino . $arquivo);
        echo "Arquivo '$arquivo' excluído com sucesso.";
    } else {
        echo "O arquivo '$arquivo' não foi encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Deletar Arquivo</title>
</head>
<body>

<?php
// Listar todos os arquivos no diretório de destino
$arquivos = scandir($diretorio_destino);
foreach ($arquivos as $arquivo) {
    if ($arquivo != '.' && $arquivo != '..' && pathinfo($arquivo, PATHINFO_EXTENSION) == 'pdf') {
        // Exibe o arquivo com um link para download
        echo '<div>';
        echo '<a href="' . $diretorio_destino . $arquivo . '" target="_blank">' . $arquivo . '</a>';
        
        // Adiciona o formulário para deletar o arquivo (apenas se o usuário for um administrador)
        echo '<form method="post">';
        echo '<input type="hidden" name="arquivo" value="' . $arquivo . '">';
        echo '<button type="submit" class="btn btn-primary">Deletar</button>';
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
