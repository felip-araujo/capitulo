<?php

// Verificar se o dia do evento foi selecionado
if (isset($_POST['dia_evento'])) {
    $dia_evento = $_POST['dia_evento'];
    $diretorio_base = '../files/' . $dia_evento . '/'; // Ajustar o caminho base conforme a estrutura real

    // Processar upload de imagens
    processarUploads($diretorio_base . 'image/', 'imagens');

    // Processar upload de PDFs
    processarUploads($diretorio_base . 'pdf/', 'pdf');
} else {
    echo "Dia do evento não selecionado.";
}

function processarUploads($diretorio_destino, $tipo_arquivo) {
    if (isset($_FILES[$tipo_arquivo]) && is_array($_FILES[$tipo_arquivo]['tmp_name'])) {
        foreach ($_FILES[$tipo_arquivo]['tmp_name'] as $key => $tmp_name) {
            // Tratamento de erro para uploads de PDF
            if ($tipo_arquivo === 'pdf' && $_FILES[$tipo_arquivo]['error'][$key] !== UPLOAD_ERR_OK) {
                tratarErroUpload($_FILES[$tipo_arquivo]['error'][$key]);
                continue; // Pular para a próxima iteração
            }

            $nome_arquivo = $_FILES[$tipo_arquivo]['name'][$key];
            $arquivo_tmp = $_FILES[$tipo_arquivo]['tmp_name'][$key];
            $arquivo_destino = $diretorio_destino . $nome_arquivo;

            if (move_uploaded_file($arquivo_tmp, $arquivo_destino)) {
                echo "<script>alert('Arquivo \"$nome_arquivo\" enviado com sucesso!'); window.location.href = 'admin-dash.php';</script>";
            } else {
                echo "Erro ao enviar arquivo \"$nome_arquivo\".<br>";
            }
        }
    } else {
        echo "Nenhum $tipo_arquivo selecionado para upload.<br>";
    }
}

function tratarErroUpload($codigo_erro) {
    switch ($codigo_erro) {
        case UPLOAD_ERR_INI_SIZE:
            echo "O arquivo enviado excede a diretiva upload_max_filesize em php.ini.<br>";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            echo "O arquivo enviado excede o limite definido no formulário HTML.<br>";
            break;
        case UPLOAD_ERR_PARTIAL:
            echo "O arquivo foi apenas parcialmente enviado.<br>";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "Nenhum arquivo foi enviado.<br>";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            echo "Falta uma pasta temporária.<br>";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            echo "Falha ao escrever o arquivo em disco.<br>";
            break;
        case UPLOAD_ERR_EXTENSION:
            echo "O upload foi interrompido por uma extensão PHP.<br>";
            break;
        default:
            echo "Erro desconhecido.<br>";
            break;
    }
}
?>
