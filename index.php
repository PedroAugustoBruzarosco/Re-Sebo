<?php
spl_autoload_register(function ($classe) {
  require_once $classe . ".php";
});

session_start();
header("Location: paginadetrabalho.php");
