<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Livro</title>
</head>
<body>
  <form action="salvadisco.php" method="POST">
    <h2>Adicionar disco</h2>
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>
    <label for="autor">Autor:</label>
    <input type="text" name="autor" id="autor" required>
    <label for="ano">Ano:</label>
    <input type="number" name="ano" id="ano" required>
    <label for="qtd">Quantidade:</label>
    <input type="number" name="qtd" id="qtd" required>
    <button type="submit">Salvar</button>
    <a href="paginadetrabalho.php">Voltar</a>
  </form>
</body>
</html>