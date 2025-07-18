<?php
require_once 'autoload.php';
$tipo = $_GET['tipo'] ?? '';
$id = intval($_GET['id']);
if (!in_array($tipo, ['livro', 'disco'])) {
    $_SESSION['erro'] = "Tipo inválido.";
    header("Location: paginadetrabalho.php");
    exit;
}
$tabela = $tipo === 'livro' ? 'livros' : 'discos';
$sql = "DELETE FROM $tabela WHERE id = $1";
pg_query_params(Connection::getInstance(), $sql, array($id));
header("Location: paginadetrabalho.php");
exit;
