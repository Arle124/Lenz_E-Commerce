<?php
class Database {

    private $host = "localhost";
    private $dbname = "lenz_db";
    private $usuario = "root";
    private $password = "";
    private static $conexion = null;

    public static function conectar() {
        if (self::$conexion == null) {

            $dsn = "mysql:host=localhost;dbname=lenz_db;charset=utf8mb4";

            try {
                self::$conexion = new PDO($dsn, "root", "");
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        return self::$conexion;
    }
}
?>