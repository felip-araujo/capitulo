<?php
$diretorio_destino = '../files/'; // Diretório de destino dos uploads

// Processar upload de imagens
if (isset($_FILES['imagens']) && is_array($_FILES['imagens']['tmp_name'])) {
    foreach ($_FILES['imagens']['tmp_name'] as $key => $tmp_name) {
        $imagem_nome = $_FILES['imagens']['name'][$key];
        $imagem_tmp = $_FILES['imagens']['tmp_name'][$key];
        $imagem_destino = $diretorio_destino . $imagem_nome;

        if (move_uploaded_file($imagem_tmp, $imagem_destino)) {
            // echo "Imagem '$imagem_nome' enviada com sucesso!<br>";   
            echo "<script>alert('Imagem \"$imagem_nome\" enviada com sucesso!'); window.location.href = 'admin-dash.php';</script>";
            exit();
            // echo "<script>alert(Imagem '$imagem_nome' enviada com sucesso!<br>)</script>";
        } else {
            echo "Erro ao enviar imagem, ou nenhuma imagem selecionada \"$imagem_nome\".<br>";
            echo "<script>window.location.href = 'admin-dash.php';</script>";
        }
    }
} else {
}

// Processar upload de PDFs
if (isset($_FILES['pdf']) && is_array($_FILES['pdf']['tmp_name'])) {
    foreach ($_FILES['pdf']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['pdf']['error'][$key] !== UPLOAD_ERR_OK) {
            echo "Erro ao enviar o arquivo '{$pdf_nome}': ";
            switch ($_FILES['pdf']['error'][$key]) {
                case UPLOAD_ERR_INI_SIZE:
                    echo "O arquivo enviado excede a diretiva upload_max_filesize em php.ini.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo "O arquivo enviado excede o limite definido no formulário HTML.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "O arquivo foi apenas parcialmente enviado.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "Nenhum arquivo foi enviado.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "Falta uma pasta temporária.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "Falha ao escrever o arquivo em disco.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "O upload foi interrompido por uma extensão PHP.";
                    break;
                default:
                    echo "Erro desconhecido.";
                    break;
            }
            echo "<br>";
            continue; // Continue para a próxima iteração
        }

        $pdf_nome = $_FILES['pdf']['name'][$key];
        $pdf_tmp = $_FILES['pdf']['tmp_name'][$key];
        $pdf_destino = $diretorio_destino . $pdf_nome;

        if (move_uploaded_file($pdf_tmp, $pdf_destino)) {
            echo "PDF '{$pdf_nome}' enviado com sucesso!<br>";
        } else {
            echo "Erro ao enviar PDF '{$pdf_nome}'. Verifique as permissões do diretório de destino.<br>";
        }
    }
} else {
    // echo "Nenhum PDF selecionado para upload!<br>";
}
