<?php
require_once __DIR__ . "/../../../config/autoload.php";
require_once __DIR__ . "/../../../config/config.php";
require_once __DIR__ . "/_guard_staff.php";

// Header global
require_once PATH_LAYOUTS . "header.php";

// Usa tu controller existente
require_once __DIR__ . "/../../controller/PedidoController.php";
$pedidoController = new PedidoController();

/**
 * ✅ AQUÍ es donde conectas con tu lógica actual:
 * Necesitas un método tipo "listarTodos" o "listarAdmin".
 * 
 * Si no lo tienes aún, abajo te dejo 2 opciones:
 *  A) Si ya existe: $pedidos = $pedidoController->listarTodos();
 *  B) Si solo tienes "misPedidosConDetalleSesion()", entonces aún no hay admin-listado.
 */

// Opción A (recomendada): método admin
if (method_exists($pedidoController, 'listarTodosConDetalle')) {
  $pedidos = $pedidoController->listarTodosConDetalle();
} elseif (method_exists($pedidoController, 'listarPedidosAdmin')) {
  $pedidos = $pedidoController->listarPedidosAdmin();
} else {
  // fallback para no romper la vista
  $pedidos = [];
  $_SESSION['error'] = "Tu PedidoController aún no tiene un método para listar pedidos de todos los clientes (vista admin).";
}

$estado = $_GET['estado'] ?? '';
$buscar = trim($_GET['q'] ?? '');

// Filtros simples en PHP (por si no tienes filtros en DB todavía)
if ($buscar !== '') {
  $pedidos = array_filter($pedidos, function($p) use ($buscar) {
    $id = (string)($p['id_pedido'] ?? '');
    $correo = strtolower($p['correo'] ?? '');
    $nom = strtolower(($p['nombres'] ?? '') . ' ' . ($p['apellidos'] ?? ''));
    $b = strtolower($buscar);
    return str_contains($id, $b) || str_contains($correo, $b) || str_contains($nom, $b);
  });
}

if ($estado !== '') {
  $pedidos = array_filter($pedidos, fn($p) => ($p['estado_nombre'] ?? '') === $estado);
}
?>

<main class="main">
  <section class="section py-4">
    <div class="container">

      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
          <h2 class="mb-1">Pedidos (Admin)</h2>
          <div class="text-muted">Revisa todos los pedidos realizados por clientes.</div>
        </div>
        <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>index.php">
          <i class="bi bi-arrow-left"></i> Volver
        </a>
      </div>

      <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger">
          <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <form class="row g-2 align-items-end mb-3" method="GET">
        <div class="col-md-6">
          <label class="form-label">Buscar (ID, cliente, correo)</label>
          <input class="form-control" name="q" value="<?= htmlspecialchars($buscar) ?>" placeholder="Ej: 15, ana, correo@...">
        </div>

        <div class="col-md-4">
          <label class="form-label">Estado</label>
          <select class="form-select" name="estado">
            <option value="">Todos</option>
            <option value="Processing" <?= $estado==='Processing'?'selected':'' ?>>Processing</option>
            <option value="Shipped" <?= $estado==='Shipped'?'selected':'' ?>>Shipped</option>
            <option value="Delivered" <?= $estado==='Delivered'?'selected':'' ?>>Delivered</option>
            <option value="Cancelled" <?= $estado==='Cancelled'?'selected':'' ?>>Cancelled</option>
          </select>
        </div>

        <div class="col-md-2 d-grid">
          <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i> Filtrar
          </button>
        </div>
      </form>

      <?php if (empty($pedidos)): ?>
        <div class="alert alert-info mb-0">No hay pedidos para mostrar.</div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Correo</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th class="text-end">Total</th>
                <th class="text-end">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pedidos as $p): ?>
                <tr>
                  <td>#<?= (int)($p['id_pedido'] ?? 0) ?></td>
                  <td><?= htmlspecialchars(($p['nombres'] ?? '') . ' ' . ($p['apellidos'] ?? '')) ?></td>
                  <td><?= htmlspecialchars($p['correo'] ?? '') ?></td>
                  <td><?= htmlspecialchars($p['creado_en'] ?? '') ?></td>
                  <td>
                    <span class="badge bg-secondary">
                      <?= htmlspecialchars($p['estado_nombre'] ?? 'N/A') ?>
                    </span>
                  </td>
                  <td class="text-end">$<?= number_format((float)($p['total'] ?? 0), 2) ?></td>

                  <td class="text-end">
                    <!-- Ajusta estas rutas según lo que implemente tu sistema -->
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
