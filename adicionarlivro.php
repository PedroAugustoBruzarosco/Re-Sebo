<?php
require_once "autoload.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adicionar Livro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
    <h2 class="card-title text-center mb-4">Adicionar Livro</h2>

    <form action="salvalivro.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" class="form-control" name="nome" id="nome" required>
      </div>

      <div class="mb-3">
        <label for="autor" class="form-label">Autor:</label>
        <input type="text" class="form-control" name="autor" id="autor" required>
      </div>

      <div class="mb-3">
        <label for="editora" class="form-label">Editora:</label>
        <input type="text" class="form-control" name="editora" id="editora" required>
      </div>

      <div class="mb-3">
        <label for="ano" class="form-label">Ano:</label>
        <input type="number" class="form-control" name="ano" id="ano" required min="1">
      </div>

      <div class="mb-3">
        <label for="qtd" class="form-label">Quantidade:</label>
        <input type="number" class="form-control" name="qtd" id="qtd" required min="0">
      </div>

      <div class="mb-3">
        <label for="numeropaginas" class="form-label">Número de páginas:</label>
        <input type="number" class="form-control" name="numeropaginas" id="numeropaginas" required min="1">
      </div>

      <div class="mb-3">
        <label for="imagem" class="form-label">Imagem:</label>
        <input type="file" class="form-control" name="imagem" id="imagem" accept="image/*">
      </div>

      <?php if (!empty($_SESSION['erro'])): ?>
        <div class="col-12">
          <div class="alert alert-danger">
            <?= $_SESSION['erro']; ?>
            <?php unset($_SESSION['erro']); ?>
          </div>
        </div>
      <?php endif; ?>

      <button type="submit" class="btn btn-primary w-100 mb-2">Salvar</button>
      <a href="paginadetrabalho.php" class="btn btn-secondary w-100">Voltar</a>
    </form>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
