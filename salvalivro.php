<?php
require_once "autoload.php";
$livro = Livro::fromPost($_POST);
if ($livro) {
    $livro->salvar();
} else {
    header("Location: adicionarlivro.php");
}
