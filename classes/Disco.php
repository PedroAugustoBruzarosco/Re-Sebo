<?php
class Disco
{
  public string $id;
  public string $nome;
  public string $autor;
  public string $gravadora;
  public ?string $audio;
  public int $ano;
  public int $qtd;
  public int $numerofaixas;

  public function __construct() {}

  public static function fromPost($post): Disco
  {
    $disco = new Disco();

    if (!empty($post['id'])) {
      $disco->id = (string)$post['id'];
    }
    $disco->nome = $post['nome'];
    $disco->autor = $post['autor'];
    $disco->gravadora = $post['gravadora'];
    $disco->ano = (int)$post['ano'];
    $disco->qtd = (int)$post['qtd'];
    $disco->numerofaixas = (int)$post['numerofaixas'];

    if ($post['audio']) {
      $disco->audio = pg_unescape_bytea($post['audio']);
    } else {
      $disco->audio = null;
    }

    if (!empty($_FILES['audio']['tmp_name'])) {
      $disco->audio = file_get_contents($_FILES['audio']['tmp_name']);
    }

    return $disco;
  }

  public static function getById(string $id)
  {
    $disco = new Disco();

    $dados = pg_fetch_assoc(
      pg_query_params(
        Connection::getInstance(),
        "SELECT * FROM discos WHERE id = $1",
        array($id)
      )
    );

    if (!$dados) return null;

    $disco->id = $dados['id'];
    $disco->nome = $dados['nome'];
    $disco->autor = $dados['autor'];
    $disco->gravadora = $dados['gravadora'];
    $disco->ano = (int)$dados['ano'];
    $disco->qtd = (int)$dados['qtd'];
    $disco->numerofaixas = (int)$dados['numerofaixas'];
    $disco->audio = $dados['audio'];

    return $disco;
  }

  public function salvar()
  {
    $sql = "INSERT INTO discos (nome, autor, ano, qtd, gravadora, numerofaixas, audio) 
      VALUES ($1, $2, $3, $4, $5, $6, $7)";
    $resultado = pg_query_params(
      Connection::getInstance(),
      $sql,
      array(
        $this->nome,
        $this->autor,
        $this->ano,
        $this->qtd,
        $this->gravadora,
        $this->numerofaixas,
        $this->audio ? pg_escape_bytea(Connection::getInstance(), $this->audio) : null
      )
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
      "SELECT id, nome, autor, gravadora, ano, qtd, numerofaixas, audio FROM discos ORDER BY nome"
    );

    $discos = pg_fetch_all($resultado) ?: [];

    foreach ($discos as &$disco) {
      if (!empty($disco['audio'])) {
        $disco['audio'] = pg_unescape_bytea($disco['audio']);
      }
    }

    return $discos;
  }

  public function atualizar()
  {
    $sql = "UPDATE discos
            SET nome = $1,
                autor = $2,
                gravadora = $3,
                ano = $4,
                qtd = $5,
                numerofaixas = $6,
                audio = $7
            WHERE id = $8";

    $resultado = pg_query_params(
      Connection::getInstance(),
      $sql,
      [
        $this->nome,
        $this->autor,
        $this->gravadora,
        $this->ano,
        $this->qtd,
        $this->numerofaixas,
        $this->audio ? pg_escape_bytea(Connection::getInstance(), $this->audio) : null,
        $this->id
      ]
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
