<?php
$host = "localhost";
$dbname = "Re-Sebo";
$user = "postgres";
$password = "123456";
$conn = pg_connect("host=localhost dbname=Re-Sebo user=postgres password=123456");

if (!$conn) {
    die("Erro na conexão com o banco de dados.");
} else {
    echo "Conexão bem sucedida!";
}
?>