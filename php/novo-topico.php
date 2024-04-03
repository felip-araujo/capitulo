<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se todos os campos obrigatórios estão preenchidos
    if (isset($_POST['novotema'], $_POST['data_inicio'], $_POST['data_termino']) &&
        !empty(trim($_POST['novotema'])) && !empty(trim($_POST['data_inicio'])) && !empty(trim($_POST['data_termino']))) {
        
        include 'conexao.php';

        // Obtém os valores dos campos do formulário
        $tema = $_POST['novotema'];
        $data_inicio = $_POST['data_inicio'];
        $data_termino = $_POST['data_termino'];

        // Prepara e executa a consulta SQL para inserir um novo tópico de votação
        $qrin = $pdo->prepare("INSERT INTO topicos (nome, data_inicio, data_fim) VALUES (:tema, :data_inicio, :data_termino)");
        $qrin->bindParam(':tema', $tema);
        $qrin->bindParam(':data_inicio', $data_inicio);
        $qrin->bindParam(':data_termino', $data_termino);
        $resultado = $qrin->execute();

        // Verifica se a consulta foi executada com sucesso
        if ($resultado) {
            $mensagem = "Novo tema inserido com sucesso.";
        } else {
            $mensagem = "Erro ao inserir novo tema.";
        }
    } else {
        $mensagem = "Todos os campos são obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Votação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Inserir novo Tema para Votação</h2>
        <!-- Exibe mensagens para o usuário -->
        <?php if (isset($mensagem)): ?>
            <div class="alert <?php echo ($resultado ? 'alert-success' : 'alert-danger'); ?>"><?php echo $mensagem; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <input type="text" class="form-control" name="novotema" placeholder="Novo tema" required>
            <label for="date" class="h4">Data de inicio</label>
            <input type="date" name="data_inicio" class="form-control" required>
            <label for="date" class="h4">Data de Termino</label>
            <input type="date" name="data_termino" class="form-control" required>
            <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
        </form>
    </div>
</body>

</html>
