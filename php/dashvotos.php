<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>CI 2024</title>
    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="header">
        <img class="logo" src="../assets/image/logo_CI21_mini.png" alt="logo-capituo-inspetorial">
        <h1 class="h3">Capítulo Inspetorial 2024</h1>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 mb-3">
                <a class="btn btn-outline-dark" href="dashboard.php">Voltar</a>
            </div>
            <div class="col-md-6 mb-3 text-md-end">
                <a class="btn btn-outline-dark me-2" href="alterar-senha.html">Alterar minha senha</a>
                <a href="" class="btn btn-outline-dark" onclick="window.print()">Imprimir Resultados</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="area">
                    <?php include 'votacao.php'; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="area">
                    <?php include 'resultado-votacao.php'; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="area">
                    <?php include 'observacao.php'; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="area">
                    <?php include 'dados-votacao.php'; ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script async src="https://kit.fontawesome.com/d4755c66d3.js" crossorigin="anonymous"></script>

<!-- JavaScript do Bootstrap (opcional, mas necessário para funcionalidades como dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
