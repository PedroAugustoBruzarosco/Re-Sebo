<?php
include 'conexao.php';
$id = intval($_GET['id']);
$disco = pg_fetch_assoc(pg_query_params($conn, "SELECT * FROM discos WHERE id = $1", array($id)));
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Disco</title>
</head>
<body>
  <form action="salvaredicaodisco.php" method="POST">
    <input type="hidden" name="id" value="<?= $disco['id'] ?>">
    <label>Nome:</label><input type="text" name="nome" value="<?= htmlspecialchars($disco['nome']) ?>"><br>
    <label>Autor:</label><input type="text" name="autor" value="<?= htmlspecialchars($disco['autor']) ?>"><br>
    <label>Ano:</label><input type="number" name="ano" value="<?= $disco['ano'] ?>"><br>
    <label>Qtd:</label><input type="number" name="qtd" value="<?= $disco['qtd'] ?>"><br>
    <button type="submit">Salvar</button>
    <a href="paginadetrabalho.php">Cancelar</a>
  </form>
</body>
</html>
