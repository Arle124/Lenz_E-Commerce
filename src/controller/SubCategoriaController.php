<?php
require_once __DIR__ . "/../model/SubCategoriaModel.php";
require_once __DIR__ . "/../model/CategoriaModel.php";

class SubCategoriaController {

    private $model;
    private $categoriaModel;

    public function __construct() {
        $this->model = new SubCategoriaModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function index() {
        $subcategorias = $this->model->obtenerSubcategorias();
        // require_once __DIR__ . "/../views/subcategorias/index.php";
    }

    public function crear() {
        // para mostrar el select
        $categorias = $this->categoriaModel->obtenerCategorias();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombre"];
            $idCategoria = $_POST["id_categoria"];

            $this->model->crearSubcategoria($nombre, $idCategoria);
            header("Location: index.php?c=subcategoria&a=index"); // Esto queda pendiente para editar la vista
            exit;
        }

        // require_once __DIR__ . "/../views/subcategorias/crear.php";
    }

    public function editar() {
        $id = $_GET["id"];

        $subcategoria = $this->model->obtenerSubcategoriaPorId($id);
        $categorias = $this->categoriaModel->obtenerCategorias();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST["nombre"];
            $idCategoria = $_POST["id_categoria"];

            $this->model->actualizarSubcategoria($id, $nombre, $idCategoria);
            header("Location: index.php?c=subcategoria&a=index"); // Esto queda pendiente para editar la vista
            exit;
        }

        // require_once __DIR__ . "/../views/subcategorias/editar.php";
    }

    public function eliminar() {
        $id = $_GET["id"];
        $this->model->eliminarSubcategoria($id);
        header("Location: index.php?c=subcategoria&a=index"); // Esto queda pendiente para editar la vista
        exit;
    }
}
