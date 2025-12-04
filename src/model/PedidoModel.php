<?php
require_once __DIR__ . "/../../config/conexion.php";

class PedidoModel {

    private PDO $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    /** Pedidos del usuario (SP SÍ existe en tu dump) */
    public function obtenerPedidosUsuario(int $idUsuario): array {
        $sql = "CALL sp_obtener_pedidos_usuario(:idUsuario)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idUsuario' => $idUsuario]);

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $res;
    }

    /** Detalle del pedido (NO SP: porque NO existe en tu BD) */
    public function obtenerDetallePedido(int $idPedido): array {
        $sql = "SELECT 
                    pr.id_producto,
                    pr.nombre,
                    pd.cantidad,
                    pd.precio_unitario AS precio,
                    (SELECT ruta
                     FROM imagenes_productos ip
                     WHERE ip.id_producto = pr.id_producto
                     ORDER BY ip.id_imagen ASC
                     LIMIT 1) AS imagen
                FROM pedidos_detalles pd
                JOIN productos pr ON pr.id_producto = pd.id_producto
                WHERE pd.id_pedido = :idPedido";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idPedido' => $idPedido]);

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $res;
    }

    /** Tracking (tu tabla tiene usuario_responsable varchar, por eso el CAST) */
    public function obtenerTracking(int $idPedido): array {
        $sql = "SELECT t.*, e.nombre AS estado_nombre, u.nombres AS usuario
                FROM ad_trk_pedidos t
                JOIN estados_pedido e ON e.id_estado = t.id_estado
                JOIN usuarios u ON u.id_usuario = CAST(t.usuario_responsable AS UNSIGNED)
                WHERE t.id_pedido = :id
                ORDER BY t.fecha ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $idPedido]);

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $res;
    }

    /** Para la vista: pedidos + items + track */
    public function obtenerPedidosConDetalle(int $idUsuario): array {
        $pedidos = $this->obtenerPedidosUsuario($idUsuario);

        foreach ($pedidos as &$p) {
            $idPedido = (int)($p['id_pedido'] ?? 0);
            $p['items'] = $idPedido ? $this->obtenerDetallePedido($idPedido) : [];
            $p['track'] = $idPedido ? $this->obtenerTracking($idPedido) : [];
        }
        unset($p);

        return $pedidos;
    }

    public function contarPedidosUsuario(int $idUsuario): int {
        $sql = "SELECT COUNT(*) AS total FROM pedidos WHERE id_cliente = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idUsuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }
    public function obtenerHashPassword(int $idUsuario): ?string
    {
        $sql = "SELECT clave FROM usuarios WHERE id_usuario = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idUsuario]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['clave'] ?? null;
    }

    public function eliminarCuenta(int $idUsuario): void
    {
        // Opción A (recomendado): SP
        $sql = "CALL sp_eliminar_usuario(:id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idUsuario]);
        $stmt->closeCursor();
    }
    public function listarPedidosAdmin(): array {
        $stmt = $this->conn->prepare("CALL sp_admin_listar_pedidos()");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }
    public function registrarTracking(int $idPedido, int $estado, string $descripcion, int $idUsuario): void {
        $stmt = $this->conn->prepare("CALL sp_registrar_tracking(:p, :e, :d, :u)");
        $stmt->execute([
            ':p' => $idPedido,
            ':e' => $estado,
            ':d' => $descripcion,
            ':u' => $idUsuario
        ]);
        $stmt->closeCursor();
    }

    public function cambiarEstadoPedido(int $idPedido, int $nuevoEstado, int $usuario): bool {
        $sql = "CALL sp_cambiar_estado_pedido(:p_id_pedido, :p_nuevo_estado, :p_usuario_responsable)";
        $stmt = $this->conn->prepare($sql);

        $ok = $stmt->execute([
            ':p_id_pedido' => $idPedido,
            ':p_nuevo_estado' => $nuevoEstado,
            ':p_usuario_responsable' => $usuario
        ]);

        $stmt->closeCursor();
        return $ok;
    }
    // Productos (items) del pedido + imagen
    public function obtenerItemsPedido(int $idPedido): array {
    $sql = "SELECT 
                pr.id_producto,
                pr.nombre,
                pd.cantidad,
                pd.precio_unitario AS precio,
                (SELECT ruta
                FROM imagenes_productos ip
                WHERE ip.id_producto = pr.id_producto
                ORDER BY ip.id_imagen ASC
                LIMIT 1) AS imagen
            FROM pedidos_detalles pd
            JOIN productos pr ON pr.id_producto = pd.id_producto
            WHERE pd.id_pedido = :idPedido";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':idPedido' => $idPedido]);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    $stmt->closeCursor();
    return $res;
    }

    // Info general del pedido (cliente + estado actual)
    public function obtenerPedidoAdminPorId(int $idPedido): ?array {
    $sql = "SELECT 
                p.id_pedido,
                p.id_cliente,
                CONCAT(u.nombres,' ',u.apellidos) AS cliente,
                u.correo,
                p.total,
                p.creado_en,
                p.id_estado,
                e.nombre AS estado_nombre
            FROM pedidos p
            JOIN usuarios u ON u.id_usuario = p.id_cliente
            JOIN estados_pedido e ON e.id_estado = p.id_estado
            WHERE p.id_pedido = :id
            LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $idPedido]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    $stmt->closeCursor();
    return $row;
    }

    // Cambiar estado actual del pedido (solo UPDATE)
    public function actualizarEstadoPedido(int $idPedido, int $idEstado, int $usuario): bool {
        return $this->cambiarEstadoPedido($idPedido, $idEstado, $usuario);
    }
    /** Totales generales para dashboard del dueño */
    public function obtenerTotalesDashboardDueno(): array {
        $sql = "
            SELECT
                COALESCE((SELECT SUM(total) FROM pedidos), 0) AS total_ventas,
                COALESCE((SELECT COUNT(*) FROM pedidos), 0) AS total_pedidos,
                COALESCE((SELECT COUNT(DISTINCT id_cliente) FROM pedidos), 0) AS total_clientes
        ";
        $stmt = $this->conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $row;
    }

    /** Pedidos agrupados por estado */
    public function obtenerPedidosPorEstado(): array {
        $sql = "
            SELECT 
                e.id_estado,
                e.nombre AS estado,
                COUNT(*) AS total
            FROM pedidos p
            JOIN estados_pedido e ON e.id_estado = p.id_estado
            GROUP BY e.id_estado, e.nombre
            ORDER BY e.id_estado ASC
        ";
        $stmt = $this->conn->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }

    /** Últimos movimientos de tracking globales (para dashboard) */
    public function obtenerTrackingReciente(int $limit = 10): array {
        $sql = "
            SELECT 
                t.*,
                e.nombre AS estado_nombre,
                CONCAT(u.nombres,' ',u.apellidos) AS usuario
            FROM ad_trk_pedidos t
            JOIN estados_pedido e ON e.id_estado = t.id_estado
            JOIN usuarios u ON u.id_usuario = CAST(t.usuario_responsable AS UNSIGNED)
            ORDER BY t.fecha DESC
            LIMIT :lim
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }
    // =============================
    // DASHBOARD (DUEÑO - rol 3)
    // =============================

    // KPIs últimos 30 días: total ventas, total pedidos, ticket promedio
    public function kpisDashboardDueno(): array {
        $sql = "SELECT
                    COALESCE(SUM(p.total), 0) AS total_ventas,
                    COUNT(*) AS total_pedidos,
                    COALESCE(AVG(p.total), 0) AS ticket_promedio
                FROM pedidos p
                WHERE p.creado_en >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $row;
    }

    // Pedidos por estado (total histórico)
    public function pedidosPorEstado(): array {
        $sql = "SELECT
                    e.id_estado,
                    e.nombre AS estado_nombre,
                    COUNT(p.id_pedido) AS total
                FROM estados_pedido e
                LEFT JOIN pedidos p ON p.id_estado = e.id_estado
                GROUP BY e.id_estado, e.nombre
                ORDER BY e.id_estado ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }

    // Últimos movimientos del tracking (limit)
    public function ultimosTrackings(int $limit = 10): array {
        $limit = max(1, min($limit, 50)); // límite de seguridad

        $sql = "SELECT
                    t.id_pedido,
                    t.id_estado,
                    e.nombre AS estado_nombre,
                    t.descripcion,
                    t.fecha,
                    u.nombres AS usuario
                FROM ad_trk_pedidos t
                JOIN estados_pedido e ON e.id_estado = t.id_estado
                LEFT JOIN usuarios u ON u.id_usuario = CAST(t.usuario_responsable AS UNSIGNED)
                ORDER BY t.fecha DESC
                LIMIT $limit";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        $stmt->closeCursor();
        return $rows;
    }

    // Lista pedidos (para dashboard) con filtros
public function listarPedidosDashboard(?int $idEstado = null, int $dias = 30): array {
    $dias = max(1, min($dias, 365));

    $sql = "SELECT
                p.id_pedido,
                CONCAT(u.nombres,' ',u.apellidos) AS cliente,
                u.correo,
                p.total,
                p.creado_en,
                p.id_estado,
                e.nombre AS estado_nombre
            FROM pedidos p
            JOIN usuarios u ON u.id_usuario = p.id_cliente
            JOIN estados_pedido e ON e.id_estado = p.id_estado
            WHERE p.creado_en >= DATE_SUB(NOW(), INTERVAL :dias DAY)";

    if (!empty($idEstado)) {
        $sql .= " AND p.id_estado = :estado";
    }

    $sql .= " ORDER BY p.creado_en DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':dias', $dias, PDO::PARAM_INT);

    if (!empty($idEstado)) {
        $stmt->bindValue(':estado', $idEstado, PDO::PARAM_INT);
    }

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    $stmt->closeCursor();
    return $rows;
}



}