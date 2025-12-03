<?php
require_once __DIR__ . "/../../../config/autoload.php";
require_once __DIR__ . "/../../../config/sesion.php";
require_once __DIR__ . "/../../../config/config.php";


// ✅ Guard: sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
  exit;
}

// ✅ Guard: rol (según tu BD: 2=trabajador, 3=dueño)
$rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
if (!in_array($rolId, [2,3], true)) {
  $_SESSION['error'] = "No tienes permiso para ver esta sección.";
  header("Location: " . BASE_URL . "index.php");
  exit;
}

$u = $_SESSION['usuario'];
// Controller
require_once  "../../controller/PedidoController.php";
$pedidoController = new PedidoController();

$pedidos = $pedidoController->pedidosAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pedidos - Admin</title>

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
            <h2 class="mb-1">Pedidos (<?= $rolId === 3 ? "Dueño" : "Trabajador" ?>)</h2>
            <div class="text-muted">Lista de pedidos de clientes</div>
          </div>
          <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>src/view/account.php">
            <i class="bi bi-arrow-left"></i> Volver a Account
          </a>
        </div>

        <?php if (!empty($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['error']) ?>
          </div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (empty($pedidos)): ?>
          <div class="alert alert-info mb-0">No hay pedidos.</div>
        <?php else: ?>
          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Correo</th>
                  <th>Estado</th>
                  <th class="text-end">Total</th>
                  <th>Fecha</th>
                  <th class="text-end">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pedidos as $p): ?>
                  <tr>
                    <td>#<?= (int)($p['id_pedido'] ?? 0) ?></td>
                    <td><?= htmlspecialchars($p['cliente'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['correo'] ?? '') ?></td>
                    <td><?= htmlspecialchars($p['estado_nombre'] ?? '') ?></td>
                    <td class="text-end">$<?= number_format((float)($p['total'] ?? 0), 2) ?></td>
                    <td><?= htmlspecialchars($p['creado_en'] ?? '') ?></td>
                    <td class="text-end">
                      <a class="btn btn-sm btn-outline-primary"
                         href="<?= BASE_URL ?>src/view/admin/tracking.php?id=<?= (int)($p['id_pedido'] ?? 0) ?>">
                        <i class="bi bi-truck"></i> Tracking
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>

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
