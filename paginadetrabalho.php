<?php
require_once "autoload.php";
$consultaLivros = pg_query(Connection::getInstance(), "SELECT nome, ano, autor, qtd FROM livros ORDER BY nome");
$consultaDiscos = pg_query(Connection::getInstance(), "SELECT nome, ano, autor, qtd FROM discos ORDER BY nome");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/book.png">
  <link rel="stylesheet" href="theme.css">
  <link rel="stylesheet" href="paginadetrabalho.css">
  <title>Re-Sebo</title>
</head>

<body>
  <?php
  $filtroLivro = isset($_GET['buscalivro']) ? trim($_GET['buscalivro']) : '';
  $sqlLivros = "SELECT id, nome, ano, autor, qtd FROM livros WHERE nome ILIKE $1 ORDER BY nome";
  $consultaLivros = pg_query_params(Connection::getInstance(), $sqlLivros, array('%' . $filtroLivro . '%'));
  $filtroDisco = isset($_GET['buscadisco']) ? trim($_GET['buscadisco']) : '';
  $sqlDiscos = "SELECT id, nome, ano, autor, qtd FROM discos WHERE nome ILIKE $1 ORDER BY nome";
  $consultaDiscos = pg_query_params(Connection::getInstance(), $sqlDiscos, array('%' . $filtroDisco . '%'));
  ?>
  <header>
    <div class="list">
      <img class="icon" src="assets/book.png">
      <h1 style="font-size: 200%;">Re-Sebo</h1>
    </div>
    <a class="button" href="paginainicial.php">Sair</a>
  </header>
  <main>
    <div class="tabela-container">
      <h3>Estoque de Livros</h3>
      <form method="GET">
        <input type="text" name="buscalivro" placeholder="Pesquisar livro" value="<?= htmlspecialchars($filtroLivro) ?>">
        <button type="submit">Buscar</button>
      </form>
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Ano</th>
            <th>Autor</th>
            <th>Qtd</th>
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
                <a href="editarlivro.php?id=<?= $livro['id'] ?>">Editar</a> |
                <a href="deletar.php?tipo=livro&id=<?= $livro['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este livro?')">Deletar</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <a href="adicionarlivro.php">Adicionar livro</a>
    </div>

    <div class="tabela-container">
      <h3>Estoque de Discos</h3>
      <form method="GET">
        <input type="text" name="buscadisco" placeholder="Pesquisar disco" value="<?= htmlspecialchars($filtroDisco) ?>">
        <button type="submit">Buscar</button>
      </form>
      <table>
        <thead>
          <tr>
            <th>Nome</th>
            <th>Ano</th>
            <th>Autor</th>
            <th>Qtd</th>
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
                <a href="editardisco.php?id=<?= $disco['id'] ?>">Editar</a> |
                <a href="deletar.php?tipo=disco&id=<?= $disco['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar este disco?')">Deletar</a>
              </td>
            </tr>
          <?php endwhile; ?>

        </tbody>
      </table>
      <a href="adicionardisco.php">Adicionar disco</a>
    </div>
  </main>

  <footer>
    <h2>&copy; Cópia não professor 😏</h2>
  </footer>
</body>

</html>
