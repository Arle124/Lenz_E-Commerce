<?php
require_once __DIR__ . '/../model/PedidoModel.php';
require_once __DIR__ . '/../../config/sesion.php';
require_once __DIR__ . '/../../config/config.php'; // ✅ para BASE_URL

class PedidoController {

    private PedidoModel $model;

    public function __construct() {
        $this->model = new PedidoModel();
    }

    private function getIdUsuarioSesion(): int {
        return isset($_SESSION['usuario']['id']) ? (int)$_SESSION['usuario']['id'] : 0;
    }

    // ======================
    // CLIENTE
    // ======================
    public function misPedidos(): array {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) return [];
        return $this->model->obtenerPedidosUsuario($idUsuario);
    }

    public function misPedidosConDetalleSesion(): array {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) return [];
        return $this->model->obtenerPedidosConDetalle($idUsuario);
    }

    // ======================
    // TRACKING / ADMIN
    // ======================
    public function registrarTracking(int $idPedido, int $estado, string $descripcion): void {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) return;
        $this->model->registrarTracking($idPedido, $estado, $descripcion, $idUsuario);
    }

    public function pedidosAdmin(): array {
        return $this->model->listarPedidosAdmin();
    }

    public function pedidoAdminPorId(int $idPedido): ?array {
        return $this->model->obtenerPedidoAdminPorId($idPedido);
    }

    public function itemsPedido(int $idPedido): array {
        return $this->model->obtenerItemsPedido($idPedido);
    }

    // public function actualizarEstadoPedido(int $idPedido, int $idEstado): void {
    //     $idUsuario = $this->getIdUsuarioSesion();
    //     if ($idUsuario <= 0) return;
    //     $this->model->cambiarEstadoPedido($idPedido, $idEstado, $idUsuario); // ✅ SP + tracking interno si lo tienes
    // }
    public function actualizarEstadoPedido(int $idPedido, int $idEstado): array {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) return ['ok' => false, 'msg' => 'No hay sesión.'];

        $pedido = $this->model->obtenerPedidoAdminPorId($idPedido);
        if (!$pedido) return ['ok' => false, 'msg' => 'Pedido no encontrado.'];

        $actual = (int)($pedido['id_estado'] ?? 0);

        // estados finales
        if (in_array($actual, [5, 6], true)) {
            return ['ok' => false, 'msg' => 'El pedido ya está finalizado. No se puede cambiar.'];
        }

        if ($idEstado === $actual) {
            return ['ok' => false, 'msg' => 'El pedido ya está en ese estado.'];
        }

        // regla extra: impedir retroceder (ej: confirmada->pendiente)
        if ($idEstado < $actual) {
            return ['ok' => false, 'msg' => 'No puedes retroceder el estado del pedido.'];
        }

        $ok = $this->model->cambiarEstadoPedido($idPedido, $idEstado, $idUsuario);
        return $ok ? ['ok' => true, 'msg' => 'Estado actualizado.'] : ['ok' => false, 'msg' => 'No se pudo actualizar el estado.'];
    }

    // ===== VALIDACIONES =====
    private function estadoActualPedido(int $idPedido): int {
        $p = $this->model->obtenerPedidoAdminPorId($idPedido);
        return (int)($p['id_estado'] ?? 0);
    }

    private function validarTransicion(int $actual, int $nuevo): ?string {
        if (in_array($actual, [5,6], true)) {
            return "El pedido ya está finalizado (terminado/cancelado).";
        }
        if ($nuevo <= $actual) {
            return "No puedes retroceder ni repetir estados.";
        }
        return null;
    }

    private function redirect(string $path): void {
        header("Location: " . BASE_URL . ltrim($path, '/'));
        exit;
    }

    // Pedidos agrupados por estado
    public function pedidosPorEstado(): array {
        $sql = "SELECT 
                    e.id_estado,
                    e.nombre AS estado_nombre,
                    COUNT(*) AS total
                FROM pedidos p
                JOIN estados_pedido e ON e.id_estado = p.id_estado
                GROUP BY e.id_estado, e.nombre
                ORDER BY e.id_estado ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }

    // Últimos movimientos de tracking (auditoría)
    public function ultimosTrackings(int $limit = 10): array {
        $sql = "SELECT 
                    t.id,
                    t.id_pedido,
                    t.id_estado,
                    t.descripcion,
                    t.fecha,
                    e.nombre AS estado_nombre,
                    CONCAT(u.nombres,' ',u.apellidos) AS usuario
                FROM ad_trk_pedidos t
                JOIN estados_pedido e ON e.id_estado = t.id_estado
                JOIN usuarios u ON u.id_usuario = CAST(t.usuario_responsable AS UNSIGNED)
                ORDER BY t.fecha DESC
                LIMIT :lim";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }
    public function dashboardPedidosFiltrados(?int $idEstado, int $dias = 30): array {
        return $this->model->listarPedidosDashboard($idEstado, $dias);
    }

    // =============================
    // DASHBOARD (DUEÑO - rol 3)
    // =============================
    public function dashboardKpis(): array {
        return $this->model->kpisDashboardDueno();
    }

    public function dashboardPedidosPorEstado(): array {
        return $this->model->pedidosPorEstado();
    }

    public function dashboardUltimosMovimientos(int $limit = 10): array {
        return $this->model->ultimosTrackings($limit);
    }

    public function crearPedido($carrito, $idCliente): int {
        return $this->model->crearPedido($idCliente, $carrito);
    }

}
// =============================
// ROUTER / ENDPOINT (POST)
// =============================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $controller = new PedidoController();

    // Guard mínimo (solo staff)
    $rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
    if (!in_array($rolId, [2,3], true)) {
        $_SESSION['error'] = "No tienes permiso para esta acción.";
        header("Location: " . BASE_URL . "index.php");
        exit;
    }

    if ($action === 'registrar_tracking') {
        $idPedido = (int)($_POST['id_pedido'] ?? 0);
        $idEstado = (int)($_POST['id_estado'] ?? 0);
        $desc = trim($_POST['descripcion'] ?? '');

        if ($idPedido > 0 && $idEstado > 0 && $desc !== '') {
            $controller->registrarTracking($idPedido, $idEstado, $desc);
            $_SESSION['success'] = "Tracking registrado.";
        } else {
            $_SESSION['error'] = "Datos inválidos para registrar tracking.";
        }

        header("Location: " . BASE_URL . "src/view/admin/tracking.php?id=" . $idPedido);
        exit;
    }

    // ✅ tu tracking manda action="cambiar_estado_pedido"
    if ($action === 'cambiar_estado_pedido' || $action === 'actualizar_estado_pedido') {
        $idPedido = (int)($_POST['id_pedido'] ?? 0);
        $idEstado = (int)($_POST['id_estado'] ?? 0);

        if ($idPedido > 0 && $idEstado > 0) {
            $controller->actualizarEstadoPedido($idPedido, $idEstado);
            $_SESSION['success'] = "Estado actualizado.";
        } else {
            $_SESSION['error'] = "Datos inválidos para actualizar estado.";
        }

        header("Location: " . BASE_URL . "src/view/admin/tracking.php?id=" . $idPedido);
        exit;
    }

    $_SESSION['error'] = "Acción no válida.";
    header("Location: " . BASE_URL . "src/view/admin/pedidos.php");
    exit;
}
