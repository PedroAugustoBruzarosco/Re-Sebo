<?php
require_once "autoload.php";
$consultaLivros = pg_query(Connection::getInstance(), "SELECT nome, ano, autor, qtd FROM livros ORDER BY nome");
$consultaDiscos = pg_query(Connection::getInstance(), "SELECT nome, ano, autor, qtd FROM discos ORDER BY nome");
?>

<?php
$filtroLivro = isset($_GET['buscalivro']) ? trim($_GET['buscalivro']) : '';
$sqlLivros = "SELECT id, nome, ano, autor, qtd FROM livros WHERE nome ILIKE $1 ORDER BY nome";
$consultaLivros = pg_query_params(Connection::getInstance(), $sqlLivros, array('%' . $filtroLivro . '%'));

$filtroDisco = isset($_GET['buscadisco']) ? trim($_GET['buscadisco']) : '';
$sqlDiscos = "SELECT id, nome, ano, autor, qtd FROM discos WHERE nome ILIKE $1 ORDER BY nome";
$consultaDiscos = pg_query_params(Connection::getInstance(), $sqlDiscos, array('%' . $filtroDisco . '%'));
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="assets/book.png">
  <link rel="stylesheet" href="theme.css">
  <title>Re-Sebo</title>
</head>

<body class="bg-light">

  <header class="navbar navbar-dark bg-primary p-3">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <img src="assets/book.png" alt="Logo" style="width: 40px;" class="me-2">
        <h1 class="text-white h4 mb-0">Re-Sebo</h1>
      </div>
      <a class="btn btn-light btn-sm" href="paginainicial.php">Sair</a>
    </div>
  </header>

  <main class="container my-4">
    <div class="row g-4">

      <!-- Estoque de Livros -->
      <div class="col-12 col-lg-6">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title mb-3">Estoque de Livros</h3>
            <form class="d-flex mb-3" method="GET">
              <input type="text" class="form-control me-2" name="buscalivro"
                placeholder="Pesquisar livro" value="<?= htmlspecialchars($filtroLivro) ?>">
              <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-primary">
                  <tr>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Qtd</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($livro = pg_fetch_assoc($consultaLivros)): ?>
                    <tr>
                      <td><?= htmlspecialchars($livro['nome']) ?></td>
                      <td><?= htmlspecialchars($livro['ano']) ?></td>
                      <td><?= htmlspecialchars($livro['autor']) ?></td>
                      <td><?= htmlspecialchars($livro['qtd']) ?></td>
                      <td>
                        <a href="editarlivro.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-secondary">Editar</a>
                        <a href="deletar.php?tipo=livro&id=<?= $livro['id'] ?>"
                          class="btn btn-sm btn-danger"
                          onclick="return confirm('Tem certeza que deseja deletar este livro?')">Deletar</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
            <a href="adicionarlivro.php" class="btn btn-primary btn-sm">Adicionar livro</a>
          </div>
        </div>
      </div>

      <!-- Estoque de Discos -->
      <div class="col-12 col-lg-6">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title mb-3">Estoque de Discos</h3>
            <form class="d-flex mb-3" method="GET">
              <input type="text" class="form-control me-2" name="buscadisco"
                placeholder="Pesquisar disco" value="<?= htmlspecialchars($filtroDisco) ?>">
              <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-primary">
                  <tr>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Qtd</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($disco = pg_fetch_assoc($consultaDiscos)): ?>
                    <tr>
                      <td><?= htmlspecialchars($disco['nome']) ?></td>
                      <td><?= htmlspecialchars($disco['ano']) ?></td>
                      <td><?= htmlspecialchars($disco['autor']) ?></td>
                      <td><?= htmlspecialchars($disco['qtd']) ?></td>
                      <td>
                        <a href="editardisco.php?id=<?= $disco['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="deletar.php?tipo=disco&id=<?= $disco['id'] ?>"
                          class="btn btn-sm btn-danger"
                          onclick="return confirm('Tem certeza que deseja deletar este disco?')">Deletar</a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
            <a href="adicionardisco.php" class="btn btn-primary btn-sm">Adicionar disco</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-primary text-white text-center py-3 mt-auto">
    <h2 class="h6 mb-0">&copy; Copia não professor 😏</h2>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
