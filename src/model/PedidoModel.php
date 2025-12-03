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
    public function actualizarPerfil(int $id, string $nombre, string $apellido, string $correo, string $telefono): bool {
        $sql = "CALL sp_actualizar_usuario(:p_id, :p_nombre, :p_apellido, :p_correo, :p_telefono)";
        $stmt = $this->conn->prepare($sql);

        $ok = $stmt->execute([
            ':p_id' => $id,
            ':p_nombre' => $nombre,
            ':p_apellido' => $apellido,
            ':p_correo' => $correo,
            ':p_telefono' => $telefono
        ]);

        $stmt->closeCursor();
        return $ok;
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

}