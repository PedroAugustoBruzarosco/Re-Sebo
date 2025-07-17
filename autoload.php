<?php
spl_autoload_register(function ($classe) {
  require_once __DIR__ . "/classes/" . $classe . ".php";
});

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
