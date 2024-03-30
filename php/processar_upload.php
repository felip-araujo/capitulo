<?php
$diretorio_destino = '../files/'; // Diretório de destino dos uploads

// Processar upload de imagens
if(isset($_FILES['imagens']) && is_array($_FILES['imagens']['tmp_name'])) {
    foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
        $imagem_nome = $_FILES['imagens']['name'][$key];
        $imagem_tmp = $_FILES['imagens']['tmp_name'][$key];
        $imagem_destino = $diretorio_destino . $imagem_nome;

        if(move_uploaded_file($imagem_tmp, $imagem_destino)) {
            echo "Imagem '$imagem_nome' enviada com sucesso!<br>";
        } else {
            echo "Erro ao enviar imagem '$imagem_nome'. Verifique as permissões do diretório de destino.<br>";
        }
    }
} else {
    echo "Nenhuma imagem selecionada para upload!<br>";
}

// Processar upload de PDFs
if(isset($_FILES['pdf']) && is_array($_FILES['pdf']['tmp_name'])) {
    foreach ($_FILES['pdf']['tmp_name'] as $key => $tmp_name) {
        $pdf_nome = $_FILES['pdf']['name'][$key];
        $pdf_tmp = $_FILES['pdf']['tmp_name'][$key];
        $pdf_destino = $diretorio_destino . $pdf_nome;

        if(move_uploaded_file($pdf_tmp, $pdf_destino)) {
            echo "PDF '$pdf_nome' enviado com sucesso!<br>";
        } else {
            echo "Erro ao enviar PDF '$pdf_nome'. Verifique as permissões do diretório de destino.<br>";
        }
    }
} else {
    echo "Nenhum PDF selecionado para upload!<br>";
}
?>
