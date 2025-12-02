<?php 
require_once __DIR__ . '/../../config/autoload.php';
require_once PATH_CONFIG . 'config.php';

session_start();

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

// Determinar tab activo según URL
$activeTab = 'login';
if (isset($_GET['tab']) && $_GET['tab'] === 'register') {
    $activeTab = 'register';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Register - eStore</title>

  <!-- Bootstrap CSS -->
  <link href="<?= BASE_URL ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>assets/css/main.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS específico login/register -->
  
</head>
<body class="login-register-page">

<?php include_once PATH_LAYOUTS . 'header.php'; ?>

<main class="main">

  <section id="login-register" class="login-register section">
    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="login-register-wraper">

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered justify-content-center mb-4" role="tablist">
              <li class="nav-item">
                <button class="nav-link <?= $activeTab === 'login' ? 'active' : '' ?>" 
                        data-bs-toggle="tab" data-bs-target="#login-register-login-form" type="button">
                  Login
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link <?= $activeTab === 'register' ? 'active' : '' ?>" 
                        data-bs-toggle="tab" data-bs-target="#login-register-registration-form" type="button">
                  Register
                </button>
              </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">

              <!-- Login Form -->
              <div class="tab-pane fade <?= $activeTab === 'login' ? 'show active' : '' ?>" id="login-register-login-form">
                <form action="../controller/UsuarioController.php?action=login" method="POST">
                  <div class="mb-4 password-wrapper">
                    <input type="email" class="form-control" name="correo" placeholder="Email" required>
                  </div>

                  <div class="mb-4 password-wrapper">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <i class="bi bi-eye password-toggle"></i>
                  </div>

                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                  </div>
                </form>
              </div>

              <!-- Registration Form -->
              <div class="tab-pane fade <?= $activeTab === 'register' ? 'show active' : '' ?>" id="login-register-registration-form">
                <form action="../controller/UsuarioController.php?action=registrar" method="POST">
                  <div class="mb-3">
                    <input type="text" class="form-control" name="nombre" placeholder="First Name" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" name="apellido" placeholder="Last Name" required>
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control" name="correo" placeholder="Email" required>
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" name="telefono" placeholder="Phone" required>
                  </div>

                  <div class="mb-3 password-wrapper">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <i class="bi bi-eye password-toggle"></i>
                  </div>
                  <div class="mb-3 password-wrapper">
                    <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password" required>
                    <i class="bi bi-eye password-toggle"></i>
                  </div>

                  <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
                </form>
              </div>

            </div> <!-- tab-content -->

          </div>
        </div>
      </div> <!-- row -->

    </div> <!-- container -->
  </section>

</main>

<?php include_once PATH_LAYOUTS .'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="<?= BASE_URL ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Toggle password -->
<script>
document.querySelectorAll('.password-toggle').forEach(icon => {
  icon.addEventListener('click', function() {
    const input = this.previousElementSibling;
    if (input.type === 'password') {
      input.type = 'text';
      this.classList.remove('bi-eye');
      this.classList.add('bi-eye-slash');
    } else {
      input.type = 'password';
      this.classList.remove('bi-eye-slash');
      this.classList.add('bi-eye');
    }
  });
});
</script>

</body>
</html>
