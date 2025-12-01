<?php require_once __DIR__ . '/../../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . 'config.php';?>

<?php
session_start();

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login Register - eStore Bootstrap Template</title>
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

<body class="login-register-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS .'header.php';?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Login</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="<?= BASE_URL ?>.php">Home</a></li>
            <li class="current">Login</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Login Register Section -->
    <section id="login-register" class="login-register section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="login-register-wraper">

              <!-- Tab Navigation -->
              <ul class="nav nav-tabs nav-tabs-bordered justify-content-center mb-4" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login-register-login-form" type="button" role="tab" aria-selected="true">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#login-register-registration-form" type="button" role="tab" aria-selected="false">
                    <i class="bi bi-person-plus me-1"></i>Register
                  </button>
                </li>
              </ul>

              <!-- Tab Content -->
              <div class="tab-content">

                <!-- Login Form -->
                <form action="../controller/UsuarioController.php?action=login" method="POST">
                  <div class="mb-4">
                    <label for="login-register-login-email" class="form-label">Email address</label>
                    <input type="email" class="form-control" 
                          id="login-register-login-email" 
                          name="correo" 
                          required>
                  </div>

                  <div class="mb-4">
                    <label for="login-register-login-password" class="form-label">Password</label>
                    <input type="password" class="form-control" 
                          id="login-register-login-password" 
                          name="password"
                          required>
                  </div>

                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="login-register-remember-me">
                      <label class="form-check-label" for="login-register-remember-me">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                  </div>

                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                  </div>
                </form>


                <!-- Registration Form -->
                <div class="tab-pane fade" id="login-register-registration-form" role="tabpanel">
                  <form action="../controller/UsuarioController.php?action=registrar" method="POST">
                    <div class="row g-3">

                      <div class="col-sm-6">
                        <div class="mb-4">
                          <label class="form-label">First name</label>
                          <input type="text" class="form-control" name="nombre" required>
                        </div>
                      </div>

                      <div class="col-sm-6">
                        <div class="mb-4">
                          <label class="form-label">Last name</label>
                          <input type="text" class="form-control" name="apellido" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="mb-4">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control" name="correo" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="mb-4">
                          <label class="form-label">Teléfono</label>
                          <input type="text" class="form-control" name="telefono" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="mb-4">
                          <label class="form-label">Password</label>
                          <input type="password" class="form-control" name="password" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="mb-4">
                          <label class="form-label">Confirm password</label>
                          <input type="password" class="form-control" name="password_confirm" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary btn-lg">Create Account</button>
                        </div>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Login Register Section -->

  </main>

  <!-- Footer -->
  <?php include_once PATH_LAYOUTS .'footer.php';?>

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