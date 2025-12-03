<?php
require_once __DIR__ . "/../../config/conexion.php";

class PedidoModel {

    private $conn;

    public function __construct() {
        $this->conn = Database::conectar();
    }

    // Obtener pedidos del usuario
    public function misPedidos($idUsuario) {
        // $sql = "SELECT p.*, ep.nombre AS estado_nombre
        //         FROM pedidos p
        //         JOIN estados_pedido ep ON ep.id_estado = p.id_estado
        //         WHERE p.id_cliente = :id
        //         ORDER BY p.creado_en DESC";
        $sql = "CALL sp_obtener_pedidos_usuario(:id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idUsuario]);

        return $stmt->fetchAll();
    }

    // Obtener productos dentro de un pedido
    public function detallePedido($idPedido) {
        // $sql = "SELECT pd.*, pr.nombre, pr.precio,
        //        (SELECT ruta FROM imagenes_productos 
        //         WHERE id_producto = pr.id_producto LIMIT 1) AS imagen
        //        FROM pedidos_detalles pd
        //        JOIN productos pr ON pr.id_producto = pd.id_producto
        //        WHERE pd.id_pedido = :id";
        $sql = "CALL sp_obtener_productos_pedido(:idPedido)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idPedido]);

        return $stmt->fetchAll();
    }
    public function contarPedidos($idUsuario) {
    $sql = "SELECT COUNT(*) AS total FROM pedidos WHERE id_cliente = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $idUsuario]);
    return $stmt->fetch()['total'];
    }

    public function misPedidosPaginados($idUsuario, $inicio, $limite) {
        $sql = "SELECT p.*, ep.nombre AS estado_nombre
                FROM pedidos p
                JOIN estados_pedido ep ON ep.id_estado = p.id_estado
                WHERE p.id_cliente = :id
                ORDER BY p.creado_en DESC
                LIMIT :inicio, :limite";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $idUsuario, PDO::PARAM_INT);
        $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function obtenerPedidosPorUsuario($idCliente) {

        $sql = "CALL sp_obtener_pedidos_usuario(:idCliente)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':idCliente' => $idCliente]);

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt->closeCursor(); // SUPER IMPORTANTE PARA NO BLOQUEAR + SPs

        return $resultado;
    }
    public function agregarTracking($idPedido, $idEstado, $descripcion, $idUsuario) {

        $sql = "CALL sp_registrar_tracking(:pedido, :estado, :descripcion, :usuario)";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":pedido" => $idPedido,
            ":estado" => $idEstado,
            ":descripcion" => $descripcion,
            ":usuario" => $idUsuario
        ]);

        $stmt->closeCursor();
    }

    public function obtenerTracking($idPedido) {

        $sql = "SELECT t.*, e.nombre AS estado_nombre, u.nombres AS usuario
                FROM ad_trk_pedidos t
                JOIN estados_pedido e ON e.id_estado = t.id_estado
                JOIN usuarios u ON u.id_usuario = t.usuario_responsable
                WHERE t.id_pedido = :id
                ORDER BY t.fecha ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":id" => $idPedido]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function actualizarPerfil($id, $nombre, $apellido, $email, $telefono)
    {
        $sql = "UPDATE usuarios 
                SET nombres = :nombre,
                    apellidos = :apellido,
                    email = :email,
                    telefono = :telefono
                WHERE id_usuario = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":email" => $email,
            ":telefono" => $telefono,
            ":id" => $id
        ]);
    }



}
