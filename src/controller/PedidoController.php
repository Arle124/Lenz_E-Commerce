<?php
require_once __DIR__ . '/../model/PedidoModel.php';
require_once __DIR__ . '/../../config/sesion.php';

class PedidoController {

    private $model;

    public function __construct() {
        $this->model = new PedidoModel();
    }

    public function misPedidos() {

        if (!isset($_SESSION['usuario']['id'])) {
            return [];
        }

        $idUsuario = $_SESSION['usuario']['id'];

        return $this->model->obtenerPedidosPorUsuario($idUsuario);
    }


    public function detallePedido($idPedido) {
        return $this->model->detallePedido($idPedido);
    }

    public function paginarPedidos($paginaActual, $porPagina) {

        $idUsuario = $_SESSION['usuario']['id'];

        $totalPedidos = $this->model->contarPedidos($idUsuario);

        $inicio = ($paginaActual - 1) * $porPagina;

        $pedidos = $this->model->misPedidosPaginados($idUsuario, $inicio, $porPagina);

        return [
            "pedidos" => $pedidos,
            "pagina" => $paginaActual,
            "total" => $totalPedidos,
            "porPagina" => $porPagina,
            "paginasTotales" => ceil($totalPedidos / $porPagina)
        ];
    }
    public function tracking($idPedido) {
        return $this->model->obtenerTracking($idPedido);
    }

    public function registrarTracking($idPedido, $estado, $descripcion) {

        $idUsuario = $_SESSION['usuario']['id'];

        $this->model->agregarTracking($idPedido, $estado, $descripcion, $idUsuario);
    }

}
