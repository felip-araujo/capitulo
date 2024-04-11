
<?php

function tratarErroUpload($codigo_erro)
{
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

// Verificar se o dia do evento foi selecionado
if (isset($_POST['dia_evento'])) {
    $dia_evento = $_POST['dia_evento'];
    $diretorio_base = '../files/' . $dia_evento . '/';

    // Processar upload de imagens
    processarUploads($diretorio_base, 'imagens');

    // Processar upload de documentos (Word e PDF)
    processarUploads($diretorio_base, 'documentos');
} else {
    echo "Dia do evento não selecionado.";
}

function processarUploads($diretorio_base, $tipo_arquivo)
{
    if (isset($_FILES[$tipo_arquivo]) && is_array($_FILES[$tipo_arquivo]['tmp_name'])) {
        foreach ($_FILES[$tipo_arquivo]['tmp_name'] as $key => $tmp_name) {
            if ($_FILES[$tipo_arquivo]['error'][$key] !== UPLOAD_ERR_OK) {
                tratarErroUpload($_FILES[$tipo_arquivo]['error'][$key]);
                continue; // Pular para a próxima iteração
            }

            $nome_arquivo = $_FILES[$tipo_arquivo]['name'][$key];
            $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            $arquivo_tmp = $_FILES[$tipo_arquivo]['tmp_name'][$key];
            $destino = $diretorio_base;

            // Especifica o diretório de destino com base na extensão do arquivo
            if ($tipo_arquivo === 'imagens' && in_array($extensao, ['jpg', 'jpeg', 'png'])) {
                $destino .= 'image/';
            } elseif ($tipo_arquivo === 'documentos' && in_array($extensao, ['doc', 'docx', 'pdf'])) {
                if (in_array($extensao, ['doc', 'docx'])) {
                    $destino .= 'word/';
                } elseif ($extensao == 'pdf') {
                    $destino .= 'pdf/';
                }
            } else {
                echo "Tipo de arquivo não suportado: $nome_arquivo<br>";
                continue; // Pular arquivos que não são imagem, Word ou PDF
            }

            $arquivo_destino = $destino . $nome_arquivo;

            // Tenta mover o arquivo carregado para o diretório de destino
            if (move_uploaded_file($arquivo_tmp, $arquivo_destino)) {
                echo "<script>alert('Arquivo \"$nome_arquivo\" enviado com sucesso!');</script>";
            } else {
                echo "Erro ao enviar arquivo \"$nome_arquivo\".<br>";
            }
        }
    } else {
        echo "Nenhum arquivo selecionado para upload.<br>";
    }
}

// ... Resto do código ...


?>
