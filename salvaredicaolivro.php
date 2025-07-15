<?php
session_start();
include 'conexao.php';
$id = intval($_POST['id']);
$nome = trim($_POST['nome']);
$autor = trim($_POST['autor']);
$ano = intval($_POST['ano']);
$qtd = intval($_POST['qtd']);
if (empty($nome) || empty($autor) || $ano <= 0 || $qtd < 0) {
    $_SESSION['erro'] = "Preencha todos os campos corretamente.";
    header("Location: editarlivro.php?id=" . $id);
    exit;
}
$sql = "UPDATE livros SET nome = $1, autor = $2, ano = $3, qtd = $4 WHERE id = $5";
$resultado = pg_query_params($conn, $sql, array($nome, $autor, $ano, $qtd, $id));
if ($resultado) {
    $_SESSION['sucesso'] = "Livro atualizado com sucesso.";
} else {
    $_SESSION['erro'] = "Erro ao atualizar o livro.";
}
header("Location: paginadetrabalho.php");
exit;
?>
