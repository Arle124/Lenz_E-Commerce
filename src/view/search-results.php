<?php require_once __DIR__ . '/../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Search Results - eStore Bootstrap Template</title>
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

  <!-- =======================================================
  * Template Name: eStore
  * Template URL: https://bootstrapmade.com/estore-bootstrap-ecommerce-template/
  * Updated: Apr 26 2025 with Bootstrap v5.3.5
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="search-results-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS . 'header.php'?>

  <main class="main">

    <!-- Search Results Header Section -->
    <section id="search-results-header" class="search-results-header section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="search-results-header">
          <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
              <div class="results-count" data-aos="fade-right" data-aos-delay="200">
                <h2>Search Results</h2>
                <p>We found <span class="results-number">24</span> results for <span class="search-term">"Lorem ipsum"</span></p>
              </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
              <form method="post" class="search-form">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search..." name="search" value="Lorem ipsum" required="">
                  <button class="btn search-btn" type="submit">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="search-filters mt-4" data-aos="fade-up" data-aos-delay="400">
            <div class="row">
              <div class="col-lg-8">
                <div class="filter-tags">
                  <span class="filter-label">Filters:</span>
                  <div class="tags-wrapper">
                    <span class="filter-tag">
                      Category: Blog
                      <i class="bi bi-x-circle"></i>
                    </span>
                    <span class="filter-tag">
                      Date: Last Month
                      <i class="bi bi-x-circle"></i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="sort-options">
                  <label for="sort-select" class="me-2">Sort by:</label>
                  <select id="sort-select" class="form-select form-select-sm d-inline-block w-auto">
                    <option value="relevance">Relevance</option>
                    <option value="date-desc">Newest First</option>
                    <option value="date-asc">Oldest First</option>
                    <option value="title-asc">Title A-Z</option>
                    <option value="title-desc">Title Z-A</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Search Results Header Section -->

    <!-- Search Product List Section -->
    <section id="search-product-list" class="search-product-list section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
          <!-- Product 1 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in">
              <div class="product-image">
                <img src="assets/img/product/product-f-1.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-f-2.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product-details">
                <div class="product-category">Women's Fashion</div>
                <h4 class="product-title"><a href="product-details.html">Tempor Incididunt</a></h4>
                <div class="product-meta">
                  <div class="product-price">$129.00</div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.8 <span>(42)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product 2 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in" data-aos-delay="100">
              <div class="product-image">
                <img src="assets/img/product/product-m-1.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-m-2.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="product-badge new">New</div>
              </div>
              <div class="product-details">
                <div class="product-category">Men's Collection</div>
                <h4 class="product-title"><a href="product-details.html">Elit Consectetur</a></h4>
                <div class="product-meta">
                  <div class="product-price">$95.00</div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.6 <span>(28)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product 3 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in" data-aos-delay="200">
              <div class="product-image">
                <img src="assets/img/product/product-f-3.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-f-4.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="product-badge sale">-25%</div>
              </div>
              <div class="product-details">
                <div class="product-category">Accessories</div>
                <h4 class="product-title"><a href="product-details.html">Adipiscing Magna</a></h4>
                <div class="product-meta">
                  <div class="product-price">
                    $75.00
                    <span class="original-price">$99.00</span>
                  </div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.9 <span>(56)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product 4 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in" data-aos-delay="300">
              <div class="product-image">
                <img src="assets/img/product/product-m-3.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-m-4.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product-details">
                <div class="product-category">Footwear</div>
                <h4 class="product-title"><a href="product-details.html">Labore Dolore</a></h4>
                <div class="product-meta">
                  <div class="product-price">$145.00</div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.7 <span>(35)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product 5 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in" data-aos-delay="400">
              <div class="product-image">
                <img src="assets/img/product/product-f-5.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-f-6.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product-details">
                <div class="product-category">Men's Fashion</div>
                <h4 class="product-title"><a href="product-details.html">Magna Aliqua</a></h4>
                <div class="product-meta">
                  <div class="product-price">$89.00</div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.5 <span>(23)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product 6 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in" data-aos-delay="500">
              <div class="product-image">
                <img src="assets/img/product/product-m-5.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-m-6.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="product-badge sale">-15%</div>
              </div>
              <div class="product-details">
                <div class="product-category">Women's Fashion</div>
                <h4 class="product-title"><a href="product-details.html">Eiusmod Tempor</a></h4>
                <div class="product-meta">
                  <div class="product-price">
                    $110.00
                    <span class="original-price">$129.00</span>
                  </div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.8 <span>(47)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product 7 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in" data-aos-delay="600">
              <div class="product-image">
                <img src="assets/img/product/product-f-7.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-f-8.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product-details">
                <div class="product-category">Accessories</div>
                <h4 class="product-title"><a href="product-details.html">Incididunt Labore</a></h4>
                <div class="product-meta">
                  <div class="product-price">$55.00</div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.6 <span>(31)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product 8 -->
          <div class="col-6 col-lg-3">
            <div class="product-card" data-aos="zoom-in" data-aos-delay="700">
              <div class="product-image">
                <img src="assets/img/product/product-m-7.webp" class="main-image img-fluid" alt="Product">
                <img src="assets/img/product/product-m-8.webp" class="hover-image img-fluid" alt="Product Variant">
                <div class="product-overlay">
                  <div class="product-actions">
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Quick View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="action-btn" data-bs-toggle="tooltip" title="Add to Cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </div>
                </div>
                <div class="product-badge new">New</div>
              </div>
              <div class="product-details">
                <div class="product-category">Men's Fashion</div>
                <h4 class="product-title"><a href="product-details.html">Aliqua Magna</a></h4>
                <div class="product-meta">
                  <div class="product-price">$79.00</div>
                  <div class="product-rating">
                    <i class="bi bi-star-fill"></i>
                    4.7 <span>(39)</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Search Product List Section -->

    <!-- Category Pagination Section -->
    <section id="category-pagination" class="category-pagination section">

      <div class="container">
        <nav class="d-flex justify-content-center" aria-label="Page navigation">
          <ul>
            <li>
              <a href="#" aria-label="Previous page">
                <i class="bi bi-arrow-left"></i>
                <span class="d-none d-sm-inline">Previous</span>
              </a>
            </li>

            <li><a href="#" class="active">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li class="ellipsis">...</li>
            <li><a href="#">8</a></li>
            <li><a href="#">9</a></li>
            <li><a href="#">10</a></li>

            <li>
              <a href="#" aria-label="Next page">
                <span class="d-none d-sm-inline">Next</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>

    </section><!-- /Category Pagination Section -->

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