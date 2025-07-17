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

    $livro->id = intval($post['id']);
    $livro->nome = trim($post['nome']);
    $livro->autor = trim($post['autor']);
    $livro->ano = intval($post['ano']);
    $livro->qtd = intval($post['qtd']);

    if (trim($livro->nome) === "") {
      $_SESSION['erro'] = "O campo Nome não pode estar vazio.";
      return null;
    }

    if (trim($livro->autor) === "") {
      $_SESSION['erro'] = "O campo Autor não pode estar vazio.";
      return null;
    }

    if ($livro->ano <= 0) {
      $_SESSION['erro'] = "O Ano deve ser maior que zero.";
      return null;
    }

    if ($livro->qtd < 0) {
      $_SESSION['erro'] = "A Quantidade não pode ser negativa.";
      return null;
    }

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

  public function atualizar()
  {

    $sql = "UPDATE livros SET nome = $1, autor = $2, ano = $3, qtd = $4 WHERE id = $5";
    $resultado = pg_query_params(Connection::getInstance(), $sql, [$this->nome, $this->autor, $this->ano, $this->qtd, $this->id]);

    if (!$resultado) {
      $_SESSION['erro'] = "Erro ao atualizar o livro.";
    } else {
      $_SESSION['erro'] = null;
    }

    header("Location: paginadetrabalho.php");
  }
}
