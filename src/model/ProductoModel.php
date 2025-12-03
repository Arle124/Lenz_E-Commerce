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
        // Convertir NULLs correctamente (PDO necesita pasar NULL explícito)
        $cat = $cat ?: null;
        $subcat = $subcat ?: null;
        $order = $order ?: null;
        $price = $price ?: null;

        $sql = "CALL sp_filtrar_productos(:cat, :subcat, :price, :orden)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindValue(':cat', $cat, is_null($cat) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':subcat', $subcat, is_null($subcat) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':price', $price, is_null($price) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':orden', $order, is_null($order) ? PDO::PARAM_NULL : PDO::PARAM_STR);

        $stmt->execute();

        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Limpiar más result-sets (muy importante)
        while ($stmt->nextRowset()) {;}

        return $productos;
    }



    public function agregarProducto($nombre, $descripcion, $precio, $id_subcategoria, $creado_por) 
    {
        $sql = "CALL sp_agregar_producto(:nombre, :descripcion, :precio, :subcat, :creado_por)";
        
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':subcat', $id_subcategoria, PDO::PARAM_INT);
        $stmt->bindParam(':creado_por', $creado_por, PDO::PARAM_INT);

        $stmt->execute();

        // Obtener el ID retornado por el SP
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Limpiar múltiples result sets (MUY IMPORTANTE con CALL)
        while ($stmt->nextRowset()) {}

        return $result['id_producto'] ?? null;
    }


    public function getProductoPorId($idProducto) {

        $stmt = $this->pdo->prepare("CALL sp_getProductoPorId(:id)");
        $stmt->execute([':id' => $idProducto]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        // IMPORTANTE: limpiar el buffer de resultados adicionales de los SP
        $stmt->closeCursor();  

        if (!$producto) return null;

        // Convertir imágenes a un array
        $producto['imagenes'] = $producto['imagenes']
            ? explode(',', $producto['imagenes'])
            : [];

        return $producto;
    }



}