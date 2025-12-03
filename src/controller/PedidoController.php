<?php
require_once __DIR__ . '/../model/PedidoModel.php';
require_once __DIR__ . '/../../config/sesion.php';

class PedidoController {

    private PedidoModel $model;

    public function __construct() {
        $this->model = new PedidoModel();
    }

    private function getIdUsuarioSesion(): int {
        // Ajusta si tu sesión usa id_usuario en vez de id
        return isset($_SESSION['usuario']['id']) ? (int)$_SESSION['usuario']['id'] : 0;
    }

    public function misPedidos(): array {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) return [];
        return $this->model->obtenerPedidosUsuario($idUsuario);
    }

    /** ESTE es el que debe usar account.php */
    public function misPedidosConDetalleSesion(): array {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) return [];
        return $this->model->obtenerPedidosConDetalle($idUsuario);
    }

    public function paginarPedidos(int $paginaActual, int $porPagina): array {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) {
            return [
                "pedidos" => [],
                "pagina" => $paginaActual,
                "total" => 0,
                "porPagina" => $porPagina,
                "paginasTotales" => 0
            ];
        }

        $total = $this->model->contarPedidosUsuario($idUsuario);
        $inicio = max(0, ($paginaActual - 1) * $porPagina);
        $pedidos = $this->model->obtenerPedidosPaginados($idUsuario, $inicio, $porPagina);

        return [
            "pedidos" => $pedidos,
            "pagina" => $paginaActual,
            "total" => $total,
            "porPagina" => $porPagina,
            "paginasTotales" => (int)ceil($total / $porPagina)
        ];
    }

    public function registrarTracking(int $idPedido, int $estado, string $descripcion): void {
        $idUsuario = $this->getIdUsuarioSesion();
        if ($idUsuario <= 0) return;
        $this->model->registrarTracking($idPedido, $estado, $descripcion, $idUsuario);
    }
    public function actualizarPerfil(): void {
        if (!isset($_SESSION['usuario']['id'])) {
            $_SESSION['error'] = "No hay sesión activa.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        $id = (int)$_SESSION['usuario']['id'];

        $nombre   = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo   = trim($_POST['correo'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');

        // Validación mínima
        if ($nombre === '' || $apellido === '' || $correo === '') {
            $_SESSION['error'] = "Nombre, apellido y correo son obligatorios.";
            header("Location: " . BASE_URL . "src/view/account.php#settings");
            exit;
        }

        // Actualizar BD (ojo: en tu dump los campos son nombres/apellidos/correo/telefono)
        $this->model->actualizarPerfil($id, $nombre, $apellido, $correo, $telefono);

        // IMPORTANTÍSIMO: actualizar sesión para que la vista muestre lo nuevo sin relogin
        $_SESSION['usuario']['nombre']   = $nombre;
        $_SESSION['usuario']['apellido'] = $apellido;
        $_SESSION['usuario']['correo']   = $correo;
        $_SESSION['usuario']['telefono'] = $telefono;

        $_SESSION['success'] = "Perfil actualizado correctamente.";

        header("Location: " . BASE_URL . "src/view/account.php#settings");
        exit;
    }
    public function pedidosAdmin(): array {
        // aquí asumo que ya tienes $this->model = new PedidoModel();
        return $this->model->listarPedidosAdmin();
    }

}
