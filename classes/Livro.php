<?php
class Livro
{
  public string $id;
  public string $nome;
  public string $autor;
  public int $ano;
  public int $qtd;

  public function __construct() {}

  public static function fromPost($post)
  {
    $livro = new Livro();

    if (isset($livro->id)) {
      $livro->id = intval($post['id']);
    }
    $livro->nome = trim($post['nome']);
    $livro->autor = trim($post['autor']);
    $livro->ano = intval($post['ano']);
    $livro->qtd = intval($post['qtd']);

    return $livro;
  }

  public static function getById(string $id)
  {
    $livro = new Livro();

    $dados = pg_fetch_assoc(pg_query_params(Connection::getInstance(), "SELECT * FROM livros WHERE id = $1", array($id)));

    $livro->id = $dados['id'];
    $livro->nome = $dados['nome'];
    $livro->autor = $dados['autor'];
    $livro->ano = $dados['ano'];
    $livro->qtd = $dados['qtd'];

    return $livro;
  }

  public function  salvar()
  {
    $sql = "INSERT INTO livros (nome, autor, ano, qtd) VALUES ($1, $2, $3, $4)";
    $resultado = pg_query_params(Connection::getInstance(), $sql, array($this->nome, $this->autor, $this->ano, $this->qtd));

    if ($resultado) {
      $_SESSION['erro'] = null;
      header("Location: paginadetrabalho.php");
    } else {
      $_SESSION['erro'] = "Erro ao salvar livro.";
      header("Location: adicionarlivro.php");
    }
  }

  public function atualizar()
  {
    $sql = "UPDATE livros SET nome = $1, autor = $2, ano = $3, qtd = $4 WHERE id = $5";
    $resultado = pg_query_params(Connection::getInstance(), $sql, [$this->nome, $this->autor, $this->ano, $this->qtd, $this->id]);

    if ($resultado) {
      $_SESSION['erro'] = null;
      header("Location: paginadetrabalho.php");
    } else {
      $_SESSION['erro'] = "Erro ao atualizar o livro.";
      header("Location: editarlivro.php?id=" . $this->id);
    }
  }
}
