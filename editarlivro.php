<?php
require_once "autoload.php";
$id = intval($_GET['id']);
$livro = Livro::getById($id);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Livro</title>
</head>

<body>
  <form action="salvaredicaolivro.php" method="POST">
    <input type="hidden" name="id" value="<?= $livro->id ?>">
    <label>Nome:</label><input type="text" name="nome" value="<?= $livro->nome ?>"><br>
    <label>Autor:</label><input type="text" name="autor" value="<?= $livro->autor ?>"><br>
    <label>Ano:</label><input type="number" name="ano" value="<?= $livro->ano ?>"><br>
    <label>Qtd:</label><input type="number" name="qtd" value="<?= $livro->qtd ?>"><br>
    <button type="submit">Salvar</button>
    <p class="text-danger">
      <?= $_SESSION['erro'] ?? "null" ?>
    </p>
    <a href="paginadetrabalho.php">Cancelar</a>
  </form>
</body>

</html>
