<?php
require_once __DIR__ . '/../../config/autoload.php';
require_once PATH_CONFIG . "config.php";

class InventarioModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::conectar();
    }

    // Obtener stock por producto
    public function getStockByProducto($idProducto) {
        $sql = "CALL sp_get_stock_por_producto(:id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idProducto, PDO::PARAM_INT);
        $stmt->execute();

        // fetchColumn es ideal porque solo vuelve una columna
        $stock = $stmt->fetchColumn();

        // IMPORTANTE: limpiar el buffer si se van a ejecutar más SP en la misma conexión
        while ($stmt->nextRowset()) {;}

        return $stock !== false ? (int)$stock : 0;
    }

}
