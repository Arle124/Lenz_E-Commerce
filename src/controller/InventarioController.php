<?php
require_once __DIR__ . '/../model/InventarioModel.php';

class InventarioController {
    private $model;

    public function __construct() {
        $this->model = new InventarioModel();
    }

    // Obtener stock y posibles reglas de negocio
    public function getStock($idProducto) {
        $stock = $this->model->getStockByProducto($idProducto);
        // Aquí podrías agregar lógica extra: por ejemplo, mínimo permitido
        return max(0, $stock);
    }
}
