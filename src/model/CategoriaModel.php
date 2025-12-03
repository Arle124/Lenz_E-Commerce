<?php
require_once __DIR__ . "/../../config/conexion.php";

class CategoriaModel {

    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    // SP: obtener todas las categorías
    public function obtenerCategorias() {
        $sql = "CALL sp_obtener_categorias()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // SP: obtener categoría por ID
    public function obtenerCategoriaPorId($id) {
        $sql = "CALL sp_obtener_categoria_por_id(:id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // SP: crear categoría
    public function crearCategoria($nombre) {
        $sql = "CALL sp_crear_categoria(:nombre)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    }

    // SP: actualizar categoría
    public function actualizarCategoria($id, $nombre) {
        $sql = "CALL sp_actualizar_categoria(:id, :nombre)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        return $stmt->execute();
    }

    // SP: eliminar categoría
    public function eliminarCategoria($id) {
        $sql = "CALL sp_eliminar_categoria(:id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}