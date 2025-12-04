<?php
require_once __DIR__ . "/../../config/sesion.php"; 
require_once __DIR__ . '/../../config/autoload.php';
require_once PATH_CONFIG . "config.php";
require_once __DIR__ . '/../controller/ProductoController.php';

$productoController = new ProductoController();

// 1️⃣ Agregar producto al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'], $_POST['cantidad'])) {
    $id = (int)$_POST['id_producto'];
    $cantidad = (int)$_POST['cantidad'];
    $producto = $productoController->verProducto($id);

    if ($producto) {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

        if (isset($_SESSION['cart'][$id])) {

            // Asegurar que siempre tenga id_producto
            if (!isset($_SESSION['cart'][$id]['id_producto'])) {
                $_SESSION['cart'][$id]['id_producto'] = $id;
            }

            $_SESSION['cart'][$id]['cantidad'] = min(
                $_SESSION['cart'][$id]['cantidad'] + $cantidad,
                $producto['stock']
            );

        } else {
            $_SESSION['cart'][$id] = [
                'id_producto' => $id,   // ← IMPORTANTE
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => min($cantidad, $producto['stock']),
                'imagen' => !empty($producto['imagenes']) ? $producto['imagenes'][0] : 'assets/img/default.jpg',
                'stock' => $producto['stock']
            ];
        }

        header("Location: cart.php");
        exit;
    }

}

// 2️⃣ Eliminar producto
if (isset($_GET['remove'])) {
    $removeId = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$removeId])) unset($_SESSION['cart'][$removeId]);
    header("Location: cart.php");
    exit;
}

// 3️⃣ Actualizar cantidad
if (isset($_GET['update'], $_GET['cantidad'])) {
    $updateId = (int)$_GET['update'];
    $cantidad = (int)$_GET['cantidad'];
    if (isset($_SESSION['cart'][$updateId])) {
        $_SESSION['cart'][$updateId]['cantidad'] = min($cantidad, $_SESSION['cart'][$updateId]['stock']);
    }
    header("Location: cart.php");
    exit;
}

// 4️⃣ Vaciar carrito
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

// 5️⃣ Calcular subtotal y total
$subtotal = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['precio'] * $item['cantidad'];
    }
}

$total = $subtotal;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito - Lenz</title>
  <link href="<?=BASE_URL?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=BASE_URL?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=BASE_URL?>assets/css/main.css" rel="stylesheet">
</head>
<body class="cart-page">

<?php include_once PATH_LAYOUTS . 'header.php'; ?>

<main class="main">
  <div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Carrito</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="<?=BASE_URL?>index.php">Inicio</a></li>
          <li class="current">Carrito</li>
        </ol>
      </nav>
    </div>
  </div>

  <section id="cart" class="cart section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-4">
        <!-- Carrito Items -->
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
          <div class="cart-items">
            <div class="cart-header d-none d-lg-block">
              <div class="row align-items-center gy-4">
                <div class="col-lg-6"><h5>Producto</h5></div>
                <div class="col-lg-2 text-center"><h5>Precio</h5></div>
                <div class="col-lg-2 text-center"><h5>Cantidad</h5></div>
                <div class="col-lg-2 text-center"><h5>Total</h5></div>
              </div>
            </div>

            <?php if(!empty($_SESSION['cart'])): ?>
              <?php foreach($_SESSION['cart'] as $id => $item): ?>
                <div class="cart-item" data-aos="fade-up">
                  <div class="row align-items-center gy-4">
                    <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                      <div class="product-info d-flex align-items-center">
                        <div class="product-image">
                          <img src="<?= BASE_URL . $item['imagen'] ?>" alt="<?= htmlspecialchars($item['nombre']) ?>" class="img-fluid">
                        </div>
                        <div class="product-details">
                          <h6 class="product-title"><?= htmlspecialchars($item['nombre']) ?></h6>
                          <button class="remove-item btn btn-sm btn-outline-danger mt-2" 
                                  onclick="window.location='cart.php?remove=<?= $id ?>'">
                            <i class="bi bi-trash"></i> Eliminar
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-2 text-center">
                      <div class="price-tag">$<?= number_format($item['precio'],2) ?></div>
                    </div>
                    <div class="col-12 col-lg-2 text-center">
                      <div class="quantity-selector d-flex justify-content-center align-items-center">
                        <button class="quantity-btn decrease btn btn-outline-secondary btn-sm"
                                onclick="window.location='cart.php?update=<?= $id ?>&cantidad=<?= max(1,$item['cantidad']-1) ?>'">
                          <i class="bi bi-dash"></i>
                        </button>
                        <input type="number" class="quantity-input text-center mx-1" style="width:50px;"
                               value="<?= $item['cantidad'] ?>" min="1" max="<?= $item['stock'] ?>"
                               onchange="window.location='cart.php?update=<?= $id ?>&cantidad='+this.value;">
                        <button class="quantity-btn increase btn btn-outline-secondary btn-sm"
                                onclick="window.location='cart.php?update=<?= $id ?>&cantidad=<?= min($item['stock'],$item['cantidad']+1) ?>'">
                          <i class="bi bi-plus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="col-12 col-lg-2 text-center mt-3 mt-lg-0">
                      <div class="item-total">$<?= number_format($item['precio'] * $item['cantidad'],2) ?></div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>

              <div class="cart-actions mt-4 d-flex justify-content-between">
                <a href="cart.php?clear=1" class="btn btn-outline-danger">Vaciar Carrito</a>
              </div>
            <?php else: ?>
              <p>Tu carrito está vacío. <a href="<?= BASE_URL ?>src/view/category.php">Continuar comprando</a></p>
            <?php endif; ?>
          </div>
        </div>

        <!-- Resumen -->
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
          <div class="cart-summary">
            <h4 class="summary-title">Resumen del Pedido</h4>
            <div class="summary-item"><span class="summary-label">Subtotal</span><span class="summary-value">$<?= number_format($subtotal,2) ?></span></div>
            <div class="summary-total"><span class="summary-label">Total</span><span class="summary-value">$<?= number_format($total,2) ?></span></div>
            <div class="checkout-button mt-3">
              <a href="<?=BASE_URL?>src/view/crear_pedido.php" class="btn btn-accent w-100">
                Confirmar Pedido <i class="bi bi-arrow-right"></i>
              </a>
            </div>
            <div class="continue-shopping"> <a href="<?=BASE_URL?>src/view/category.php" class="btn btn-link w-100"> <i class="bi     bi-arrow-left"></i> Continuar Comprando </a> </div>
            </div>
        </div>

      </div>
    </div>
  </section>
</main>

<?php include_once PATH_LAYOUTS . 'footer.php'; ?>

<div id="preloader"></div>

<script src="<?=BASE_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=BASE_URL?>assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?=BASE_URL?>assets/vendor/aos/aos.js"></script>
<script src="<?=BASE_URL?>assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?=BASE_URL?>assets/vendor/drift-zoom/Drift.min.js"></script>

<script src="<?=BASE_URL?>assets/js/main.js"></script>

</body>
</html>