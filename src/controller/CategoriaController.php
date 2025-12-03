<?php
require_once __DIR__ . "/../model/CategoriaModel.php";

class CategoriaController {

    private $model;

    public function __construct() {
        $this->model = new CategoriaModel();
    }

    public function index() {
        $categorias = $this->model->obtenerCategorias();
        return $categorias;
        // require_once __DIR__ . "/../views/categorias/index.php";
    }

    public function crear() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->model->crearCategoria($_POST["nombre"]);
            header("Location: index.php?c=categoria&a=index"); // Esto queda pendiente para editar la vista
            exit;
        }

        // require_once __DIR__ . "/../views/categorias/crear.php";
    }

    public function editar() {
        $id = $_GET["id"];
        $categoria = $this->model->obtenerCategoriaPorId($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->model->actualizarCategoria($id, $_POST["nombre"]);
            header("Location: index.php?c=categoria&a=index"); // Esto queda pendiente para editar la vista
            exit;
        }

        // require_once __DIR__ . "/../views/categorias/editar.php";
    }

    public function eliminar() {
        $id = $_GET["id"];
        $this->model->eliminarCategoria($id);
        header("Location: index.php?c=categoria&a=index"); // Esto queda pendiente para editar la vista
        exit;
    }

    public function listarConSubcategorias() {
        $model = new CategoriaModel();
        return $model->obtenerCategoriasConSubcategorias();
    }

}
