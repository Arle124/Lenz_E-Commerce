<?php
require_once __DIR__ . "/../model/ProductoModel.php";

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


}
