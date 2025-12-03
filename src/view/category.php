<?php require_once __DIR__ . '/../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . "config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Category - eStore Bootstrap Template</title>
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

<body class="category-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS . 'header.php'; ?>
  <!-- End Header -->

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
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Product Categories Widget -->
            <div class="product-categories-widget widget-item">

              <h3 class="widget-title">Categorías</h3>

              <ul class="category-tree list-unstyled mb-0">
                <!-- Clothing Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-clothing-subcategories" aria-expanded="false" aria-controls="categories-1-clothing-subcategories">
                    <a href="javascript:void(0)" class="category-link">Clothing</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-clothing-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Men's Wear</a></li>
                    <li><a href="#" class="subcategory-link">Women's Wear</a></li>
                    <li><a href="#" class="subcategory-link">Kids' Clothing</a></li>
                    <li><a href="#" class="subcategory-link">Accessories</a></li>
                  </ul>
                </li>

                <!-- Electronics Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-electronics-subcategories" aria-expanded="false" aria-controls="categories-1-electronics-subcategories">
                    <a href="javascript:void(0)" class="category-link">Electronics</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-electronics-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Smartphones</a></li>
                    <li><a href="#" class="subcategory-link">Laptops</a></li>
                    <li><a href="#" class="subcategory-link">Tablets</a></li>
                    <li><a href="#" class="subcategory-link">Accessories</a></li>
                  </ul>
                </li>

                <!-- Home & Kitchen Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-home-subcategories" aria-expanded="false" aria-controls="categories-1-home-subcategories">
                    <a href="javascript:void(0)" class="category-link">Home &amp; Kitchen</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-home-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Furniture</a></li>
                    <li><a href="#" class="subcategory-link">Kitchen Appliances</a></li>
                    <li><a href="#" class="subcategory-link">Home Decor</a></li>
                    <li><a href="#" class="subcategory-link">Bedding</a></li>
                  </ul>
                </li>

                <!-- Beauty & Personal Care Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-beauty-subcategories" aria-expanded="false" aria-controls="categories-1-beauty-subcategories">
                    <a href="javascript:void(0)" class="category-link">Beauty &amp; Personal Care</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-beauty-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Skincare</a></li>
                    <li><a href="#" class="subcategory-link">Makeup</a></li>
                    <li><a href="#" class="subcategory-link">Hair Care</a></li>
                    <li><a href="#" class="subcategory-link">Fragrances</a></li>
                  </ul>
                </li>

                <!-- Sports & Outdoors Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-sports-subcategories" aria-expanded="false" aria-controls="categories-1-sports-subcategories">
                    <a href="javascript:void(0)" class="category-link">Sports &amp; Outdoors</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-sports-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Fitness Equipment</a></li>
                    <li><a href="#" class="subcategory-link">Outdoor Gear</a></li>
                    <li><a href="#" class="subcategory-link">Sports Apparel</a></li>
                    <li><a href="#" class="subcategory-link">Team Sports</a></li>
                  </ul>
                </li>

                <!-- Books Category (no subcategories) -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header">
                    <a href="#" class="category-link">Books</a>
                  </div>
                </li>

                <!-- Toys & Games Category -->
                <li class="category-item">
                  <div class="d-flex justify-content-between align-items-center category-header collapsed" data-bs-toggle="collapse" data-bs-target="#categories-1-toys-subcategories" aria-expanded="false" aria-controls="categories-1-toys-subcategories">
                    <a href="javascript:void(0)" class="category-link">Toys &amp; Games</a>
                    <span class="category-toggle">
                      <i class="bi bi-chevron-down"></i>
                      <i class="bi bi-chevron-up"></i>
                    </span>
                  </div>
                  <ul id="categories-1-toys-subcategories" class="subcategory-list list-unstyled collapse ps-3 mt-2">
                    <li><a href="#" class="subcategory-link">Board Games</a></li>
                    <li><a href="#" class="subcategory-link">Puzzles</a></li>
                    <li><a href="#" class="subcategory-link">Action Figures</a></li>
                    <li><a href="#" class="subcategory-link">Educational Toys</a></li>
                  </ul>
                </li>
              </ul>

            </div><!--/Product Categories Widget -->

          </div>

        </div>

        <div class="col-lg-8">

          <!-- Category Header Section -->
          <section id="category-header" class="category-header section">

            <div class="container" data-aos="fade-up">

              <!-- Filter and Sort Options -->
              <div class="filter-container mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="row g-3">

                  <div class="col-12 col-md-6 col-lg-2">
                    <div class="filter-item">
                      <label for="priceRange" class="form-label">Rango de Precios</label>
                      <select class="form-select" id="priceRange">
                        <option selected="">Todos los precios</option>
                        <option>Menos de $25</option>
                        <option>$25 a $50</option>
                        <option>$50 a $100</option>
                        <option>$100 a $200</option>
                        <option>$200 &amp; Más</option>
                      </select>
                    </div>
                  </div>

                  <!-- Revisar como hacer esto de manera dinamica -->
                  <div class="col-12 col-md-6 col-lg-2">
                    <div class="filter-item">
                      <label for="sortBy" class="form-label">Ordenar Por</label>
                      <select class="form-select" id="sortBy">
                        <option selected="">Destacados</option>
                        <option>Precio: Menor a Mayor</option>
                        <option>Precio: Mayor a Menor</option>
                        <option>Nuevas Llegadas</option>
                      </select>
                    </div>
                  </div>

                <!-- Revisar como hacer esto de manera dinamica -->
                <div class="row mt-3">
                  <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="active-filters">
                      <span class="active-filter-label">Active Filters:</span>
                      <div class="filter-tags">

                        <!-- <span class="filter-tag">
                          Electronics <button class="filter-remove"><i class="bi bi-x"></i></button>
                        </span>
                        <span class="filter-tag">
                          $50 to $100 <button class="filter-remove"><i class="bi bi-x"></i></button>
                        </span>
                        <button class="clear-all-btn">Clear All</button> -->

                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>

          </section><!-- /Category Header Section -->

          <!-- Category Product List Section -->
          <section id="category-product-list" class="category-product-list section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
              
              <!-- Revisar como hacer esto de manera dinamica -->
              <div class="row gy-4">
                <!-- Product 1 -->
                <div class="col-lg-6">
                  <div class="product-box">
                    <div class="product-thumb">
                      <span class="product-label">New Season</span>
                      <img src="assets/img/product/product-3.webp" alt="Product Image" class="main-img" loading="lazy">
                      <div class="product-overlay">
                        <div class="product-quick-actions">
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-heart"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-arrow-repeat"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="add-to-cart-container">
                          <button type="button" class="add-to-cart-btn">Add to Cart</button>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-details">
                        <h3 class="product-title"><a href="product-details.html">Vestibulum ante ipsum primis</a></h3>
                        <div class="product-price">
                          <span>$149.99</span>
                        </div>
                      </div>
                      <div class="product-rating-container">
                        <div class="rating-stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                        </div>
                        <span class="rating-number">4.0</span>
                      </div>
                      <div class="product-color-options">
                        <span class="color-option" style="background-color: #3b82f6;"></span>
                        <span class="color-option" style="background-color: #22c55e;"></span>
                        <span class="color-option active" style="background-color: #f97316;"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Product 1 -->

                <!-- Product 2 -->
                <div class="col-lg-6">
                  <div class="product-box">
                    <div class="product-thumb">
                      <span class="product-label product-label-sale">-30%</span>
                      <img src="assets/img/product/product-6.webp" alt="Product Image" class="main-img" loading="lazy">
                      <div class="product-overlay">
                        <div class="product-quick-actions">
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-heart"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-arrow-repeat"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="add-to-cart-container">
                          <button type="button" class="add-to-cart-btn">Add to Cart</button>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-details">
                        <h3 class="product-title"><a href="product-details.html">Aliquam tincidunt mauris eu risus</a></h3>
                        <div class="product-price">
                          <span class="original">$199.99</span>
                          <span class="sale">$139.99</span>
                        </div>
                      </div>
                      <div class="product-rating-container">
                        <div class="rating-stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-half"></i>
                        </div>
                        <span class="rating-number">4.5</span>
                      </div>
                      <div class="product-color-options">
                        <span class="color-option" style="background-color: #0ea5e9;"></span>
                        <span class="color-option active" style="background-color: #111827;"></span>
                        <span class="color-option" style="background-color: #a855f7;"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Product 2 -->

                <!-- Product 3 -->
                <div class="col-lg-6">
                  <div class="product-box">
                    <div class="product-thumb">
                      <img src="assets/img/product/product-9.webp" alt="Product Image" class="main-img" loading="lazy">
                      <div class="product-overlay">
                        <div class="product-quick-actions">
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-heart"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-arrow-repeat"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="add-to-cart-container">
                          <button type="button" class="add-to-cart-btn">Add to Cart</button>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-details">
                        <h3 class="product-title"><a href="product-details.html">Cras ornare tristique elit</a></h3>
                        <div class="product-price">
                          <span>$89.50</span>
                        </div>
                      </div>
                      <div class="product-rating-container">
                        <div class="rating-stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                        </div>
                        <span class="rating-number">3.0</span>
                      </div>
                      <div class="product-color-options">
                        <span class="color-option active" style="background-color: #ef4444;"></span>
                        <span class="color-option" style="background-color: #64748b;"></span>
                        <span class="color-option" style="background-color: #eab308;"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Product 3 -->

                <!-- Product 4 -->
                <div class="col-lg-6">
                  <div class="product-box">
                    <div class="product-thumb">
                      <img src="assets/img/product/product-11.webp" alt="Product Image" class="main-img" loading="lazy">
                      <div class="product-overlay">
                        <div class="product-quick-actions">
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-heart"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-arrow-repeat"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="add-to-cart-container">
                          <button type="button" class="add-to-cart-btn">Add to Cart</button>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-details">
                        <h3 class="product-title"><a href="product-details.html">Integer vitae libero ac risus</a></h3>
                        <div class="product-price">
                          <span>$119.00</span>
                        </div>
                      </div>
                      <div class="product-rating-container">
                        <div class="rating-stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </div>
                        <span class="rating-number">5.0</span>
                      </div>
                      <div class="product-color-options">
                        <span class="color-option" style="background-color: #10b981;"></span>
                        <span class="color-option active" style="background-color: #8b5cf6;"></span>
                        <span class="color-option" style="background-color: #ec4899;"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Product 4 -->

                <!-- Product 5 -->
                <div class="col-lg-6">
                  <div class="product-box">
                    <div class="product-thumb">
                      <span class="product-label product-label-sold">Sold Out</span>
                      <img src="assets/img/product/product-2.webp" alt="Product Image" class="main-img" loading="lazy">
                      <div class="product-overlay">
                        <div class="product-quick-actions">
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-heart"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-arrow-repeat"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="add-to-cart-container">
                          <button type="button" class="add-to-cart-btn disabled">Sold Out</button>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-details">
                        <h3 class="product-title"><a href="product-details.html">Donec eu libero sit amet quam</a></h3>
                        <div class="product-price">
                          <span>$75.00</span>
                        </div>
                      </div>
                      <div class="product-rating-container">
                        <div class="rating-stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-half"></i>
                        </div>
                        <span class="rating-number">4.7</span>
                      </div>
                      <div class="product-color-options">
                        <span class="color-option active" style="background-color: #4b5563;"></span>
                        <span class="color-option" style="background-color: #e11d48;"></span>
                        <span class="color-option" style="background-color: #4f46e5;"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Product 5 -->

                <!-- Product 6 -->
                <div class="col-lg-6">
                  <div class="product-box">
                    <div class="product-thumb">
                      <span class="product-label product-label-hot">Hot</span>
                      <img src="assets/img/product/product-12.webp" alt="Product Image" class="main-img" loading="lazy">
                      <div class="product-overlay">
                        <div class="product-quick-actions">
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-heart"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-arrow-repeat"></i>
                          </button>
                          <button type="button" class="quick-action-btn">
                            <i class="bi bi-eye"></i>
                          </button>
                        </div>
                        <div class="add-to-cart-container">
                          <button type="button" class="add-to-cart-btn">Add to Cart</button>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-details">
                        <h3 class="product-title"><a href="product-details.html">Pellentesque habitant morbi tristique</a></h3>
                        <div class="product-price">
                          <span>$64.95</span>
                        </div>
                      </div>
                      <div class="product-rating-container">
                        <div class="rating-stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-half"></i>
                          <i class="bi bi-star"></i>
                        </div>
                        <span class="rating-number">3.6</span>
                      </div>
                      <div class="product-color-options">
                        <span class="color-option" style="background-color: #eab308;"></span>
                        <span class="color-option" style="background-color: #14b8a6;"></span>
                        <span class="color-option active" style="background-color: #facc15;"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Product 6 -->
              </div>

            </div>

          </section><!-- /Category Product List Section -->

          <!-- Category Pagination Section -->

          <!-- Revisar como hacer esto de manera dinamica -->
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

        </div>

      </div>
    </div>

  </main>

  <!-- ======= Footer ======= -->
  <?php include_once PATH_LAYOUTS . 'footer.php'; ?>
  <!-- End Footer -->

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