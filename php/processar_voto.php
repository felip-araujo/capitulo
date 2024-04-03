<?php

if (isset($_POST['enviar'])) {
    include 'conexao.php';

    $topico = $_POST['topico'];
    $voto = $_POST['voto'];
    $observacao = $_POST['observacao'];

    var_dump($topico, $voto, $observacao);

    $qrvoto = $pdo->prepare("INSERT INTO votos (topico_id, voto, observacao) VALUES (:topico, :voto, :observacao)");
    $qrvoto->bindParam(':topico', $topico);
    $qrvoto->bindParam(':voto', $voto);
    $qrvoto->bindParam(':observacao', $observacao);
    $qrvoto->execute();

    if (!$qrvoto) {
        echo ('Voto não Enviado!');
    } else {
        echo ('Votto enviado');
    }
}
