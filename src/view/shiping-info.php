<?php require_once __DIR__ . '/../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . "config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Shiping Info - eStore Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="<?=BASE_URL?>assets/img/favicon.png" rel="icon">
  <link href="<?=BASE_URL?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=BASE_URL?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=BASE_URL?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=BASE_URL?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?=BASE_URL?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?=BASE_URL?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?=BASE_URL?>assets/vendor/drift-zoom/drift-basic.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?=BASE_URL?>assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eStore
  * Template URL: https://bootstrapmade.com/estore-bootstrap-ecommerce-template/
  * Updated: Apr 26 2025 with Bootstrap v5.3.5
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="shiping-info-page">

  <!-- Header -->
  <?php include PATH_LAYOUTS . 'header.php'; ?>
  
  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Shiping Info</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Shiping Info</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Shipping Info Section -->
    <section id="shipping-info" class="shipping-info section">

      <div class="container" data-aos="fade-up">

        <!-- Delivery Options -->
        <div class="shipping-info-header" data-aos="fade-up">
          <h2>Our Shipping Services</h2>
          <p>Choose the perfect shipping method for your needs with our reliable delivery options</p>
        </div>

        <div class="delivery-options" data-aos="fade-up" data-aos-delay="100">
          <div class="delivery-grid">
            <div class="delivery-option" data-aos="zoom-in" data-aos-delay="100">
              <div class="option-content">
                <div class="icon-wrapper">
                  <i class="bi bi-lightning-charge"></i>
                </div>
                <div class="option-details">
                  <h4>Express Delivery</h4>
                  <p class="time"><i class="bi bi-clock"></i> 1-2 Business Days</p>
                  <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fastest delivery option for urgent orders.</p>
                  <div class="price-tag">From $12.99</div>
                </div>
              </div>
            </div>

            <div class="delivery-option featured" data-aos="zoom-in" data-aos-delay="200">
              <div class="option-content">
                <div class="icon-wrapper">
                  <i class="bi bi-box-seam"></i>
                </div>
                <div class="option-details">
                  <h4>Standard Shipping</h4>
                  <p class="time"><i class="bi bi-clock"></i> 3-5 Business Days</p>
                  <p class="description">Proin dapibus nisl ornare diam varius tempus. Most popular shipping method.</p>
                  <div class="price-tag">From $5.99</div>
                </div>
              </div>
            </div>

            <div class="delivery-option" data-aos="zoom-in" data-aos-delay="300">
              <div class="option-content">
                <div class="icon-wrapper">
                  <i class="bi bi-geo"></i>
                </div>
                <div class="option-details">
                  <h4>Local Delivery</h4>
                  <p class="time"><i class="bi bi-clock"></i> 2-3 Business Days</p>
                  <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                  <div class="price-tag">From $7.99</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Shipping Features -->
        <div class="shipping-features" data-aos="fade-up" data-aos-delay="200">
          <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
              <div class="feature-item">
                <i class="bi bi-shield-check"></i>
                <h5>Secure Packaging</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla mauris dolor.</p>
              </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
              <div class="feature-item">
                <i class="bi bi-globe"></i>
                <h5>Global Coverage</h5>
                <p>Praesent venenatis metus at tortor pulvinar varius dolor sit magna.</p>
              </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
              <div class="feature-item">
                <i class="bi bi-arrow-repeat"></i>
                <h5>Free Returns</h5>
                <p>Sed cursus ante dapibus diam. Sed nisi nulla quis sem at nibh elementum.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- International Shipping -->
        <div class="international-shipping" data-aos="fade-up" data-aos-delay="300">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="content-box">
                <h3>International Shipping</h3>
                <p class="lead">We deliver to over 100 countries worldwide</p>
                <ul class="shipping-benefits">
                  <li>
                    <i class="bi bi-check2-circle"></i>
                    <span>Reliable tracking system</span>
                  </li>
                  <li>
                    <i class="bi bi-check2-circle"></i>
                    <span>Customs clearance assistance</span>
                  </li>
                  <li>
                    <i class="bi bi-check2-circle"></i>
                    <span>Express worldwide delivery</span>
                  </li>
                  <li>
                    <i class="bi bi-check2-circle"></i>
                    <span>Competitive international rates</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-cards">
                <div class="info-card" data-aos="fade-left" data-aos-delay="100">
                  <i class="bi bi-clock-history"></i>
                  <h5>Delivery Time</h5>
                  <p>5-10 business days for international shipping</p>
                </div>
                <div class="info-card" data-aos="fade-left" data-aos-delay="200">
                  <i class="bi bi-cash-coin"></i>
                  <h5>Shipping Cost</h5>
                  <p>Calculated based on weight and destination</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section" data-aos="fade-up" data-aos-delay="400">
          <h3>Frequently Asked Questions</h3>
          <div class="faq-grid">
            <div class="faq-item">
              <h3>
                When will my order arrive?
                <i class="bi bi-plus-circle faq-toggle"></i>
              </h3>
              <div class="faq-answer">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Delivery times vary based on your chosen shipping method and location.</p>
              </div>
            </div>

            <div class="faq-item">
              <h3>
                Do you ship to P.O. boxes?
                <i class="bi bi-plus-circle faq-toggle"></i>
              </h3>
              <div class="faq-answer">
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Yes, we do ship to P.O. boxes for standard shipping only.</p>
              </div>
            </div>

            <div class="faq-item">
              <h3>
                What about shipping insurance?
                <i class="bi bi-plus-circle faq-toggle"></i>
              </h3>
              <div class="faq-answer">
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. All orders over $100 include free shipping insurance.</p>
              </div>
            </div>

            <div class="faq-item">
              <h3>
                Can I change my shipping address?
                <i class="bi bi-plus-circle faq-toggle"></i>
              </h3>
              <div class="faq-answer">
                <p>Excepteur sint occaecat cupidatat non proident. You can change your shipping address before your order is processed.</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Shipping Info Section -->

  </main>

  <!-- Footer -->
  <?php include PATH_LAYOUTS . 'footer.php'; ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?=BASE_URL?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/aos/aos.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/drift-zoom/Drift.min.js"></script>
  <script src="<?=BASE_URL?>assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="<?=BASE_URL?>assets/js/main.js"></script>

</body>

</html>