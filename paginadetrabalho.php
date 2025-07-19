<?php
require_once "autoload.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="icon" href="assets/book.png">
  <link rel="stylesheet" href="theme.css">
  <title>Re-Sebo</title>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

  <header class="navbar bg-primary p-3">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <img src="assets/book.png" alt="Logo" style="width: 40px;" class="me-2">
        <h1 class="text-white h4 mb-0">Re-Sebo</h1>
      </div>
      <h1 class="text-white h4 mb-0">Olá <?= $_SESSION["usuario"] ?></h1>
      <a class="btn btn-light btn-sm" href="logout.php">Sair</a>
    </div>
  </header>

  <main class="p-5">
    <div class="row g-4">

      <div class="col-12 col-lg-6">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title mb-3">Estoque de Livros</h3>
            <input type="text" class="form-control mb-3" id="buscaLivro" placeholder="Pesquisar livro">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tabelaLivros">
                <thead class="table-primary">
                  <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Qtd</th>
                    <th>Núm. Páginas</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (Livro::listar() as $livro): ?>
                    <tr>
                      <td>
                        <?= !empty($livro['imagem'])
                          ? '<img width=80 height=80 src="data:image/png;base64,' . base64_encode(pg_unescape_bytea($livro['imagem'])) . '">'
                          : ''
                        ?>
                      </td>
                      <td><?= $livro['nome'] ?></td>
                      <td><?= $livro['ano'] ?></td>
                      <td><?= $livro['autor'] ?></td>
                      <td><?= $livro['editora'] ?></td>
                      <td><?= $livro['qtd'] ?></td>
                      <td><?= $livro['numeropaginas'] ?></td>
                      <td>
                        <a href="editarlivro.php?id=<?= $livro['id'] ?>" class="btn btn-sm btn-secondary">
                          <i class="bi bi-pencil"></i> <span class="btn-text">Editar</span>
                        </a>

                        <a href="deletar.php?tipo=livro&id=<?= $livro['id'] ?>"
                          class="btn btn-sm btn-danger"
                          onclick="return confirm('Tem certeza que deseja deletar este livro?')">
                          <i class="bi bi-trash"></i> <span class="btn-text">Deletar</span>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <a href="adicionarlivro.php" class="btn btn-primary btn-sm">Adicionar livro</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-6">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title mb-3">Estoque de Discos</h3>
            <input type="text" class="form-control mb-3" id="buscaDisco" placeholder="Pesquisar disco">
            <div class="table-responsive">
              <table class="table table-striped table-hover" id="tabelaDiscos">
                <thead class="table-primary">
                  <tr>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Qtd</th>
                    <th style="width: 120px; white-space: nowrap;">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach (Disco::listar() as $disco): ?>
                    <tr>
                      <td><?= $disco['nome'] ?></td>
                      <td><?= $disco['ano'] ?></td>
                      <td><?= $disco['autor'] ?></td>
                      <td><?= $disco['qtd'] ?></td>
                      <td style="white-space: nowrap; display: flex; gap: 0.5rem;">
                        <a href="editardisco.php?id=<?= $disco['id'] ?>" class="btn btn-sm btn-secondary">
                          <i class="bi bi-pencil"></i> <span class="btn-text">Editar</span>
                        </a>
                        <a href="deletar.php?tipo=disco&id=<?= $disco['id'] ?>"
                          class="btn btn-sm btn-danger"
                          onclick="return confirm('Tem certeza que deseja deletar este disco?')">
                          <i class="bi bi-trash"></i> <span class="btn-text">Deletar</span>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
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

  <script>
    function filtrarTabela(inputId, tabelaId) {
      const input = document.getElementById(inputId);
      const tabela = document.getElementById(tabelaId).querySelectorAll("tbody tr");

      input.addEventListener("input", () => {
        const termo = input.value.toLowerCase();
        tabela.forEach(tr => {
          const texto = tr.textContent.toLowerCase();
          tr.style.display = texto.includes(termo) ? "" : "none";
        });
      });
    }

    filtrarTabela("buscaLivro", "tabelaLivros");
    filtrarTabela("buscaDisco", "tabelaDiscos");
  </script>
</body>

</html>
