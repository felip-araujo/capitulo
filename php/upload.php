<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Arquivos</title>
</head>
<body>
    <h2>Enviar Arquivos</h2>
    <form action="processar_upload.php" method="post" enctype="multipart/form-data">
        <label for="imagem">Upload de Imagem (JPEG):</label>
        <input type="file" name="imagem" accept="image/jpeg"><br><br>

        <label for="pdf">Upload de PDF:</label>
        <input type="file" name="pdf" accept="application/pdf"><br><br>

        <input type="submit" value="Enviar Arquivos">
    </form>
</body>
</html>
