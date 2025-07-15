<?php
include 'conexao.php';
$id = intval($_GET['id']);
$livro = pg_fetch_assoc(pg_query_params($conn, "SELECT * FROM livros WHERE id = $1", array($id)));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Livro</title>
</head>
<body>
  <form action="salvaredicaolivro.php" method="POST">
    <input type="hidden" name="id" value="<?= $livro['id'] ?>">
    <label>Nome:</label><input type="text" name="nome" value="<?= htmlspecialchars($livro['nome']) ?>"><br>
    <label>Autor:</label><input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>"><br>
    <label>Ano:</label><input type="number" name="ano" value="<?= $livro['ano'] ?>"><br>
    <label>Qtd:</label><input type="number" name="qtd" value="<?= $livro['qtd'] ?>"><br>
    <button type="submit">Salvar</button>
    <a href="paginadetrabalho.php">Cancelar</a>
  </form>
</body>
</html>
