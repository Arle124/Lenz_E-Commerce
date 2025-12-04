<?php require_once __DIR__ . '/../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . "config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Contact - eStore Bootstrap Template</title>
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
  <link href="<?=BASE_URL?>/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eStore
  * Template URL: https://bootstrapmade.com/estore-bootstrap-ecommerce-template/
  * Updated: Apr 26 2025 with Bootstrap v5.3.5
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="contact-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS . 'header.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Contacto</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="<?= BASE_URL ?>index.php">Inicio</a></li>
            <li class="current">Contacto</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact 2 Section -->
    <section id="contact-2" class="contact-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Dirección</h3>
              <p>Cl. 5 #22-55, Aguachica, Cesar</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Llámanos</h3>
              <p>+57 310 381 2734</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Correo Electrónico</h3>
              <p>lenzcompanysas@gmail.com</p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="row gy-4 mt-1">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.929856219421!2d-73.6123812!3d8.309769700000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e5d857e9c36f05f%3A0xa863f4ea78271c2d!2sCl.%205%20%2322-55%2C%20Aguachica%2C%20Cesar!5e0!3m2!1ses!2sco!4v1764816648712!5m2!1ses!2sco" width="600" height="450" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div><!-- End Google Maps -->

        </div>

      </div>

    </section><!-- /Contact 2 Section -->

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