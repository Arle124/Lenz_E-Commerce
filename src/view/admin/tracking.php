<?php
require_once __DIR__ . "/../../../config/autoload.php";
require_once __DIR__ . "/../../../config/sesion.php";
require_once __DIR__ . "/../../../config/config.php";

if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
  exit;
}

$rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
if (!in_array($rolId, [2,3], true)) {
  $_SESSION['error'] = "No tienes permiso para ver esta sección.";
  header("Location: " . BASE_URL . "index.php");
  exit;
}

$u = $_SESSION['usuario'];

$idPedido = (int)($_GET['id'] ?? 0);
if ($idPedido <= 0) {
  $_SESSION['error'] = "Falta el ID del pedido para administrar el tracking.";
  header("Location: " . BASE_URL . "src/view/admin/pedidos.php");
  exit;
}

require_once __DIR__ . "/../../../controller/PedidoController.php";
$pedidoController = new PedidoController();

// ⚠️ Tu controller no tiene método público para obtener tracking directo,
// pero tu model sí. Como NO vamos a romper tu estructura,
// hacemos esto: en el controller agrega un método "trackingPedido($id)" o lo hacemos directo desde model.
// Aquí lo hago directo desde model para que funcione ya:

require_once __DIR__ . "/../../model/PedidoModel.php";
$model = new PedidoModel();

$track = $model->obtenerTracking($idPedido);

// Estados disponibles (de tu dump: 1..6)
$estados = [
  1 => 'pendiente',
  2 => 'procesando',
  3 => 'aprobada',
  4 => 'confirmada',
  5 => 'terminada',
  6 => 'cancelado',
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Tracking Pedido #<?= $idPedido ?></title>

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
            <div class="text-muted">Pedido #<?= $idPedido ?></div>
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
          <div class="col-lg-5">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Agregar actualización</h5>

                <form method="POST" action="<?= BASE_URL ?>src/controller/PedidoController.php">
                  <input type="hidden" name="action" value="registrar_tracking">
                  <input type="hidden" name="id_pedido" value="<?= $idPedido ?>">

                  <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="id_estado" required>
                      <?php foreach ($estados as $id => $nombre): ?>
                        <option value="<?= (int)$id ?>"><?= htmlspecialchars($nombre) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="3" required></textarea>
                  </div>

                  <button class="btn btn-primary" type="submit">
                    <i class="bi bi-plus-circle"></i> Guardar tracking
                  </button>
                </form>

                <div class="small text-muted mt-3">
                  * Solo roles trabajador/dueño pueden registrar tracking.
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
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

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
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
