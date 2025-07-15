<?php
session_start();
include 'conexao.php';
$nome = trim($_POST['nome']);
$autor = trim($_POST['autor']);
$ano = intval($_POST['ano']);
$qtd = intval($_POST['qtd']);
$sql = "INSERT INTO livros (nome, autor, ano, qtd) VALUES ($1, $2, $3, $4)";
$resultado = pg_query_params($conn, $sql, array($nome, $autor, $ano, $qtd));

if ($resultado) {
    header("Location: paginadetrabalho.php");
    exit;
} else {
    $_SESSION['erro'] = "Erro ao salvar livro.";
    header("Location: adicionarlivro.php");
    exit;
}
?>
