<?php
require_once __DIR__ . "/../../config/conexion.php";

class ProductoModel {

    private PDO $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    /**
     * Obtiene productos filtrados por categoría, subcategoría, precio y orden
     */
    public function filtrar($cat = null, $subcat = null, $order = null, $price = null) {
        $cat = $cat ?: null;
        $subcat = $subcat ?: null;
        $order = $order ?: null;
        $price = $price ?: null;

        $sql = "CALL sp_filtrar_productos(:cat, :subcat, :price, :orden)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':cat', $cat, is_null($cat) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':subcat', $subcat, is_null($subcat) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':price', $price, is_null($price) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':orden', $order, is_null($order) ? PDO::PARAM_NULL : PDO::PARAM_STR);

        $stmt->execute();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();

        return $productos;
    }

    // crear producto
    public function crearProducto(array $data): int {
        $this->conn->beginTransaction();

        try {
            // 1) Insert a productos (SIN stock)
            $sql = "INSERT INTO productos (nombre, descripcion, precio, id_subcategoria, creado_por)
                    VALUES (:nombre, :descripcion, :precio, :id_subcategoria, :creado_por)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':nombre' => $data['nombre'],
                ':descripcion' => $data['descripcion'] ?? null,
                ':precio' => $data['precio'],
                ':id_subcategoria' => $data['id_subcategoria'],
                ':creado_por' => $data['creado_por'] ?? null,
            ]);
            $stmt->closeCursor();

            $idProducto = (int)$this->conn->lastInsertId();

            // 2) Insert a inventarios con el stock
            $stock = isset($data['stock']) ? (int)$data['stock'] : 0;
            $sqlInv = "INSERT INTO inventarios (id_producto, stock) VALUES (:id_producto, :stock)";
            $stmtInv = $this->conn->prepare($sqlInv);
            $stmtInv->execute([
                ':id_producto' => $idProducto,
                ':stock' => $stock
            ]);
            $stmtInv->closeCursor();

            $this->conn->commit();
            return $idProducto;

        } catch (Throwable $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    // agregar imagen a producto
    public function agregarImagenProducto(int $idProducto, string $ruta): bool {
        $sql = "INSERT INTO imagenes_productos (id_producto, ruta) VALUES (:id, :ruta)";
        $stmt = $this->conn->prepare($sql);
        $ok = $stmt->execute([
            ':id' => $idProducto,
            ':ruta' => $ruta
        ]);
        $stmt->closeCursor();
        return $ok;
    }

    public function listarCategorias(): array {
        $stmt = $this->conn->prepare("SELECT id_categoria, nombre FROM categorias ORDER BY nombre ASC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }

    public function listarSubcategorias(?int $idCategoria = null): array {
        if ($idCategoria) {
            $sql = "SELECT id_subcategoria, nombre, id_categoria
                    FROM subcategorias
                    WHERE id_categoria = :id
                    ORDER BY nombre ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $idCategoria]);
        } else {
            $sql = "SELECT id_subcategoria, nombre, id_categoria
                    FROM subcategorias
                    ORDER BY nombre ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }

    public function agregarProducto($nombre, $descripcion, $precio, $id_subcategoria, $creado_por) {
        $sql = "CALL sp_agregar_producto(:nombre, :descripcion, :precio, :subcat, :creado_por)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':subcat', $id_subcategoria, PDO::PARAM_INT);
        $stmt->bindParam(':creado_por', $creado_por, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

        while ($stmt->nextRowset()) {}
        $stmt->closeCursor();

        return $result['id_producto'] ?? null;
    }

    public function getProductoPorId($idProducto) {
        $stmt = $this->conn->prepare("CALL sp_getProductoPorId(:id)");
        $stmt->execute([':id' => $idProducto]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        while ($stmt->nextRowset()) {}
        $stmt->closeCursor();

        if (!$producto) return null;

        $producto['imagenes'] = !empty($producto['imagenes'])
            ? explode(',', $producto['imagenes'])
            : [];

        return $producto;
    }
    // =======================
    // ADMIN: LISTAR / EDITAR / ELIMINAR
    // =======================

    public function listarProductosAdmin(): array {
        $sql = "SELECT 
                p.id_producto, p.nombre, p.codigo, p.descripcion, p.precio, p.id_subcategoria,
                s.nombre AS subcategoria_nombre,
                c.nombre AS categoria_nombre,
                COALESCE(i.stock, 0) AS stock,
                (SELECT ip.ruta
                FROM imagenes_productos ip
                WHERE ip.id_producto = p.id_producto
                ORDER BY ip.id_imagen ASC
                LIMIT 1) AS imagen
                FROM productos p
                JOIN subcategorias s ON s.id_subcategoria = p.id_subcategoria
                JOIN categorias c ON c.id_categoria = s.id_categoria
                LEFT JOIN inventarios i ON i.id_producto = p.id_producto
                ORDER BY p.id_producto DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }

    public function actualizarProducto(int $idProducto, array $data): bool {
        $this->conn->beginTransaction();
        try {
            // 1) Actualizar info base (nombre, descripción, subcategoría, etc.)
            $sql = "UPDATE productos
                    SET nombre = :nombre,
                        descripcion = :descripcion,
                        id_subcategoria = :id_subcategoria,
                        actualizado_en = NOW(),
                        actualizado_por = :usuario
                    WHERE id_producto = :id";
            $stmt = $this->conn->prepare($sql);
            $ok = $stmt->execute([
                ':nombre' => $data['nombre'],
                ':descripcion' => $data['descripcion'] ?? null,
                ':id_subcategoria' => (int)$data['id_subcategoria'],
                ':usuario' => $data['usuario'] ?? null,
                ':id' => $idProducto,
            ]);
            $stmt->closeCursor();

            // 2) Precio (para auditoría usa el SP existente)
            if (isset($data['precio'])) {
                $sqlPrecio = "CALL sp_cambiar_precio_producto(:id, :precio, :usuario)";
                $stp = $this->conn->prepare($sqlPrecio);
                $stp->execute([
                    ':id' => $idProducto,
                    ':precio' => $data['precio'],
                    ':usuario' => $data['usuario'] ?? null,
                ]);
                while ($stp->nextRowset()) {}
                $stp->closeCursor();
            }

            // 3) Stock (update simple; tus triggers guardan auditoría)
            if (isset($data['stock'])) {
                $sqlStock = "UPDATE inventarios SET stock = :stock WHERE id_producto = :id";
                $sts = $this->conn->prepare($sqlStock);
                $sts->execute([
                    ':stock' => (int)$data['stock'],
                    ':id' => $idProducto
                ]);
                $sts->closeCursor();
            }

            $this->conn->commit();
            return $ok;

        } catch (Throwable $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function eliminarProducto(int $idProducto, ?int $idUsuario): void {
        // Usar tu SP que registra auditoría
        $stmt = $this->conn->prepare("CALL sp_eliminar_producto(:id, :usuario)");
        $stmt->execute([
            ':id' => $idProducto,
            ':usuario' => $idUsuario
        ]);
        while ($stmt->nextRowset()) {}
        $stmt->closeCursor();
    }

}
