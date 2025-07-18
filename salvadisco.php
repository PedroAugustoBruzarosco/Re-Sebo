<?php
require_once "autoload.php";
$disco = Disco::fromPost($_POST);
if ($disco) {
    $disco->salvar();
} else {
    header("Location: adicionardisco.php");
}
