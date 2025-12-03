<?php
require_once __DIR__ . '/../../config/autoload.php';
require_once PATH_CONFIG . "config.php";

require_once __DIR__ . "/../controller/ProductoController.php";

$productoController = new ProductoController();

// Obtener id del producto desde la URL
$idProducto = $_GET['id'] ?? null;

if (!$idProducto) {
    // Si no hay id, redirigir a category.php
    header("Location: category.php");
    exit;
}

// Obtener producto
$producto = $productoController->verProducto($idProducto);

if (!$producto) {
    // Si el producto no existe
    echo "Producto no encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Detalles del Producto - Lenz</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?= BASE_URL ?>assets/img/favicon.png" rel="icon">
  <link href="<?= BASE_URL ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= BASE_URL ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/vendor/drift-zoom/drift-basic.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= BASE_URL ?>assets/css/main.css" rel="stylesheet">

</head>

<body class="product-details-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS . 'header.php'?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Detalles del producto</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="<?= BASE_URL ?>index.php">Inicio</a></li>
            <li class="current">Detalles del producto</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Product Details Section -->
    <section id="product-details" class="product-details section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          
          <!-- Product Images -->
          <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
            <div class="product-images">
              <div class="main-image-container mb-3">
                <div class="image-zoom-container">
                  <?php
                  $mainImage = !empty($producto['imagenes']) ? $producto['imagenes'][0] : 'assets/img/default.jpg';
                  ?>
                  <img src="<?= BASE_URL . $mainImage ?>" 
                      alt="<?= htmlspecialchars($producto['nombre']) ?>" 
                      class="img-fluid main-image drift-zoom" 
                      id="main-product-image" 
                      data-zoom="<?= BASE_URL . $mainImage ?>">
                </div>
              </div>

              <div class="product-thumbnails">
                <div class="swiper product-thumbnails-slider init-swiper">
                  <script type="application/json" class="swiper-config">
                    {
                      "loop": false,
                      "speed": 400,
                      "slidesPerView": 4,
                      "spaceBetween": 10,
                      "navigation": {
                        "nextEl": ".swiper-button-next",
                        "prevEl": ".swiper-button-prev"
                      },
                      "breakpoints": {
                        "320": {"slidesPerView": 3},
                        "576": {"slidesPerView": 4}
                      }
                    }
                  </script>
                  <div class="swiper-wrapper">
                    <?php foreach ($producto['imagenes'] as $index => $img): ?>
                      <div class="swiper-slide thumbnail-item <?= $index===0 ? 'active' : '' ?>" data-image="<?= BASE_URL . $img ?>">
                        <img src="<?= BASE_URL . $img ?>" alt="Thumbnail" class="img-fluid">
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product Info -->
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
            <div class="product-info">
              <div class="product-meta mb-2">
                <span class="product-category"><?= htmlspecialchars($producto['categoria_nombre']) ?> / <?= htmlspecialchars($producto['subcategoria_nombre']) ?></span>
                <!-- Puedes agregar rating dinámico si lo tienes en DB -->
              </div>

              <h1 class="product-title"><?= htmlspecialchars($producto['nombre']) ?></h1>

              <div class="product-price-container mb-4">
                <span class="current-price">$<?= number_format($producto['precio'],2) ?></span>
                <!-- Puedes agregar original price y descuento si aplica -->
              </div>

              <div class="product-short-description mb-4">
                <p><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
              </div>
              
              <!-- Stock Availability -->
              <div class="product-availability mb-4">
                  <?php if($producto['stock'] > 0): ?>
                      <i class="bi bi-check-circle-fill text-success"></i>
                      <span>En stock</span>
                      <span class="stock-count">(<?= $producto['stock'] ?> items disponibles)</span>
                  <?php else: ?>
                      <i class="bi bi-x-circle-fill text-danger"></i>
                      <span>Agotado</span>
                  <?php endif; ?>
              </div>

              <!-- Quantity Selector y Add to Cart -->
              <form action="cart.php" method="post" class="mb-4">
                  <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

                  <div class="product-quantity mb-3">
                      <h6 class="option-title">Cantidad:</h6>
                      <input type="number" 
                            name="cantidad" 
                            value="1" 
                            min="1" 
                            max="<?= $producto['stock'] ?>" 
                            class="form-control" 
                            style="width:100px;"
                            <?= $producto['stock'] == 0 ? 'disabled' : '' ?>>
                  </div>

                  <button type="submit" class="btn btn-primary" <?= $producto['stock'] == 0 ? 'disabled' : '' ?>>
                      <i class="bi bi-cart-plus"></i> Agregar al carrito
                  </button>
              </form>

              <!-- Additional Info -->
              <div class="additional-info mt-4">
                <div class="info-item">
                  <i class="bi bi-truck"></i>
                  <span>Envío gratis en pedidos mayores a $50</span>
                </div>
                <div class="info-item">
                  <i class="bi bi-arrow-repeat"></i>
                  <span>Política de devolución de 30 días</span>
                </div>
                <div class="info-item">
                  <i class="bi bi-shield-check"></i>
                  <span>Garantía de 2 años</span>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- /Product Details Section -->

  </main>

  <!-- Footer -->
  <?php include_once PATH_LAYOUTS . 'footer.php'?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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