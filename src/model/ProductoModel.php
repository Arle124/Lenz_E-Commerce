<?php
require_once __DIR__ . "/../../config/conexion.php";

class ProductoModel {

    private $pdo;

    public function __construct() {
        $this->pdo = Database::conectar();
    }

    /**
     * Obtiene productos filtrados por categoría, subcategoría, precio y orden
     */
    public function filtrar($cat = null, $subcat = null, $order = null, $price = null) {
        // Base SQL
        $sql = "SELECT p.*, 
                    c.id_categoria AS categoria_id, 
                    s.id_subcategoria AS subcategoria_id
                FROM productos p
                JOIN subcategorias s ON p.id_subcategoria = s.id_subcategoria
                JOIN categorias c ON s.id_categoria = c.id_categoria
                WHERE 1=1";

        $params = [];

        // Filtros
        if ($cat) {
            $sql .= " AND c.id_categoria = :cat";
            $params[':cat'] = $cat;
        }
        if ($subcat) {
            $sql .= " AND s.id_subcategoria = :subcat";
            $params[':subcat'] = $subcat;
        }
        if ($price) {
            list($min, $max) = explode('-', $price);
            $sql .= " AND p.precio BETWEEN :min AND :max";
            $params[':min'] = $min;
            $params[':max'] = $max;
        }

        // Orden
        switch ($order) {
            case 'price_asc':
                $sql .= " ORDER BY p.precio ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY p.precio DESC";
                break;
            case 'newest':
                $sql .= " ORDER BY p.id_producto DESC";
                break;
            default:
                $sql .= " ORDER BY p.id_producto ASC"; // o cualquier orden por defecto
                break;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $productos;
    }

    public function agregarProducto($nombre, $descripcion, $precio, $id_subcategoria, $creado_por) {
        $sql = "INSERT INTO producto (nombre, descripcion, precio, id_subcategoria, creado_por, creado_en, actualizado_en)
                VALUES (:nombre, :descripcion, :precio, :id_subcategoria, :creado_por, NOW(), NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_subcategoria', $id_subcategoria);
        $stmt->bindParam(':creado_por', $creado_por);
        $stmt->execute();

        return $this->pdo->lastInsertId(); // devuelve el id del producto insertado
    }


}