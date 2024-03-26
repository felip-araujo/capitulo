<?php
$diretorio_destino = '../files/'; // Diretório de destino dos uploads

// Processar upload de imagem
if(isset($_FILES['imagem'])) {
    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_tmp = $_FILES['imagem']['tmp_name'];
    $imagem_destino = $diretorio_destino . $imagem_nome;

    if(move_uploaded_file($imagem_tmp, $imagem_destino)) {
        echo 'Imagem enviada com sucesso!';
    } else {
        echo 'Erro ao enviar imagem. Verifique as permissões do diretório de destino.';
    }
}

// Processar upload de PDF
if(isset($_FILES['pdf'])) {
    $pdf_nome = $_FILES['pdf']['name'];
    $pdf_tmp = $_FILES['pdf']['tmp_name'];
    $pdf_destino = $diretorio_destino . $pdf_nome;

    if(move_uploaded_file($pdf_tmp, $pdf_destino)) {
        echo 'PDF enviado com sucesso!';
    } else {
        echo 'Erro ao enviar PDF. Verifique as permissões do diretório de destino.';
    }
}
?>
