<?php
class Connection
{
    private static $conn = null;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance()
    {
        if (self::$conn === null) {

            self::$conn = pg_connect("host=localhost dbname=ReSebo user=postgres password=12345678");

            if (!self::$conn) {
                die("Erro ao conectar ao banco de dados PostgreSQL.");
            }
        }
        return self::$conn;
    }
}
