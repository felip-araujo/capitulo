<?php
session_start();

// Verificar se o usuário está autenticado 
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    // Se não estiver autenticado, redirecionar para a página de login 
    echo "<script>alert('Usuário não autenticado!')</script>";
    echo "<script>window.location.href = '../index.html';</script>";
    exit;
}

if (isset($_POST['enviar'])) {
    include 'conexao.php';
    $email = $_POST['email'];
    $senha_antiga = $_POST['senha-antiga'];
    $nova_senha = $_POST['nova-senha'];
    $confirme_senha = $_POST['confirme-senha'];

    if ($nova_senha === $confirme_senha) {
        $qr = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
        $qr->execute(['email' => $email]);
        $usuario = $qr->fetch(PDO::FETCH_ASSOC);

        if ($email === $usuario['email'] && $senha_antiga === $usuario['senha']) {
            // var_dump($usuario['senha'], $email, $senha_antiga, $nova_senha); 

            $qralter = $pdo->prepare('UPDATE usuarios SET senha = :nova_senha WHERE email = :email');
            $qralter->bindParam(':nova_senha', $nova_senha);
            $qralter->bindParam(':email', $email);
            $qralter->execute();

            if (!$qralter) {
                echo '<script>alert("Erro na solicitação, tente novamente mais tarde!")</script>';
                echo '<script>window.location.href="dashboard.php"</script>';
            } else {
                echo '<script>alert("Senha alterada com sucesso!")</script>';
                echo '<script>window.location.href="dashboard.php"</script>';
            }
        } else {
            echo '<script>alert("E-mail não encontrado ou senha não cadastrada no banco de dados")</script>';
            echo '<script>window.location.href="dashboard.php"</script>';
        }
    } else {
        echo '<script>alert("As senhas não coincidem")</script>';
        echo '<script>window.location.href="dashboard.php"</script>';
    }
}
