<?php
require_once __DIR__ . "/../../../config/autoload.php";
require_once __DIR__ . "/../../../config/sesion.php";
require_once __DIR__ . "/../../../config/config.php";

// ✅ Guard: sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
  exit;
}

// ✅ Guard: rol (2=trabajador, 3=dueño)
$rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
if (!in_array($rolId, [2,3], true)) {
  $_SESSION['error'] = "No tienes permiso para ver esta sección.";
  header("Location: " . BASE_URL . "index.php");
  exit;
}

$u = $_SESSION['usuario'];

// ✅ Debe venir id del pedido
$idPedido = (int)($_GET['id'] ?? 0);
if ($idPedido <= 0) {
  $_SESSION['error'] = "Selecciona un pedido para administrar el tracking.";
  header("Location: " . BASE_URL . "src/view/admin/pedidos.php");
  exit;
}

// ✅ Rutas correctas desde src/view/admin/
require_once __DIR__ . "/../../controller/PedidoController.php";
require_once __DIR__ . "/../../model/PedidoModel.php";

$pedidoController = new PedidoController();
$model = new PedidoModel();

// Datos
$pedido = $pedidoController->pedidoAdminPorId($idPedido);
if (!$pedido) {
  $_SESSION['error'] = "No se encontró el pedido.";
  header("Location: " . BASE_URL . "src/view/admin/pedidos.php");
  exit;
}

$items  = $pedidoController->itemsPedido($idPedido);
$track  = $model->obtenerTracking($idPedido);

// Estados disponibles (de tu BD)
$estados = [
  1 => 'pendiente',
  2 => 'procesando',
  3 => 'aprobada',
  4 => 'confirmada',
  5 => 'terminada',
  6 => 'cancelado',
];

$estadoActual = (int)($pedido['id_estado'] ?? 0);

// Reglas de negocio (no tocar si terminado/cancelado)
$bloqueado = in_array($estadoActual, [5,6], true);

// Para el select: solo permite avanzar (id mayor). Si está 0, permite desde 1.
$estadosPermitidos = [];
foreach ($estados as $id => $nombre) {
  if ($id > $estadoActual) {
    $estadosPermitidos[$id] = $nombre;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tracking Pedido #<?= (int)$idPedido ?></title>

  <link href="<?= BASE_URL ?>assets/img/favicon.png" rel="icon">
  <link href="<?= BASE_URL ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="<?= BASE_URL ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/drift-zoom/drift-basic.css" rel="stylesheet">

  <link href="<?= BASE_URL ?>assets/css/main.css" rel="stylesheet">
</head>

<body class="account-page">

<?php require_once PATH_LAYOUTS . "header.php"; ?>

<main class="main">
  <section class="section py-4">
    <div class="container" data-aos="fade-up">

      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
          <h2 class="mb-1">Administrar tracking</h2>
          <div class="text-muted">Pedido #<?= (int)$idPedido ?></div>
        </div>
        <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>src/view/admin/pedidos.php">
          <i class="bi bi-arrow-left"></i> Volver a Pedidos
        </a>
      </div>

      <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <div class="row g-4">

        <!-- LEFT: actualizar pedido (un solo formulario) -->
        <div class="col-lg-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Actualizar pedido</h5>

              <div class="mb-3">
                <div class="mb-1">
                  <span class="text-muted">Cliente:</span>
                  <strong><?= htmlspecialchars($pedido['cliente'] ?? '') ?></strong>
                </div>
                <div class="text-muted small">
                  Correo: <?= htmlspecialchars($pedido['correo'] ?? '') ?><br>
                  Total: <strong>$<?= number_format((float)($pedido['total'] ?? 0), 2) ?></strong><br>
                  Estado actual: <strong><?= htmlspecialchars($pedido['estado_nombre'] ?? '') ?></strong>
                </div>
              </div>

              <?php if ($bloqueado): ?>
                <div class="alert alert-warning mb-0">
                  Este pedido ya está <strong><?= htmlspecialchars($pedido['estado_nombre'] ?? '') ?></strong> y no permite cambios.
                </div>
              <?php elseif (empty($estadosPermitidos)): ?>
                <div class="alert alert-info mb-0">
                  No hay estados siguientes disponibles para este pedido.
                </div>
              <?php else: ?>
                <form method="POST" action="<?= BASE_URL ?>src/controller/PedidoController.php">
                  <input type="hidden" name="action" value="registrar_tracking">
                  <input type="hidden" name="id_pedido" value="<?= (int)$idPedido ?>">

                  <div class="mb-3">
                    <label class="form-label">Nuevo estado</label>
                    <select class="form-select" name="id_estado" required>
                      <?php foreach ($estadosPermitidos as $id => $nombre): ?>
                        <option value="<?= (int)$id ?>">
                          <?= htmlspecialchars($nombre) ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <div class="form-text">
                      * Solo se permite avanzar el estado (no repetir ni retroceder).
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="3" required
                      placeholder="Ej: Pedido empaquetado, listo para envío..."></textarea>
                  </div>

                  <button class="btn btn-primary w-100" type="submit">
                    <i class="bi bi-plus-circle"></i> Guardar actualización
                  </button>
                </form>

                <div class="small text-muted mt-3">
                  * Solo roles trabajador/dueño pueden registrar tracking.
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="col-lg-7">

          <!-- Productos -->
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Productos del pedido</h5>

              <?php if (empty($items)): ?>
                <div class="alert alert-info mb-0">Este pedido no tiene productos.</div>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table align-middle">
                    <thead>
                      <tr>
                        <th>Producto</th>
                        <th class="text-end">Cantidad</th>
                        <th class="text-end">Precio</th>
                        <th class="text-end">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($items as $it): ?>
                        <tr>
                          <td>
                            <div class="d-flex align-items-center gap-2">
                              <img src="<?= BASE_URL . $it['imagen'] ?>" alt="<?= htmlspecialchars($it['nombre']) ?>" class="main-img" loading="lazy">
                              <div><?= htmlspecialchars($it['nombre'] ?? '') ?></div>
                            </div>
                          </td>
                          <td class="text-end"><?= (int)($it['cantidad'] ?? 0) ?></td>
                          <td class="text-end">$<?= number_format((float)($it['precio'] ?? 0), 2) ?></td>
                          <td class="text-end">$<?= number_format(((float)($it['precio'] ?? 0) * (int)($it['cantidad'] ?? 0)), 2) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Historial -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Historial del pedido</h5>

              <?php if (empty($track)): ?>
                <div class="alert alert-info mb-0">Este pedido aún no tiene historial.</div>
              <?php else: ?>
                <ul class="list-group list-group-flush">
                  <?php foreach ($track as $t): ?>
                    <li class="list-group-item">
                      <div class="d-flex justify-content-between align-items-start">
                        <div>
                          <div class="fw-bold">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            <?= htmlspecialchars($t['estado_nombre'] ?? '') ?>
                          </div>
                          <div><?= htmlspecialchars($t['descripcion'] ?? '') ?></div>
                          <div class="text-muted small">Por: <?= htmlspecialchars($t['usuario'] ?? 'N/A') ?></div>
                        </div>
                        <div class="text-muted small">
                          <?= htmlspecialchars($t['fecha'] ?? '') ?>
                        </div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>

            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</main>

<?php require_once PATH_LAYOUTS . "footer.php"; ?>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>
<div id="preloader"></div>

<script src="<?= BASE_URL ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= BASE_URL ?>assets/vendor/aos/aos.js"></script>
<script src="<?= BASE_URL ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?= BASE_URL ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= BASE_URL ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= BASE_URL ?>assets/vendor/drift-zoom/Drift.min.js"></script>
<script src="<?= BASE_URL ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?= BASE_URL ?>assets/js/main.js"></script>

</body>
</html>
