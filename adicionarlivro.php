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

<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Adicionar Livro</h2>

            <form action="salvalivro.php" method="POST">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" required>
              </div>

              <div class="mb-3">
                <label for="autor" class="form-label">Autor:</label>
                <input type="text" class="form-control" name="autor" id="autor" required>
              </div>

              <div class="mb-3">
                <label for="ano" class="form-label">Ano:</label>
                <input type="number" class="form-control" name="ano" id="ano" required min="1">
              </div>

              <div class="mb-3">
                <label for="qtd" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" name="qtd" id="qtd" required min="0">
              </div>

              <?php if (!empty($_SESSION['erro'])): ?>
                <div class="col-12">
                  <div class="alert alert-danger">
                    <?= $_SESSION['erro'];
                    unset($_SESSION['erro']); ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="d-flex justify-content-between">
                <a href="paginadetrabalho.php" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
