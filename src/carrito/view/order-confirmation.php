<?php require_once __DIR__ . '/../../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . "config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Order Confirmation - eStore Bootstrap Template</title>
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

<body class="order-confirmation-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS . 'header.php'; ?>
  <!-- End Header -->

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Order Confirmation</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Order Confirmation</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Order Confirmation Section -->
    <section id="order-confirmation" class="order-confirmation section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="order-confirmation-1">
          <div class="confirmation-header text-center" data-aos="fade-up">
            <div class="success-icon mb-4">
              <i class="bi bi-check-circle-fill"></i>
            </div>
            <h2>Order Placed Successfully!</h2>
            <p class="lead">Thank you for your purchase. We've received your order and are processing it now.</p>
            <div class="order-number mt-3 mb-4">
              <span>Order #</span>
              <strong>ORD-7853294</strong>
              <span class="mx-2">•</span>
              <span>February 26, 2025</span>
            </div>
          </div>

          <div class="order-details p-4 mb-4" data-aos="fade-up" data-aos-delay="150">
            <div class="row">
              <div class="col-md-6 mb-4 mb-md-0">
                <h4>Shipping Information</h4>
                <address class="mt-3">
                  <strong>Alex Johnson</strong><br>
                  1234 Cedar Avenue<br>
                  Portland, OR 97205<br>
                  United States<br>
                  <i class="bi bi-telephone-fill me-1 text-muted small"></i> (503) 555-7890
                </address>
                <div class="mt-3">
                  <span class="shipping-method">
                    <i class="bi bi-truck me-2"></i>Standard Shipping (3-5 business days)
                  </span>
                </div>
              </div>
              <div class="col-md-6">
                <h4>Payment Information</h4>
                <div class="payment-info mt-3">
                  <div class="payment-method mb-2">
                    <i class="bi bi-credit-card me-2"></i>
                    <span>Visa ending in 4832</span>
                  </div>
                  <div class="billing-address">
                    <strong>Billing Address:</strong> Same as shipping
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="order-summary mb-4" data-aos="fade-up" data-aos-delay="200">
            <h4>Order Summary</h4>
            <div class="order-items mt-3">
              <div class="item-row d-flex">
                <div class="item-image">
                  <img src="assets/img/product/product-1.webp" alt="Product" class="img-fluid" loading="lazy">
                </div>
                <div class="item-details">
                  <h5>Minimalist Wristwatch</h5>
                  <p class="text-muted">Color: Black / Size: Medium</p>
                  <div class="quantity-price d-flex justify-content-between">
                    <span>Qty: 1</span>
                    <span class="price">$129.99</span>
                  </div>
                </div>
              </div>
              <div class="item-row d-flex">
                <div class="item-image">
                  <img src="assets/img/product/product-3.webp" alt="Product" class="img-fluid" loading="lazy">
                </div>
                <div class="item-details">
                  <h5>Premium Leather Wallet</h5>
                  <p class="text-muted">Color: Brown</p>
                  <div class="quantity-price d-flex justify-content-between">
                    <span>Qty: 1</span>
                    <span class="price">$49.99</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="order-totals mt-4">
              <div class="d-flex justify-content-between py-2">
                <span>Subtotal</span>
                <span>$179.98</span>
              </div>
              <div class="d-flex justify-content-between py-2">
                <span>Shipping</span>
                <span>$5.99</span>
              </div>
              <div class="d-flex justify-content-between py-2">
                <span>Tax</span>
                <span>$17.99</span>
              </div>
              <div class="d-flex justify-content-between py-2 total-row">
                <strong>Total</strong>
                <strong>$203.96</strong>
              </div>
            </div>
          </div>

          <div class="next-steps text-center p-4" data-aos="fade-up" data-aos-delay="250">
            <h4>What's Next?</h4>
            <p>You'll receive an email confirmation shortly at <strong>alex.johnson@example.com</strong></p>
            <div class="tracking-info mb-4">
              <i class="bi bi-envelope me-2"></i>We'll send tracking information once your order ships
            </div>
            <div class="action-buttons">
              <a href="#" class="btn btn-primary me-3 mb-2 mb-md-0">
                <i class="bi bi-bag me-2"></i>Continue Shopping
              </a>
              <a href="#" class="btn btn-outline-primary">
                <i class="bi bi-person me-2"></i>View Order History
              </a>
            </div>
          </div>

          <div class="help-contact text-center mt-5" data-aos="fade-up" data-aos-delay="300">
            <p>Need help with your order? <a href="support.html">Contact our support team</a></p>
          </div>
        </div>

      </div>

    </section><!-- /Order Confirmation Section -->

  </main>

  <!-- ======= Footer ======= -->
  <?php include_once PATH_LAYOUTS . 'footer.php'; ?>
  <!-- End Footer -->

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