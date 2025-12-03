<?php
require_once __DIR__ . "/../model/ProductoModel.php";
require_once __DIR__ . '/InventarioController.php';
class ProductoController {

    private $model;

    public function __construct() {
        $this->model = new ProductoModel();
    }

    // Filtrar productos según filtros del frontend
    public function filtrar($idCategoria = null, $idSubcategoria = null, $orden = null, $rangoPrecio = null) {
        return $this->model->filtrar($idCategoria, $idSubcategoria, $orden, $rangoPrecio);
    }

    public function agregar($nombre, $descripcion, $precio, $id_subcategoria, $creado_por) {
        return $this->model->agregarProducto($nombre, $descripcion, $precio, $id_subcategoria, $creado_por);
    }

    public function verProducto($idProducto) {
        return $this->model->getProductoPorId($idProducto);
    }

    public function verProductoStock($idProducto) {
        $producto = $this->model->getProductoPorId($idProducto);
        if (!$producto) return null;

        $inventarioCtrl = new InventarioController();
        $producto['stock'] = $inventarioCtrl->getStock($idProducto);
        $producto['cantidad_max'] = $producto['stock'];

        return $producto;
    }


}
