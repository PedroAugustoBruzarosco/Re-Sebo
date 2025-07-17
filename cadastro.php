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

    <div class="card shadow p-4" style="max-width: 450px; width: 100%;">
        <div class="text-center mb-3">
            <img src="assets/book.png" alt="Logo" style="width: 50px;">
            <h2 class="mt-2">Cadastro</h2>
        </div>

        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-danger py-2" role="alert">
                <?= htmlspecialchars($_SESSION['erro']);
                unset($_SESSION['erro']); ?>
            </div>
        <?php endif; ?>

        <form id="form" action="insere.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="confirmarsenha" class="form-label">Confirmar senha</label>
                <input type="password" class="form-control" id="confirmarsenha" name="confirmarsenha" required>
            </div>
            <button class="btn btn-primary w-100 mb-3" type="submit">Cadastrar</button>
        </form>

        <div class="d-flex justify-content-between">
            <a href="paginainicial.php" class="small">Página inicial</a>
            <a href="esqueceusenha.php" class="small">Esqueceu a senha?</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
