<?php
require_once "autoload.php";

$usuario = trim($_POST['usuario']);
$senha = trim($_POST['senha']);

$sql = "SELECT id, nome, senha FROM usuarios WHERE nome = $1";
$resultado = pg_query_params(Connection::getInstance(), $sql, array($usuario));
if (pg_num_rows($resultado) === 1) {
    $usuarioBanco = pg_fetch_assoc($resultado);
    if (password_verify($senha, $usuarioBanco['senha'])) {
        $_SESSION['usuario_id'] = $usuarioBanco['id'];
        $_SESSION['usuario'] = $usuarioBanco['nome'];
        header("location: paginadetrabalho.php");
        exit;
    } else {
        $_SESSION['erro'] = "Senha incorreta.";
        header("location: login.php");
        exit;
    }
} else {
    $_SESSION['erro'] = "Usuário não encontrado.";
    header("location: login.php");
    exit;
}
