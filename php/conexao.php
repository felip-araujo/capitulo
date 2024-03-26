<?php
// Configurações do banco de dados
$host = 'isma_dados.mysql.dbaas.com.br'; // Host do banco de dados
$dbname = 'isma_dados'; // Nome do banco de dados
$username = 'isma_dados'; // Nome de usuário do banco de dados
$password = 'LGPDisma0@'; // Senha do banco de dados

// Tentativa de conexão PDO
try {
    // Criação de uma instância PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configuração do modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Outras configurações opcionais
    // $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Desativar emulação de prepare
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Definir modo de busca padrão
} catch (PDOException $e) {
    // Em caso de falha na conexão, exibir mensagem de erro
    echo 'Erro de conexão: ' . $e->getMessage();
}
