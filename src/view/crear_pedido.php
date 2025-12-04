<?php
require_once __DIR__ . "/../controller/PedidoController.php";
require_once __DIR__ . "/../../config/sesion.php"; 

// Validar que exista carrito
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("No hay productos en el carrito.");
}

// Validar usuario
if (!isset($_SESSION['usuario']['id'])) {
    die("Debes iniciar sesión para realizar un pedido.");
}

$idCliente = (int)$_SESSION['usuario']['id'];

$pedidoController = new PedidoController();

// Crear pedido y obtener ID
$idPedido = $pedidoController->crearPedido($_SESSION['cart'], $idCliente);

// Vaciar carrito
unset($_SESSION['cart']);

// Redirigir a WhatsApp
$numeroTienda = "573134344376"; // Cambia por tu número real
$mensaje = "Hola, hice un pedido y mi número es: $idPedido";
$mensaje = urlencode($mensaje);

header("Location: https://wa.me/$numeroTienda?text=$mensaje");
exit;