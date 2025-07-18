<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adicionar Disco</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
    <h2 class="text-center mb-4">Adicionar Disco</h2>
    <form action="salvadisco.php" method="POST">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" required>
      </div>
      <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" name="autor" id="autor" required>
      </div>
      <div class="mb-3">
        <label for="ano" class="form-label">Ano</label>
        <input type="number" class="form-control" name="ano" id="ano" required>
      </div>
      <div class="mb-3">
        <label for="qtd" class="form-label">Quantidade</label>
        <input type="number" class="form-control" name="qtd" id="qtd" required>
      </div>

      <?php if (!empty($_SESSION['erro'])): ?>
        <div class="col-12">
          <div class="alert alert-danger">
            <?= $_SESSION['erro'];
            unset($_SESSION['erro']); ?>
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

</html>

</html>

</html>
