<?php
require_once __DIR__ . '/../../config/autoload.php';
require_once PATH_CONFIG . "config.php";

require_once __DIR__ . "/../controller/CategoriaController.php";
require_once __DIR__ . "/../controller/ProductoController.php";

$categoriaController = new CategoriaController();
$productoController = new ProductoController();

// Captura filtros de URL
$cat = $_GET['cat'] ?? null;
$subcat = $_GET['subcat'] ?? null;
$order = $_GET['order'] ?? null;
$price = $_GET['price'] ?? null;

// Obtiene categorías y subcategorías para el sidebar
$categorias = $categoriaController->listarConSubcategorias();

// Obtiene productos filtrados
$productos = $productoController->filtrar($cat, $subcat, $order, $price);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorías - Lenz</title>

  <!-- CSS & Fonts -->
  <link href="<?= BASE_URL ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/css/main.css" rel="stylesheet">
</head>
<body class="category-page">

  <?php include_once PATH_LAYOUTS . 'header.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Categorías</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="<?= BASE_URL ?>index.php">Inicio</a></li>
            <li class="current">Categorías</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="container">
      <div class="row">

        <!-- Sidebar -->
        <div class="col-lg-4 sidebar">
          <div class="widgets-container">

            <div class="product-categories-widget widget-item">
              <h3 class="widget-title">Categorías</h3>
              <ul class="category-tree list-unstyled mb-0">
                <?php foreach ($categorias as $catItem): ?>
                  <li class="category-item">
                    <div class="d-flex justify-content-between align-items-center category-header <?= empty($catItem['subcategorias']) ? '' : 'collapsed' ?>"
                        <?= empty($catItem['subcategorias']) ? '' : 'data-bs-toggle="collapse" data-bs-target="#cat-'.$catItem['id'].'-subs"' ?>
                        aria-expanded="false">
                      <a href="?cat=<?= $catItem['id'] ?>" class="category-link"><?= htmlspecialchars($catItem['nombre']) ?></a>
                      <?php if(!empty($catItem['subcategorias'])): ?>
                        <span class="category-toggle"><i class="bi bi-chevron-down"></i><i class="bi bi-chevron-up"></i></span>
                      <?php endif; ?>
                    </div>

                    <?php if(!empty($catItem['subcategorias'])): ?>
                      <ul id="cat-<?= $catItem['id'] ?>-subs" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                        <?php foreach ($catItem['subcategorias'] as $sub): ?>
                          <li><a href="?subcat=<?= $sub['id'] ?>"><?= htmlspecialchars($sub['nombre']) ?></a></li>
                        <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

          </div>
        </div>
        <!-- /Sidebar -->

        <!-- Main Content -->
        <div class="col-lg-8">

          <!-- Filtros -->
          <section class="category-header section mb-4">
            <div class="container">

              <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-3">
                  <label for="priceRange" class="form-label">Rango de Precios</label>
                  <select id="priceRange" class="form-select" onchange="location=this.value;">
                    <option value="category.php" <?= !$price ? 'selected' : '' ?>>Todos los precios</option>
                    <option value="category.php?price=0-25" <?= $price==='0-25'?'selected':'' ?>>Menos de $25</option>
                    <option value="category.php?price=25-50" <?= $price==='25-50'?'selected':'' ?>>$25 a $50</option>
                    <option value="category.php?price=50-100" <?= $price==='50-100'?'selected':'' ?>>$50 a $100</option>
                    <option value="category.php?price=100-200" <?= $price==='100-200'?'selected':'' ?>>$100 a $200</option>
                    <option value="category.php?price=200-600000" <?= $price==='200-600000'?'selected':'' ?>>$200 & Más</option>
                  </select>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                  <label for="sortBy" class="form-label">Ordenar Por</label>
                  <select id="sortBy" class="form-select" onchange="location=this.value;">
                    <option value="category.php" <?= !$order ? 'selected':'' ?>>Destacados</option>
                    <option value="category.php?order=price_asc" <?= $order==='price_asc'?'selected':'' ?>>Precio: Menor a Mayor</option>
                    <option value="category.php?order=price_desc" <?= $order==='price_desc'?'selected':'' ?>>Precio: Mayor a Menor</option>
                    <option value="category.php?order=newest" <?= $order==='newest'?'selected':'' ?>>Nuevas Llegadas</option>
                  </select>
                </div>
              </div>

              <!-- Filtros activos -->
              <div class="row mt-3">
                <div class="col-12">
                  <div class="active-filters">
                    <?php if($cat): ?><span class="filter-tag">Cat <?= htmlspecialchars($cat) ?> <a href="category.php"><i class="bi bi-x"></i></a></span><?php endif; ?>
                    <?php if($subcat): ?><span class="filter-tag">Sub <?= htmlspecialchars($subcat) ?> <a href="category.php"><i class="bi bi-x"></i></a></span><?php endif; ?>
                    <?php if($price): ?><span class="filter-tag">Precio <?= htmlspecialchars($price) ?> <a href="category.php"><i class="bi bi-x"></i></a></span><?php endif; ?>
                    <?php if($cat||$subcat||$price): ?><a href="category.php" class="clear-all-btn">Clear All</a><?php endif; ?>
                  </div>
                </div>
              </div>

            </div>
          </section>
          <!-- /Filtros -->

          <!-- Productos -->
          <section class="category-product-list section">
            <div class="container">
              <div class="row gy-4">
                <?php foreach($productos as $prod): ?>
                  <div class="col-lg-6">
                    <div class="product-box">
                      <div class="product-thumb">
                        <?php if($prod['nuevo']??false): ?><span class="product-label">New Season</span><?php endif; ?>
                        <!-- <img src="<?= $prod['imagen'] ?>" alt="<?= htmlspecialchars($prod['nombre']) ?>" class="main-img"> -->
                      </div>
                      <div class="product-content">
                        <h3 class="product-title"><a href="product-details.php?id=<?= $prod['id_producto'] ?>"><?= htmlspecialchars($prod['nombre']) ?></a></h3>
                        <div class="product-price">$<?= number_format($prod['precio'],2) ?></div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </section>
          <!-- /Productos -->

        </div>

      </div>
    </div>

  </main>

  <?php include_once PATH_LAYOUTS . 'footer.php'; ?>

  <!-- Preloader -->
  <div id="preloader"></div>

    <!-- Vendor JS Files -->
  <script src="<?= BASE_URL ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/aos/aos.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/drift-zoom/Drift.min.js"></script>
  <script src="<?= BASE_URL ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>

    <!-- Main JS File -->
  <script src="<?= BASE_URL ?>assets/js/main.js"></script>

</body>
</html>