<?php

// Inclui o arquivo de conexão
require 'conexao.php';

// Insere um novo turno na tabela `turnos`
// Altere os valores conforme necessário para o seu caso específico
function inserirPrimeiroTurno() {
    global $pdo; // Usando a variável de conexão do arquivo conexao.php

    $descricao = "Primeiro Turno";
    $dataInicio = "2023-01-01"; // Ajuste para a sua data de início
    $dataFim = "2023-01-15"; // Ajuste para a sua data de fim
    $ativo = 1; // Ativo

    try {
        $sql = "INSERT INTO turnos (descricao, data_inicio, data_fim, ativo) VALUES (:descricao, :dataInicio, :dataFim, :ativo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':descricao' => $descricao, ':dataInicio' => $dataInicio, ':dataFim' => $dataFim, ':ativo' => $ativo]);

        echo "Primeiro turno inserido com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao inserir o primeiro turno: " . $e->getMessage();
    }
}

// Exemplo de chamada da função
inserirPrimeiroTurno();

// Função para alterar o status de um turno
function alterarStatusTurno($turnoId, $ativo) {
    global $pdo; // Usando a variável de conexão do arquivo conexao.php

    try {
        $sql = "UPDATE turnos SET ativo = :ativo WHERE id = :turnoId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ativo' => $ativo, ':turnoId' => $turnoId]);

        echo "Status do turno alterado com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao alterar o status do turno: " . $e->getMessage();
    }
}

// Função para verificar qual turno está ativo
function verificarTurnoAtivo() {
    global $pdo; // Usando a variável de conexão do arquivo conexao.php

    try {
        $sql = "SELECT * FROM turnos WHERE ativo = 1";
        $stmt = $pdo->query($sql);
        $turno = $stmt->fetch(PDO::FETCH_ASSOC);

        return $turno;
    } catch (Exception $e) {
        echo "Erro ao verificar o turno ativo: " . $e->getMessage();
        return false;
    }
}

// Exemplo de como chamar as funções
// $turnoAtivo = verificarTurnoAtivo();
// Se necessário, alterar o status do turno
// alterarStatusTurno(1, 0); // Exemplo: desativa o turno com id = 1



