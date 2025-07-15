<?php session_start()?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/book.png">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="stylesheet" href="theme.css">
    <title>Re-Sebo</title>
</head>
<body>
    <?php if (isset($_SESSION['erro'])): ?>
        <p id="erro1"><?= htmlspecialchars($_SESSION['erro']) ?></p>
    <?php unset($_SESSION['erro'])?>
    <?php endif; ?>
    <form id="form" action="insere.php" method="POST">
        <h2>Cadastro</h2>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>
        
        <label for="confirmarsenha">Confirmar senha:</label>
        <input type="password" id="confirmarsenha" name="confirmarsenha">

        <button class="button-inverse" type="submit" href="#">Cadastrar</button><br>
        <a href="paginainicial.php">Página inicial</a>
        <a href="esqueceusenha.php">Esqueceu a senha?</a>
   </form>
</body>
</html>
