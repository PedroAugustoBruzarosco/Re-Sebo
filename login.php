<?php
require_once "autoload.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/book.png">
    <link rel="stylesheet" href="theme.css">
    <title>Re-Sebo</title>
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-3">
            <img src="assets/book.png" alt="Logo" style="width: 50px;">
            <h2 class="mt-2">Login</h2>
        </div>

        <form action="pega.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>

            <?php if (isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger py-2" role="alert">
                    <?= $_SESSION['erro'] ?>
                    <?php unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
        </form>

        <div class="d-flex justify-content-between">
            <a href="cadastro.php" class="small">Criar conta</a>
            <a href="paginainicial.php" class="small">Página inicial</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
