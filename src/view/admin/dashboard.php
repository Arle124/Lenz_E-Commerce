<?php
require_once __DIR__ . "/../../../config/autoload.php";
require_once __DIR__ . "/../../../config/sesion.php";
require_once __DIR__ . "/../../../config/config.php";

// Guard: sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
  exit;
}

// Guard: solo DUEÑO (rol_id = 3)
$rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
if ($rolId !== 3) {
  $_SESSION['error'] = "Solo el dueño puede ver el panel de control.";
  header("Location: " . BASE_URL . "index.php");
  exit;
}

$u = $_SESSION['usuario'];

// Controller
require_once __DIR__ . "/../../controller/PedidoController.php";
$pedidoController = new PedidoController();

// Datos para el dashboard
$estadoSel = isset($_GET['estado']) ? (int)$_GET['estado'] : 0;
$diasSel   = isset($_GET['dias']) ? (int)$_GET['dias'] : 30;
$diasSel   = max(1, min($diasSel, 365));
$kpis        = $pedidoController->dashboardKpis();
$porEstado   = $pedidoController->dashboardPedidosPorEstado();
$movimientos = $pedidoController->dashboardUltimosMovimientos(8);
$pedidosFiltrados = $pedidoController->dashboardPedidosFiltrados($estadoSel ?: null, $diasSel);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Panel del Dueño - Lenz</title>

  <link href="<?= BASE_URL ?>assets/img/favicon.png" rel="icon">
  <link href="<?= BASE_URL ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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

        <!-- Título + botón -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
          <div>
            <h2 class="mb-1">Panel del Dueño</h2>
            <div class="text-muted">Resumen de pedidos y actividad (últimos 30 días)</div>
          </div>
          <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>src/view/admin/pedidos.php">
            <i class="bi bi-clipboard-check"></i> Ver pedidos
          </a>
        </div>

        <!-- KPIs -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="text-muted">Ventas (30 días)</span>
                  <i class="bi bi-cash-coin fs-4 text-primary"></i>
                </div>
                <h3 class="mb-0">
                  $<?= number_format((float)($kpis['total_ventas'] ?? 0), 2) ?>
                </h3>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="text-muted">Pedidos (30 días)</span>
                  <i class="bi bi-bag-check fs-4 text-success"></i>
                </div>
                <h3 class="mb-0">
                  <?= (int)($kpis['total_pedidos'] ?? 0) ?>
                </h3>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="text-muted">Ticket promedio</span>
                  <i class="bi bi-graph-up fs-4 text-info"></i>
                </div>
                <h3 class="mb-0">
                  $<?= number_format((float)($kpis['ticket_promedio'] ?? 0), 2) ?>
                </h3>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-4">
          <!-- Pedidos por estado -->
          <div class="col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title mb-3">Pedidos por estado</h5>

                <?php if (empty($porEstado)): ?>
                  <div class="alert alert-info mb-0">No hay pedidos registrados.</div>
                <?php else: ?>
                  <div class="table-responsive">
                    <a class="btn btn-sm btn-outline-primary" href="?dias=<?= $diasSel ?>">
                        Ver todos
                    </a>
                    <table class="table align-middle mb-0">
                      <thead>
                        <tr>
                          <th>Estado</th>
                          <th class="text-end">Cantidad</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($porEstado as $row): ?>
                          <tr>
                            <td>
                                <a class="text-decoration-none"
                                    href="?estado=<?= (int)($row['id_estado'] ?? 0) ?>&dias=<?= $diasSel ?>">
                                    <?= htmlspecialchars($row['estado_nombre'] ?? '') ?>
                                </a>
                            </td>
                            <td class="text-end"><?= (int)($row['total'] ?? 0) ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Últimos movimientos -->
          <div class="col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title mb-3">Últimos movimientos de pedidos</h5>

                <?php if (empty($movimientos)): ?>
                  <div class="alert alert-info mb-0">Aún no hay movimientos de tracking.</div>
                <?php else: ?>
                  <ul class="list-group list-group-flush">
                    <?php foreach ($movimientos as $m): ?>
                      <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <div class="fw-bold">
                              Pedido #<?= (int)($m['id_pedido'] ?? 0) ?> ·
                              <?= htmlspecialchars($m['estado_nombre'] ?? '') ?>
                            </div>
                            <div><?= htmlspecialchars($m['descripcion'] ?? '') ?></div>
                            <div class="text-muted small">
                              Por: <?= htmlspecialchars($m['usuario'] ?? 'N/A') ?>
                            </div>
                          </div>
                          <div class="text-muted small">
                            <?= htmlspecialchars($m['fecha'] ?? '') ?>
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
