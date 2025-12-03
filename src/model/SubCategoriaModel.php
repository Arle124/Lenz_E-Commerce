<?php
require_once __DIR__ . "/../../config/conexion.php";

class SubCategoriaModel {

    private $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    // SP: obtener todas las subcategorías
    public function obtenerSubcategorias() {
        $sql = "CALL sp_obtener_subcategorias()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // SP: obtener subcategorías por categoría
    public function obtenerSubcategoriasPorCategoria($idCategoria) {
        $sql = "CALL sp_obtener_subcategorias_por_categoria(:id_categoria)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_categoria', $idCategoria);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // SP: obtener subcategoría por ID
    public function obtenerSubcategoriaPorId($id) {
        $sql = "CALL sp_obtener_subcategoria_por_id(:id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // SP: crear subcategoría
    public function crearSubcategoria($nombre, $idCategoria) {
        $sql = "CALL sp_crear_subcategoria(:nombre, :id_categoria)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_categoria', $idCategoria);
        return $stmt->execute();
    }

    // SP: actualizar subcategoría
    public function actualizarSubcategoria($id, $nombre, $idCategoria) {
        $sql = "CALL sp_actualizar_subcategoria(:id, :nombre, :id_categoria)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_categoria', $idCategoria);
        return $stmt->execute();
    }

    // SP: eliminar subcategoría
    public function eliminarSubcategoria($id) {
        $sql = "CALL sp_eliminar_subcategoria(:id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}