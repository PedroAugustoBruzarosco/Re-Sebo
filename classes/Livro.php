<?php
class Livro
{
  public string $id;
  public string $nome;
  public string $autor;
  public string $editora;
  public ?string $imagem;
  public int $ano;
  public int $qtd;
  public int $numeropaginas;

  public function __construct() {}

  public static function fromPost($post)
  {
    $livro = new Livro();

    if (!empty($post['id'])) {
      $livro->id = (string)$post['id'];
    }
    $livro->nome = $post['nome'];
    $livro->autor = $post['autor'];
    $livro->editora = $post['editora'];
    $livro->ano = (int)$post['ano'];
    $livro->qtd = (int)$post['qtd'];
    $livro->numeropaginas = (int)$post['numeropaginas'];

    if ($post['imagem']) {
      $livro->imagem = pg_unescape_bytea($post['imagem']);
    } else {
      $livro->imagem = null;
    }

    if (!empty($_FILES['imagem']['tmp_name'])) {
      $livro->imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    }

    return $livro;
  }

  public static function getById(string $id)
  {
    $livro = new Livro();

    $dados = pg_fetch_assoc(pg_query_params(Connection::getInstance(), "SELECT * FROM livros WHERE id = $1", array($id)));

    if (!$dados) return null;

    $livro->id = (string)$dados['id'];
    $livro->nome = $dados['nome'];
    $livro->autor = $dados['autor'];
    $livro->editora = $dados['editora'];
    $livro->ano = (int)$dados['ano'];
    $livro->qtd = (int)$dados['qtd'];
    $livro->numeropaginas = (int)$dados['numeropaginas'];
    $livro->imagem = $dados['imagem'];

    return $livro;
  }

  public static function listar()
  {
    $resultado = pg_query(
      Connection::getInstance(),
      "SELECT id, nome, autor, editora, ano, qtd, numeropaginas, imagem
       FROM livros
       ORDER BY nome"
    );

    $livros = pg_fetch_all($resultado) ?: [];

    foreach ($livros as &$livro) {
      if ($livro['imagem']) {
        $livro['imagem'] = pg_unescape_bytea($livro['imagem']);
      }
    }

    return $livros;
  }

  public function salvar()
  {

    $sql = "INSERT INTO livros (nome, autor, editora, ano, qtd, numeropaginas, imagem)
        VALUES ($1, $2, $3, $4, $5, $6, $7)";

    $resultado = pg_query_params(
      Connection::getInstance(),
      $sql,
      [
        $this->nome,
        $this->autor,
        $this->editora,
        $this->ano,
        $this->qtd,
        $this->numeropaginas,
        $this->imagem ? pg_escape_bytea(Connection::getInstance(), $this->imagem) : null
      ]
    );

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
    $sql = "UPDATE livros
            SET nome = $1,
                autor = $2,
                editora = $3,
                ano = $4,
                qtd = $5,
                numeropaginas = $6,
                imagem = $7
            WHERE id = $8";

    $resultado = pg_query_params(
      Connection::getInstance(),
      $sql,
      [
        $this->nome,
        $this->autor,
        $this->editora,
        $this->ano,
        $this->qtd,
        $this->numeropaginas,
        $this->imagem ? pg_escape_bytea(Connection::getInstance(), $this->imagem) : null,
        $this->id
      ]
    );

    if ($resultado) {
      $_SESSION['erro'] = null;
      header("Location: paginadetrabalho.php");
    } else {
      $_SESSION['erro'] = "Erro ao atualizar o livro.";
      header("Location: editarlivro.php?id=" . $this->id);
    }
  }
}
