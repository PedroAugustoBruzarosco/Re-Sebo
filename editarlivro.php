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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Editar Livro</h4>
      </div>
      <div class="card-body">
        <form action="salvaredicaolivro.php" method="POST" class="row g-3">
          <input type="hidden" name="id" value="<?= $livro->id ?>">

          <div class="col-md-6">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($livro->nome) ?>" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Autor:</label>
            <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($livro->autor) ?>" required>
          </div>

          <div class="col-md-4">
            <label class="form-label">Ano:</label>
            <input type="number" name="ano" class="form-control" value="<?= $livro->ano ?>" min="1" required>
          </div>

          <div class="col-md-4">
            <label class="form-label">Quantidade:</label>
            <input type="number" name="qtd" class="form-control" value="<?= $livro->qtd ?>" min="0" required>
          </div>

          <?php if (!empty($_SESSION['erro'])): ?>
            <div class="col-12">
              <div class="alert alert-danger">
                <?= $_SESSION['erro'];
                unset($_SESSION['erro']); ?>
              </div>
            </div>
          <?php endif; ?>

          <div class="col-12 d-flex justify-content-between">
            <a href="paginadetrabalho.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
