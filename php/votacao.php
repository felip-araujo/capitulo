<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Votação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Formulário de Votação</h2>
        <form action="processar_voto.php" method="post">
            <div class="mb-3">
                <label for="topico">Selecione o Tópico:</label>
                <select class="form-select" id="topico" name="topico">
                    <option value="1">Estrutura</option>
                    <option value="2">Logística</option>
                    <option value="3">Vendas</option>
                    <!-- Adicione mais opções conforme necessário -->
                </select>
            </div>
            <div class="mb-3">
                <label for="voto">Voto:</label><br>
                <input type="radio" id="aprovo" name="voto" value="aprovo">
                <label for="aprovo">Aprovo</label><br>
                <input type="radio" id="nao_aprovo" name="voto" value="nao_aprovo">
                <label for="nao_aprovo">Não Aprovo</label><br>
            </div>
            <div class="mb-3">
                <label for="observacao">Observação:</label><br>
                <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar Voto</button>
        </form>
    </div>
</body>
</html>
