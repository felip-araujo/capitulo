<?php
// Iniciar a sessão
session_start();

require 'conexao.php';

if (isset($_POST['enviar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Supondo que a função do usuário é recuperada na mesma consulta
    $qr = $pdo->prepare('SELECT u.*, f.nome as funcao FROM usuarios u LEFT JOIN usuario_funcao uf ON u.id = uf.usuario_id LEFT JOIN funcoes f ON uf.funcao_id = f.id WHERE u.email = :email');
    $qr->execute(['email' => $email]);
    $usuario = $qr->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $usuario['senha'] === $senha) {
        $_SESSION['autenticado'] = true;
        $_SESSION['usuario_id'] = $usuario['id'];
        
        // Verificar a função do usuário e redirecionar para a página correspondente
        switch ($usuario['funcao']) {
            case 'admin':
                $_SESSION['nivel_acesso'] = 'admin';
                header('Location: admin-dash.php');
                break;
            case 'visitante':
                $_SESSION['nivel_acesso'] = 'visitante';
                header('Location: dash-visitante.php');
                break;
            default:
                // Redirecionamento padrão para outros usuários
                header('Location: dashboard.php');
                break;
        }
        exit;
    } else {
        // Exibir mensagem de erro
        echo "<script>alert('E-mail ou Senha Incorretos');</script>";
        echo "<script>window.location.href = '../index.html';</script>";
    }
}
?>
