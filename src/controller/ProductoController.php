<?php
require_once __DIR__ . '/../model/ProductoModel.php';

require_once __DIR__ . '/InventarioController.php';
require_once __DIR__ . '/../../config/sesion.php';
require_once __DIR__ . '/../../config/config.php';

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

    public function verProducto($idProducto) {
        return $this->model->getProductoPorId($idProducto);
    }

    public function verProductoStock($idProducto) {
        $producto = $this->model->getProductoPorId($idProducto);
        if (!$producto) return null;

        $inventarioCtrl = new InventarioController();
        $producto['stock'] = $inventarioCtrl->getStock($idProducto);
        $producto['cantidad_max'] = $producto['stock'];

        return $producto;
    }

    private function esStaff(): bool {
        $rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
        return in_array($rolId, [2,3], true);
    }

    public function listarCategorias(): array {
        return $this->model->listarCategorias();
    }

    public function listarSubcategorias(?int $idCategoria = null): array {
        return $this->model->listarSubcategorias($idCategoria);
    }

    /**
     * ✅ CREA producto + SUBE 0..N imágenes
     * - Guarda archivo en /fotos_productos (nivel root, al lado de /src)
     * - Guarda ruta en DB como: fotos_productos/NOMBRE.jpg (SIN BASE_URL)
     */
    public function crearProductoConImagen(array $post, array $files): void {
        if (!$this->esStaff()) {
            $_SESSION['error'] = "No tienes permiso para agregar productos.";
            header("Location: " . BASE_URL . "index.php");
            exit;
        }

        $nombre = trim($post['nombre'] ?? '');
        $descripcion = trim($post['descripcion'] ?? '');
        $precio = (float)($post['precio'] ?? 0);
        $stock = (int)($post['stock'] ?? 0);
        $idSub = (int)($post['id_subcategoria'] ?? 0);

        if ($nombre === '' || $precio <= 0 || $stock < 0 || $idSub <= 0) {
            $_SESSION['error'] = "Datos inválidos (nombre, precio, stock, subcategoría).";
            header("Location: " . BASE_URL . "src/view/admin/productos.php");
            exit;
        }

        // 1) crear producto
        $idProducto = $this->model->crearProducto([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'id_subcategoria' => $idSub,
            'creado_por' => (int)($_SESSION['usuario']['id'] ?? 0),
        ]);

        // 2) imágenes (multiple: imagenes[])
        if (!empty($files['imagenes']) && !empty($files['imagenes']['name'][0])) {

            // Carpeta física: al mismo nivel que /src
            // Cambia "fotos_productos" por "fotos_producto" si tu carpeta es singular
            $carpetaRel = "fotos_productos";
            $dirFisico  = __DIR__ . "/../../" . $carpetaRel;

            if (!is_dir($dirFisico)) {
                mkdir($dirFisico, 0775, true);
            }

            $permitidas = ['jpg','jpeg','png','webp'];

            $names = $files['imagenes']['name'];
            $tmps  = $files['imagenes']['tmp_name'];
            $errs  = $files['imagenes']['error'];
            $sizes = $files['imagenes']['size'];

            for ($i = 0; $i < count($names); $i++) {

                if ($errs[$i] === UPLOAD_ERR_NO_FILE) continue;
                if ($errs[$i] !== UPLOAD_ERR_OK) continue;

                // (opcional) límite 2MB
                if (($sizes[$i] ?? 0) > 2 * 1024 * 1024) continue;

                $ext = strtolower(pathinfo($names[$i], PATHINFO_EXTENSION));
                if (!in_array($ext, $permitidas, true)) continue;

                // Nombre original “limpio”
                $base = pathinfo($names[$i], PATHINFO_FILENAME);
                $base = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $base);
                if ($base === '') $base = "p{$idProducto}";

                $filename = $base . "." . $ext;
                $dest = $dirFisico . $filename;

                // Si ya existe, agregar sufijo para no pisar
                if (file_exists($dest)) {
                    $filename = $base . "_" . time() . "_" . $i . "." . $ext;
                    $dest = $dirFisico . $filename;
                }

                if (!move_uploaded_file($tmps[$i], $dest)) {
                    continue; // no matamos todo el proceso por una imagen fallida
                }

                // Ruta en BD (relativa, para luego hacer BASE_URL . ruta)
                $rutaBD = $carpetaRel . $filename; // ej: fotos_productos/CO4745.jpg
                $this->model->agregarImagenProducto($idProducto, $rutaBD);
            }
        }

        $_SESSION['success'] = "Producto creado correctamente.";
        header("Location: " . BASE_URL . "src/view/admin/productos.php");
        exit;
    }

    public function listarProductosAdmin(): array {
        return $this->model->listarProductosAdmin();
    }

    public function actualizarProductoDesdePost(array $post): void {
        if (!$this->esStaff()) {
            $_SESSION['error'] = "No tienes permiso para editar productos.";
            header("Location: " . BASE_URL . "index.php");
            exit;
        }

        $id = (int)($post['id_producto'] ?? 0);
        $nombre = trim($post['nombre'] ?? '');
        $descripcion = trim($post['descripcion'] ?? '');
        $precio = (float)($post['precio'] ?? 0);
        $stock = (int)($post['stock'] ?? 0);
        $idSub = (int)($post['id_subcategoria'] ?? 0);

        if ($id <= 0 || $nombre === '' || $precio <= 0 || $stock < 0 || $idSub <= 0) {
            $_SESSION['error'] = "Datos inválidos para actualizar producto.";
            header("Location: " . BASE_URL . "src/view/admin/productos.php");
            exit;
        }

        $usuario = (int)($_SESSION['usuario']['id'] ?? 0);

        $this->model->actualizarProducto($id, [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'id_subcategoria' => $idSub,
            'usuario' => $usuario,
        ]);

        $_SESSION['success'] = "Producto actualizado correctamente.";
        header("Location: " . BASE_URL . "src/view/admin/productos.php");
        exit;
    }

    public function eliminarProductoDesdePost(array $post): void {
        if (!$this->esStaff()) {
            $_SESSION['error'] = "No tienes permiso para eliminar productos.";
            header("Location: " . BASE_URL . "index.php");
            exit;
        }

        $id = (int)($post['id_producto'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = "ID inválido para eliminar producto.";
            header("Location: " . BASE_URL . "src/view/admin/productos.php");
            exit;
        }

        $usuario = (int)($_SESSION['usuario']['id'] ?? 0);
        $this->model->eliminarProducto($id, $usuario);

        $_SESSION['success'] = "Producto eliminado correctamente.";
        header("Location: " . BASE_URL . "src/view/admin/productos.php");
        exit;
    }

}

// =============================
// ROUTER / ENDPOINT (POST)
// =============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $controller = new ProductoController();

    if ($action === 'crear_producto') {
        $controller->crearProductoConImagen($_POST, $_FILES);
    }
    if ($action === 'actualizar_producto') {
        $controller->actualizarProductoDesdePost($_POST);
    }

    if ($action === 'eliminar_producto') {
        $controller->eliminarProductoDesdePost($_POST);
    }

    $_SESSION['error'] = "Acción no válida.";
    header("Location: " . BASE_URL . "src/view/admin/productos.php");
    exit;
}
