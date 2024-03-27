<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Envio de Arquivos</title>
</head>

<body>
    <h2>Enviar Arquivos</h2>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="area">
                <form action="processar_upload.php" method="post" enctype="multipart/form-data" class="login-container">
                    <label class="form-label" for="imagem">Upload de Imagem (JPEG):</label>
                    <input class="form-control" type="file" name="imagem" accept="image/jpeg"><br><br>
                    <label class="form-label" for="pdf">Upload de PDF:</label>
                    <input type="file" name="pdf" accept="application/pdf"><br><br>
                    <input type="submit" value="Enviar Arquivos" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>