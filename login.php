<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/book.png">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="theme.css">
    <title>Re-Sebo</title>
    <script>
        function validarForm() {
            const usuario = document.getElementById("usuario").value.trim();
            const senha = document.getElementById("senha").value.trim();
            if (!usuario || !senha) {
                alert("Preencha todos os campos para acessar.");
                return false;
            }
            return true;
        }
        </script>
</head>
<body>
    <?php session_start(); ?>
    <?php if (isset($_SESSION['erro'])): ?>
        <p class="text-danger"><?= htmlspecialchars($_SESSION['erro']) ?></p>
    <?php unset($_SESSION['erro']); ?>
    <?php endif; ?>
    <form action="pega.php" method="POST" onsubmit="return validarForm()">
        <h2>Login</h2><br>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario">
        <label class="senha" for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br>
        <button class="button-inverse" type="submit">Entrar</button><br>
        <a href="cadastro.php">Criar conta</a>
        <a href="paginainicial.php">Página inicial</a>
        <a href="esqueceusenha.php">Esqueceu a senha?</a>
   </form>
</body>
</html>
