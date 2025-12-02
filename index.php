<?php
// Incluir configuración y autoload
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/autoload.php';

// Aquí ya puedes cargar tu layout, header, etc.
include_once PATH_LAYOUTS . 'header.php';
?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Lenz E-Commerce</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/drift-zoom/drift-basic.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eStore
  * Template URL: https://bootstrapmade.com/estore-bootstrap-ecommerce-template/
  * Updated: Apr 26 2025 with Bootstrap v5.3.5
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <main class="main">

    <!-- Hero Section -->
    <section class="ecommerce-hero-1 hero section" id="hero">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 content-col" data-aos="fade-right" data-aos-delay="100">
            <div class="content">

              <h1>Descubre la <span>Calidad</span> de Lenz en tu Cocina</h1>
              <p>Con Lenz, cada preparación se convierte en un momento especial. Descubre utensilios de alta calidad que cuidan tu salud, optimizan tu tiempo y elevan el estilo de tu hogar.</p>

              <div class="hero-cta">
                <a href="<?= BASE_URL ?>src/view/category.php" class="btn btn-shop">Ver Colección <i class="bi bi-arrow-right"></i></a>
              </div>
              
            </div>
          </div>
          <div class="col-lg-6 image-col" data-aos="fade-left" data-aos-delay="200">
            <div class="hero-image">

              <img src="assets/img/product/product-f-9.webp" alt="Fashion Product" class="main-product" loading="lazy">
              
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- Best Sellers Section -->
    <section id="best-sellers" class="best-sellers section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Más Vendidos</h2>
      </div><!-- End Section Title -->

      <div id = "best-sellers" class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <!-- Product 1 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-1.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="assets/img/product/product-1-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-tags">
                  <span class="badge bg-accent">New</span>
                </div>
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="product-details.html">Lorem ipsum dolor sit amet</a></h3>
                <div class="product-price">
                  <span class="current-price">$89.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <span class="rating-count">(42)</span>
                </div>
                <button class="btn btn-add-to-cart">
                  <i class="bi bi-bag-plus me-2"></i>Add to Cart
                </button>
              </div>
            </div>
          </div><!-- End Product 1 -->

          <!-- Product 2 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="150">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-4.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="assets/img/product/product-4-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-tags">
                  <span class="badge bg-sale">Sale</span>
                </div>
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="product-details.html">Consectetur adipiscing elit</a></h3>
                <div class="product-price">
                  <span class="current-price">$64.99</span>
                  <span class="original-price">$79.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <span class="rating-count">(28)</span>
                </div>
                <button class="btn btn-add-to-cart">
                  <i class="bi bi-bag-plus me-2"></i>Add to Cart
                </button>
              </div>
            </div>
          </div><!-- End Product 2 -->

          <!-- Product 3 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-7.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="assets/img/product/product-7-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="product-details.html">Sed do eiusmod tempor incididunt</a></h3>
                <div class="product-price">
                  <span class="current-price">$119.00</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <span class="rating-count">(56)</span>
                </div>
                <button class="btn btn-add-to-cart">
                  <i class="bi bi-bag-plus me-2"></i>Add to Cart
                </button>
              </div>
            </div>
          </div><!-- End Product 3 -->

          <!-- Product 4 -->
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="250">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-12.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                <img src="assets/img/product/product-12-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                <div class="product-tags">
                  <span class="badge bg-sold-out">Sold Out</span>
                </div>
                <div class="product-actions">
                  <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                    <i class="bi bi-heart"></i>
                  </button>
                  <button class="btn-quickview" type="button" aria-label="Quick view">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>
              <div class="product-info">
                <h3 class="product-title"><a href="product-details.html">Ut labore et dolore magna aliqua</a></h3>
                <div class="product-price">
                  <span class="current-price">$75.50</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                  <span class="rating-count">(15)</span>
                </div>
                <button class="btn btn-add-to-cart btn-disabled" disabled="">
                  <i class="bi bi-bag-plus me-2"></i>Sold Out
                </button>
              </div>
            </div>
          </div><!-- End Product 4 -->
        </div>

      </div>

    </section><!-- /Best Sellers Section -->

    <!-- Product List Section -->
    <section id="product-list" class="product-list section">

      <div class="container isotope-layout" data-aos="fade-up" data-aos-delay="100" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <div class="row">
          <div class="col-12">
            <div class="product-filters isotope-filters mb-5 d-flex justify-content-center" data-aos="fade-up">
              <ul class="d-flex flex-wrap gap-2 list-unstyled">
                <li class="filter-active" data-filter="*">All</li>
                <li data-filter=".filter-clothing">Clothing</li>
                <li data-filter=".filter-accessories">Accessories</li>
                <li data-filter=".filter-electronics">Electronics</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row product-container isotope-container" data-aos="fade-up" data-aos-delay="200">

          <!-- Product Item 1 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">Sale</span>
                <img src="assets/img/product/product-11.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-11-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Lorem ipsum dolor sit amet</a></h5>
                <div class="product-price">
                  <span class="current-price">$89.99</span>
                  <span class="old-price">$129.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <span>(24)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 2 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-9.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-9-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Consectetur adipiscing elit</a></h5>
                <div class="product-price">
                  <span class="current-price">$249.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <span>(18)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 3 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">New</span>
                <img src="assets/img/product/product-3.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-3-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Sed do eiusmod tempor</a></h5>
                <div class="product-price">
                  <span class="current-price">$59.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <i class="bi bi-star"></i>
                  <span>(7)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 4 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-4.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-4-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Incididunt ut labore et dolore</a></h5>
                <div class="product-price">
                  <span class="current-price">$79.99</span>
                  <span class="old-price">$99.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <span>(32)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 5 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">Sale</span>
                <img src="assets/img/product/product-5.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-5-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Magna aliqua ut enim ad minim</a></h5>
                <div class="product-price">
                  <span class="current-price">$199.99</span>
                  <span class="old-price">$249.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <i class="bi bi-star"></i>
                  <span>(15)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 6 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-6.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-6-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Veniam quis nostrud exercitation</a></h5>
                <div class="product-price">
                  <span class="current-price">$45.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                  <span>(21)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 7 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
            <div class="product-card">
              <div class="product-image">
                <span class="badge">New</span>
                <img src="assets/img/product/product-7.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-7-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Ullamco laboris nisi ut aliquip</a></h5>
                <div class="product-price">
                  <span class="current-price">$69.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <i class="bi bi-star"></i>
                  <span>(11)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

          <!-- Product Item 8 -->
          <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
            <div class="product-card">
              <div class="product-image">
                <img src="assets/img/product/product-8.webp" alt="Product" class="img-fluid main-img">
                <img src="assets/img/product/product-8-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                <div class="product-overlay">
                  <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                  <div class="product-actions">
                    <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                    <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
              </div>
              <div class="product-info">
                <h5 class="product-title"><a href="product-details.html">Ex ea commodo consequat</a></h5>
                <div class="product-price">
                  <span class="current-price">$159.99</span>
                </div>
                <div class="product-rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <span>(29)</span>
                </div>
              </div>
            </div>
          </div><!-- End Product Item -->

        </div>

        <div class="text-center mt-5" data-aos="fade-up">
          <a href="<?= BASE_URL ?>src/view/category.php" class="view-all-btn">Ver todos los productos <i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </section><!-- /Product List Section -->

  </main>

  <!-- ======= Footer ======= -->
  <?php include_once PATH_LAYOUTS . 'footer.php'; ?>
  <!-- End Footer -->

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/drift-zoom/Drift.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>