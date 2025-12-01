<?php require_once __DIR__ . '/../../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . "config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Support - eStore Bootstrap Template</title>
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

<body class="support-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS . 'header.php'; ?>
  <!-- End Header -->

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Support</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Support</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Support Section -->
    <section id="support" class="support section">

      <div class="container" data-aos="fade-up">

        <!-- Support Header -->
        <div class="support-header" data-aos="fade-up">
          <div class="header-content">
            <h2>Help &amp; Support Center</h2>
            <p>Find answers, tutorials, and help from our support team</p>
          </div>
        </div>

        <!-- Quick Support Actions -->
        <div class="quick-support" data-aos="fade-up" data-aos-delay="100">
          <div class="action-item live-chat">
            <div class="action-content">
              <i class="bi bi-chat-text"></i>
              <h4>Live Chat</h4>
              <p>Chat with our support team</p>
              <a href="#" class="action-button">Start Chat</a>
            </div>
          </div>

          <div class="action-item phone">
            <div class="action-content">
              <i class="bi bi-telephone"></i>
              <h4>Call Us</h4>
              <p>24/7 support line</p>
              <a href="tel:1234567890" class="action-button">+1 (555) 123-4567</a>
            </div>
          </div>

          <div class="action-item email">
            <div class="action-content">
              <i class="bi bi-envelope"></i>
              <h4>Email Support</h4>
              <p>Get email support</p>
              <a href="#" class="action-button">Send Email</a>
            </div>
          </div>
        </div>

        <!-- Help Topics -->
        <div class="help-categories" data-aos="fade-up" data-aos-delay="200">
          <h3>Popular Help Topics</h3>
          <div class="category-cards">
            <a href="#" class="category-card" data-aos="zoom-in" data-aos-delay="100">
              <span class="icon"><i class="bi bi-box-seam"></i></span>
              <h5>Orders &amp; Shipping</h5>
              <ul>
                <li>Track your order</li>
                <li>Shipping methods</li>
                <li>Returns &amp; exchanges</li>
              </ul>
              <span class="arrow"><i class="bi bi-arrow-right"></i></span>
            </a>

            <a href="#" class="category-card" data-aos="zoom-in" data-aos-delay="200">
              <span class="icon"><i class="bi bi-wallet2"></i></span>
              <h5>Billing &amp; Payments</h5>
              <ul>
                <li>Payment methods</li>
                <li>Invoices</li>
                <li>Refund status</li>
              </ul>
              <span class="arrow"><i class="bi bi-arrow-right"></i></span>
            </a>

            <a href="#" class="category-card" data-aos="zoom-in" data-aos-delay="300">
              <span class="icon"><i class="bi bi-person-gear"></i></span>
              <h5>Account Settings</h5>
              <ul>
                <li>Profile management</li>
                <li>Password reset</li>
                <li>Privacy settings</li>
              </ul>
              <span class="arrow"><i class="bi bi-arrow-right"></i></span>
            </a>

            <a href="#" class="category-card" data-aos="zoom-in" data-aos-delay="400">
              <span class="icon"><i class="bi bi-shield-check"></i></span>
              <h5>Security</h5>
              <ul>
                <li>Account security</li>
                <li>Two-factor auth</li>
                <li>Privacy policy</li>
              </ul>
              <span class="arrow"><i class="bi bi-arrow-right"></i></span>
            </a>
          </div>
        </div>

        <!-- Self Help -->
        <div class="self-help" data-aos="fade-up" data-aos-delay="300">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="content-box">
                <h3>Self-Help Resources</h3>
                <p class="subtitle">Find answers quickly with our comprehensive resources</p>
                <div class="resource-links">
                  <a href="#" class="resource-link">
                    <i class="bi bi-play-circle"></i>
                    <div class="link-content">
                      <h6>Video Tutorials</h6>
                      <p>Step-by-step video guides</p>
                    </div>
                  </a>
                  <a href="#" class="resource-link">
                    <i class="bi bi-file-text"></i>
                    <div class="link-content">
                      <h6>User Guides</h6>
                      <p>Detailed documentation</p>
                    </div>
                  </a>
                  <a href="#" class="resource-link">
                    <i class="bi bi-book"></i>
                    <div class="link-content">
                      <h6>Knowledge Base</h6>
                      <p>Articles and tutorials</p>
                    </div>
                  </a>
                  <a href="#" class="resource-link">
                    <i class="bi bi-tools"></i>
                    <div class="link-content">
                      <h6>Troubleshooting</h6>
                      <p>Common issues and fixes</p>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="faq-section">
                <h4>Common Questions</h4>
                <div class="faq-list">
                  <div class="faq-item">
                    <h3>
                      How do I track my order?
                      <i class="bi bi-plus faq-toggle"></i>
                    </h3>
                    <div class="faq-answer">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. You can track your order using your order number in the tracking section.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <h3>
                      Can I change my shipping address?
                      <i class="bi bi-plus faq-toggle"></i>
                    </h3>
                    <div class="faq-answer">
                      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Contact support to change your shipping address before the item ships.</p>
                    </div>
                  </div>

                  <div class="faq-item">
                    <h3>
                      What payment methods do you accept?
                      <i class="bi bi-plus faq-toggle"></i>
                    </h3>
                    <div class="faq-answer">
                      <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. We accept all major credit cards and PayPal.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Support Section -->

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