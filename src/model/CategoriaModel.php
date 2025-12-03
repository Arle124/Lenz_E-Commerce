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

    // dentro de CategoriaModel class

    /**
     * Devuelve un array de categorías con sus subcategorías:
     * [
     *   ['id'=>1, 'nombre'=>'Clothing', 'subcategorias'=> [ ['id'=>10,'nombre'=>'Men'], ... ] ],
     *   ...
     * ]
     */
    public function obtenerCategoriasConSubcategorias() {
        $sql = "
            SELECT 
                c.id_categoria AS categoria_id,
                c.nombre AS categoria,
                s.id_subcategoria AS sub_id,
                s.nombre AS sub_nombre
            FROM categorias c
            LEFT JOIN subcategorias s ON s.id_categoria = c.id_categoria
            ORDER BY c.nombre, s.nombre
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        // devolver como array indexado, no como mapa por id
        return array_values($categorias);
    }


}