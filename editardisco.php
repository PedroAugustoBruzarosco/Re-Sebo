<?php
require_once "autoload.php";
$id = intval($_GET['id']);
$disco = Disco::getById($id);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Disco</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
    <h2 class="text-center mb-4">Editar Disco</h2>
    <form action="salvaredicaodisco.php" method="POST">
      <input type="hidden" name="id" value="<?= $disco->id ?>">

      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome"
          value="<?= $disco->nome ?>" required>
      </div>

      <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor"
          value="<?= $disco->autor ?>" required>
      </div>

      <div class="mb-3">
        <label for="ano" class="form-label">Ano</label>
        <input type="number" class="form-control" id="ano" name="ano"
          value="<?= $disco->ano ?>" required min="1">
      </div>

      <div class="mb-3">
        <label for="qtd" class="form-label">Quantidade</label>
        <input type="number" class="form-control" id="qtd" name="qtd"
          value="<?= $disco->qtd ?>" required min="0">
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-2">Salvar</button>
      <a href="paginadetrabalho.php" class="btn btn-secondary w-100">Cancelar</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
