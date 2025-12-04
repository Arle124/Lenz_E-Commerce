<?php
    class Database {
         // private $host = "drapps.co";
        // private $dbname = "drappsco_db_lenz";
        // private $usuario = "drappsco_lenz";
        // private $password = "DBLenz2025";
        // private static $conexion = null;
        private $host = "localhost";
        private $dbname = "bdlenz";
        private $usuario = "root";
        private $password = "";
        private static $conexion = null;

        public static function conectar() {
            if (self::$conexion == null) {
                $db = new self(); // crear instancia para acceder a variables no estáticas
                $dsn = "mysql:host={$db->host};dbname={$db->dbname};charset=utf8mb4";

                try {
                    self::$conexion = new PDO($dsn, $db->usuario, $db->password);
                    self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                } catch (PDOException $e) {
                    die("Error de conexión: " . $e->getMessage());
                }
            }

            return self::$conexion;
        }
    }

