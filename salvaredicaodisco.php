<?php
require_once "autoload.php";

$disco = Disco::fromPost($_POST);
if ($disco) {
    $disco->atualizar();
} else {
    header("Location: editardisco.php?id=" . $_POST['id']);
}
