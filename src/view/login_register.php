  <?php 
  require_once __DIR__ . '/../../config/autoload.php';
  require_once __DIR__ . '/../../config/config.php';
  require_once __DIR__ . "/../../config/sesion.php";
  include_once PATH_LAYOUTS . 'header.php';

  if (isset($_SESSION['error'])) {
      echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
      unset($_SESSION['error']);
  }

  if (isset($_SESSION['success'])) {
      echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
      unset($_SESSION['success']);
  }

  // Determinar tab activo según URL
  $tab = $_GET['tab'] ?? 'login';
  $activeTab = ($tab === 'register') ? 'register' : 'login';

  // Mostrar modal roles si vienes del login y hay 2+ roles
  $mostrarModalRol = ($tab === 'rol' && !empty($_SESSION['prelogin']['roles']));
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
                  <form action="<?= BASE_URL ?>src/controller/UsuarioController.php?action=login" method="POST">
                    <input type="hidden" name="action" value="login">
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
                  <form id="registerForm"
                        action="<?= BASE_URL ?>src/controller/UsuarioController.php?action=registrar"
                        method="POST"
                        novalidate>

                    <input type="hidden" name="action" value="registrar">

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
                      <input type="text" class="form-control" name="telefono" placeholder="Phone">
                    </div>

                    <div class="mb-3 password-wrapper">
                      <input
                        id="regPassword"
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="Password"
                        required
                        minlength="8"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
                        aria-describedby="passwordHelp"
                      >
                      <i class="bi bi-eye password-toggle"></i>
                    </div>

                    <!-- Reglas -->
                    <div id="passwordBox" class="mt-2 d-none">
                      <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="progress flex-grow-1" style="height: 8px;">
                          <div id="passBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <small id="passLabel" class="fw-semibold">Débil</small>
                      </div>

                      <ul class="mb-0 ps-3" style="list-style: none; font-size:.95rem;">
                        <li id="ruleLen">❌ Mínimo 8 caracteres</li>
                        <li id="ruleUpper">❌ 1 mayúscula (A-Z)</li>
                        <li id="ruleLower">❌ 1 minúscula (a-z)</li>
                        <li id="ruleNum">❌ 1 número (0-9)</li>
                        <li id="ruleMatch">❌ Coincidir con Confirm</li>
                      </ul>
                    </div>


                    <div class="mb-3 password-wrapper">
                      <input
                        id="regConfirm"
                        type="password"
                        class="form-control"
                        name="password_confirm"
                        placeholder="Confirm Password"
                        required
                        minlength="8"
                      >
                      <i class="bi bi-eye password-toggle"></i>
                    </div>

                    <div class="d-grid">
                      <button id="btnRegister" type="submit" class="btn btn-primary btn-lg" disabled>
                        Register
                      </button>
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
  <?php if ($mostrarModalRol): ?>
    <div class="modal fade" id="modalRoles" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title">Selecciona tu rol</h5>
          </div>

          <div class="modal-body">
            <p class="mb-3">
              Hola <strong><?= htmlspecialchars($_SESSION['prelogin']['nombre'] ?? 'Usuario') ?></strong>,
              elige con qué rol deseas ingresar:
            </p>

            <form action="<?= BASE_URL ?>src/controller/UsuarioController.php" method="POST">
              <input type="hidden" name="action" value="seleccionar_rol">

              <div class="mb-3">
                <label class="form-label">Rol</label>
                <select class="form-select" name="id_rol" required>
                  <?php foreach ($_SESSION['prelogin']['roles'] as $rol): ?>
                    <option value="<?= (int)$rol['id_rol'] ?>">
                      <?= htmlspecialchars($rol['rol']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <button type="submit" class="btn btn-primary w-100">Continuar</button>
            </form>
          </div>

          <div class="modal-footer">
            <a href="<?= BASE_URL ?>src/view/login_register.php?tab=login"
              class="btn btn-outline-secondary w-100">
              Cancelar
            </a>
          </div>

        </div>
      </div>
    </div>
  <?php endif; ?>

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
  <script>
    (function () {
      const pass = document.getElementById('regPassword');
      const conf = document.getElementById('regConfirm');
      const btn  = document.getElementById('btnRegister');
      const form = document.getElementById('registerForm');

      if (!pass || !conf || !btn || !form) return;

      const box = document.getElementById('passwordBox');
      const bar = document.getElementById('passBar');
      const lbl = document.getElementById('passLabel');

      const ruleLen   = document.getElementById('ruleLen');
      const ruleUpper = document.getElementById('ruleUpper');
      const ruleLower = document.getElementById('ruleLower');
      const ruleNum   = document.getElementById('ruleNum');
      const ruleMatch = document.getElementById('ruleMatch');

      const setRule = (el, ok, text) => el.textContent = (ok ? '✅ ' : '❌ ') + text;

      const setStrength = (score) => {
        // score 0..5
        const pct = (score / 5) * 100;
        bar.style.width = pct + '%';

        // clases bootstrap
        bar.classList.remove('bg-danger','bg-warning','bg-success');
        if (score <= 2) {
          bar.classList.add('bg-danger');
          lbl.textContent = 'Débil';
        } else if (score <= 4) {
          bar.classList.add('bg-warning');
          lbl.textContent = 'Media';
        } else {
          bar.classList.add('bg-success');
          lbl.textContent = 'Fuerte';
        }
      };

      const validate = () => {
        const v = pass.value || '';
        const c = conf.value || '';

        const okLen   = v.length >= 8;
        const okUpper = /[A-Z]/.test(v);
        const okLower = /[a-z]/.test(v);
        const okNum   = /\d/.test(v);
        const okMatch = v !== '' && v === c;

        setRule(ruleLen,   okLen,   'Mínimo 8 caracteres');
        setRule(ruleUpper, okUpper, '1 mayúscula (A-Z)');
        setRule(ruleLower, okLower, '1 minúscula (a-z)');
        setRule(ruleNum,   okNum,   '1 número (0-9)');
        setRule(ruleMatch, okMatch, 'Coincidir con Confirm');

        const score = [okLen, okUpper, okLower, okNum, okMatch].filter(Boolean).length;
        setStrength(score);

        const allOk = score === 5;

        // Estilo Facebook: aparece al empezar a escribir
        const hasAnyInput = v.length > 0 || c.length > 0;
        box.classList.toggle('d-none', !hasAnyInput);

        // Si todo OK, puedes ocultarlo también (opcional):
        // box.classList.toggle('d-none', !hasAnyInput || allOk);

        btn.disabled = !allOk;

        // mensajes nativos (aunque uses novalidate, sirven si quieres)
        pass.setCustomValidity(allOk ? '' : 'La contraseña no cumple requisitos.');
        conf.setCustomValidity(okMatch ? '' : 'Las contraseñas no coinciden.');
      };

      pass.addEventListener('input', validate);
      conf.addEventListener('input', validate);

      // mostrar caja al enfocar
      pass.addEventListener('focus', () => box.classList.remove('d-none'));
      conf.addEventListener('focus', () => box.classList.remove('d-none'));

      // validar al cargar (por autocompletado)
      validate();

      form.addEventListener('submit', function (e) {
        validate();
        if (btn.disabled) {
          e.preventDefault();
          e.stopPropagation();
        }
      });
    })();
  </script>


  <?php if ($mostrarModalRol): ?>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const el = document.getElementById("modalRoles");
    const modal = new bootstrap.Modal(el, { backdrop: "static", keyboard: false });
    modal.show();
  });
  </script>
  <?php endif; ?>

  </body>
  </html>
