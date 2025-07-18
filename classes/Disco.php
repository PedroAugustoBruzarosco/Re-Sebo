<?php
class Disco
{
  public string $id;
  public string $nome;
  public string $autor;
  public int $ano;
  public int $qtd;

  public function __construct() {}

  public static function fromPost($post): Disco
  {
    $disco = new Disco();

    if (!empty($post['id'])) {
      $disco->id = intval($post['id']);
    }
    $disco->nome = trim($post['nome']);
    $disco->autor = trim($post['autor']);
    $disco->ano = intval($post['ano']);
    $disco->qtd = intval($post['qtd']);

    return $disco;
  }

  public static function getById(string $id): Disco
  {
    $disco = new Disco();

    $dados = pg_fetch_assoc(
      pg_query_params(
        Connection::getInstance(),
        "SELECT * FROM discos WHERE id = $1",
        array($id)
      )
    );

    if ($dados) {
      $disco->id = $dados['id'];
      $disco->nome = $dados['nome'];
      $disco->autor = $dados['autor'];
      $disco->ano = (int) $dados['ano'];
      $disco->qtd = (int) $dados['qtd'];
    }

    return $disco;
  }

  public function salvar()
  {
    $sql = "INSERT INTO discos (nome, autor, ano, qtd) VALUES ($1, $2, $3, $4)";
    $resultado = pg_query_params(
      Connection::getInstance(),
      $sql,
      array($this->nome, $this->autor, $this->ano, $this->qtd)
    );

    if ($resultado) {
      $_SESSION['erro'] = null;
      header("Location: paginadetrabalho.php");
    } else {
      $_SESSION['erro'] = "Erro ao salvar disco.";
      header("Location: adicionardisco.php");
    }
    exit;
  }

  public static function listar()
  {
    $resultado = pg_query(
      Connection::getInstance(),
      "SELECT id, nome, ano, autor, qtd FROM discos ORDER BY nome"
    );

    return pg_fetch_all($resultado) ?: [];
  }

  public function atualizar()
  {
    $sql = "UPDATE discos SET nome = $1, autor = $2, ano = $3, qtd = $4 WHERE id = $5";
    $resultado = pg_query_params(
      Connection::getInstance(),
      $sql,
      [$this->nome, $this->autor, $this->ano, $this->qtd, $this->id]
    );

    if ($resultado) {
      $_SESSION['erro'] = null;
      header("Location: paginadetrabalho.php");
    } else {
      $_SESSION['erro'] = "Erro ao atualizar o disco.";
      header("Location: editardisco.php?id=" . $this->id);
    }
  }
}
