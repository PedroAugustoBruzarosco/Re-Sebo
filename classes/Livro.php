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
      $livro->id = intval($post['id']);
    }
    $livro->nome = trim($post['nome']);
    $livro->autor = trim($post['autor']);
    $livro->ano = intval($post['ano']);
    $livro->qtd = intval($post['qtd']);
    $livro->numeropaginas = intval($post['numeropaginas']);
    $livro->editora = trim($post['editora']);

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

    $livro->id = $dados['id'];
    $livro->nome = $dados['nome'];
    $livro->autor = $dados['autor'];
    $livro->ano = $dados['ano'];
    $livro->qtd = $dados['qtd'];
    $livro->numeropaginas = $dados['numeropaginas'];
    $livro->editora = $dados['editora'];
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

    return pg_fetch_all($resultado) ?: [];
  }

  public function salvar()
  {
    $imagemEscapada = $this->imagem !== null ? pg_escape_bytea(Connection::getInstance(), $this->imagem) : null;

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
        $imagemEscapada
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
    $imagemEscapada = $this->imagem !== null ? pg_escape_bytea(Connection::getInstance(), $this->imagem) : null;

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
        $imagemEscapada,
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
