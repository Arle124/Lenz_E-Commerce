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

    public function obtenerCategoriasConSubcategorias() {
        $sql = "CALL sp_listar_categorias_subcategorias()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // Primer result set (el importante)
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 👇 IMPORTANTE: limpiar buffers si el SP devuelve más result sets
        while ($stmt->nextRowset()) {;}

        // Procesar categorías y subcategorías
        $categorias = [];

        foreach ($rows as $row) {
            $cid = (int)$row['categoria_id'];

            if (!isset($categorias[$cid])) {
                $categorias[$cid] = [
                    'id' => $cid,
                    'nombre' => $row['categoria'],
                    'subcategorias' => []
                ];
            }

            if (!empty($row['sub_id'])) {
                $categorias[$cid]['subcategorias'][] = [
                    'id' => (int)$row['sub_id'],
                    'nombre' => $row['sub_nombre']
                ];
            }
        }

        return array_values($categorias);
    }



}