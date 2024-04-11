<?php

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os valores do formulário
    $descricao = $_POST['descricao'];
    $dataInicio = $_POST['data_inicio'];
    $dataFim = $_POST['data_fim'];
    $ativo = 1; // Considerando o turno como ativo por padrão ao criar

    try {
        // Prepara a consulta SQL para inserir o novo turno
        $sql = "INSERT INTO turnos (descricao, data_inicio, data_fim, ativo) VALUES (:descricao, :dataInicio, :dataFim, :ativo)";
        $stmt = $pdo->prepare($sql);
        
        // Executa a consulta
        $stmt->execute([
            ':descricao' => $descricao,
            ':dataInicio' => $dataInicio,
            ':dataFim' => $dataFim,
            ':ativo' => $ativo
        ]);

        echo "<script>alert('Novo turno inserido com sucesso!');</script>";
        // Redireciona ou atualiza a página conforme necessário
    } catch (PDOException $e) {
        die("Erro ao inserir o turno: " . $e->getMessage());
    }
}

?>
