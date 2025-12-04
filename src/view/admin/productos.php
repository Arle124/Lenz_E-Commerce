<?php
require_once __DIR__ . "/../../../config/autoload.php";
require_once __DIR__ . "/../../../config/sesion.php";
require_once __DIR__ . "/../../../config/config.php";

// ✅ Guard: sesión
if (!isset($_SESSION['usuario'])) {
  header("Location: " . BASE_URL . "src/view/login_register.php?tab=login");
  exit;
}

// ✅ Guard: solo trabajador (2) o dueño (3)
$rolId = (int)($_SESSION['usuario']['rol_id'] ?? 0);
if (!in_array($rolId, [2, 3], true)) {
  $_SESSION['error'] = "No tienes permiso para administrar productos.";
  header("Location: " . BASE_URL . "index.php");
  exit;
}

$u = $_SESSION['usuario'];

// Controller de productos
require_once __DIR__ . "/../../controller/ProductoController.php";
$productoController = new ProductoController();

// Datos para los selects
$categorias     = $productoController->listarCategorias();
$subcategorias  = $productoController->listarSubcategorias(); // todas, luego filtramos con JS
$productosAdmin = $productoController->listarProductosAdmin();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Administrar productos - Lenz</title>

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
            <h2 class="mb-1">Administrar productos</h2>
            <div class="text-muted">Crear nuevos productos para la tienda</div>
          </div>
          <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>src/view/admin/dashboard.php">
            <i class="bi bi-speedometer2"></i> Volver al panel
          </a>
        </div>

        <!-- Mensajes de sesión -->
        <?php if (!empty($_SESSION['success'])): ?>
          <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success']) ?>
          </div>
          <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['error']) ?>
          </div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="row g-4">
          <!-- FORMULARIO CREAR PRODUCTO -->
          <div class="col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title mb-3">Agregar producto</h5>

                <form
                  action="<?= BASE_URL ?>src/controller/ProductoController.php"
                  method="POST"
                  enctype="multipart/form-data">

                  <input type="hidden" name="action" value="crear_producto">

                  <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" required></textarea>
                  </div>

                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Precio</label>
                      <input type="number" step="0.01" min="0" name="precio" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Stock</label>
                      <input type="number" min="0" name="stock" class="form-control" required>
                    </div>
                  </div>

                  <div class="row g-3 mt-1">
                    <div class="col-md-6">
                      <label class="form-label">Categoría</label>
                      <select name="id_categoria" id="categoria" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($categorias as $c): ?>
                          <option value="<?= (int)$c['id_categoria'] ?>">
                            <?= htmlspecialchars($c['nombre']) ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Subcategoría</label>
                      <select name="id_subcategoria" id="subcategoria" class="form-select" required>
                        <option value="">Seleccione una categoría primero</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3 mt-3">
                    <label class="form-label">Imágenes (puedes subir varias)</label>
                    <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*">
                    <div class="form-text">Formatos permitidos: JPG, PNG, WEBP. Tamaño máx. 2MB c/u.</div>
                  </div>

                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                      <i class="bi bi-plus-circle"></i> Guardar producto
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- LADO DERECHO: solo placeholder por ahora -->
          <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Productos</h5>

                    <?php if (empty($productosAdmin)): ?>
                    <div class="alert alert-info mb-0">No hay productos aún.</div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                        <thead>
                            <tr>
                            <th>Producto</th>
                            <th class="text-end">Precio</th>
                            <th class="text-end">Stock</th>
                            <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productosAdmin as $p): ?>
                            <tr>
                                <td>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if (!empty($p['imagen'])): ?>
                                    <img src="<?= BASE_URL . $p['imagen'] ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" class="main-img" loading="lazy">
                                    <?php endif; ?>
                                    <div>
                                    <div class="fw-semibold"><?= htmlspecialchars($p['nombre']) ?></div>
                                    <div class="text-muted small">
                                        <?= htmlspecialchars($p['categoria_nombre'] . " / " . $p['subcategoria_nombre']) ?>
                                    </div>
                                    </div>
                                </div>
                                </td>
                                <td class="text-end">$<?= number_format((float)$p['precio'], 2) ?></td>
                                <td class="text-end"><?= (int)$p['stock'] ?></td>
                                <td class="text-end">
                                <!-- EDITAR (simple: manda a la misma página con ?edit=ID) -->
                                <a class="btn btn-sm btn-outline-primary"
                                    href="<?= BASE_URL ?>src/view/admin/productos.php?edit=<?= (int)$p['id_producto'] ?>">
                                    Editar
                                </a>

                                <!-- ELIMINAR -->
                                <form action="<?= BASE_URL ?>src/controller/ProductoController.php"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                    <input type="hidden" name="action" value="eliminar_producto">
                                    <input type="hidden" name="id_producto" value="<?= (int)$p['id_producto'] ?>">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button>
                                </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
                </div>

          </div>

        </div> <!-- row -->

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

  <!-- JS para filtrar subcategorías por categoría -->
  <script>
    const allSubcats = <?= json_encode($subcategorias, JSON_UNESCAPED_UNICODE) ?>;
    const selectCat = document.getElementById('categoria');
    const selectSub = document.getElementById('subcategoria');

    function renderSubcategorias(idCategoria) {
      selectSub.innerHTML = '';
      if (!idCategoria) {
        const opt = document.createElement('option');
        opt.value = '';
        opt.textContent = 'Seleccione una categoría primero';
        selectSub.appendChild(opt);
        return;
      }

      const filtradas = allSubcats.filter(sc => parseInt(sc.id_categoria) === parseInt(idCategoria));

      if (filtradas.length === 0) {
        const opt = document.createElement('option');
        opt.value = '';
        opt.textContent = 'No hay subcategorías para esta categoría';
        selectSub.appendChild(opt);
        return;
      }

      const opt0 = document.createElement('option');
      opt0.value = '';
      opt0.textContent = 'Seleccione...';
      selectSub.appendChild(opt0);

      filtradas.forEach(sc => {
        const opt = document.createElement('option');
        opt.value = sc.id_subcategoria;
        opt.textContent = sc.nombre;
        selectSub.appendChild(opt);
      });
    }

    selectCat.addEventListener('change', (e) => {
      renderSubcategorias(e.target.value);
    });
  </script>

</body>
</html>
