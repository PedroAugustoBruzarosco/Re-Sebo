<?php
require_once "autoload.php";
$livro = Livro::fromPost($_POST);
if ($livro) {
    $livro->atualizar();
} else {
    header("Location: editarlivro.php?id=" . $_POST['id']);
}
