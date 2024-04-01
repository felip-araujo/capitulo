<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Arquivos</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="area">
        <form action="processar_upload.php" method="post" enctype="multipart/form-data" class="login-container">
            <label class="form-label" for="imagens">Upload de Imagens (JPEG):</label>
            <input class="form-control" type="file" name="imagens[]" id="imagens" accept="image/jpeg" multiple><br><br>
            <label class="form-label" for="pdf">Upload de PDF:</label>
            <input type="file" class="form-control" name="pdf[]" accept="application/pdf"><br><br>
            <input type="submit" value="Enviar Arquivos" class="btn btn-primary">
        </form>
    </div>

    <!-- Script para carregar o Font Awesome de forma assíncrona -->
    <script async src="https://kit.fontawesome.com/d4755c66d3.js" crossorigin="anonymous"></script>
    <!-- JavaScript do Bootstrap (opcional, mas necessário para funcionalidades como dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>