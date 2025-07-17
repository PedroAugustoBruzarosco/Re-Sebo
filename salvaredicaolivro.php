<?php
include_once 'livro.php';

$livro = Livro::fromPost($_POST);
if ($livro) {
    $livro->atualizar();
}

exit;
