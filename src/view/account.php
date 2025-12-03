<?php 
require_once __DIR__ . "/../../config/autoload.php"; 
require_once __DIR__ . "/../../config/sesion.php"; 
require_once PATH_CONFIG . 'config.php'; 

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login_register.php?tab=login");
    exit;
}

$u = $_SESSION['usuario'];
require_once "../controller/PedidoController.php";
$pedidoController = new PedidoController();

// Obtener pedidos usando SP
$pedidos = $pedidoController->misPedidos();
require_once PATH_LAYOUTS . 'header.php'; 
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Account - Lenz</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>account.html">

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

<body class="account-page">

  <!-- Header -->
  

  <main class="main">

    <!-- Account Section -->
    <section id="account" class="account section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
          <!-- Profile Menu -->
          <div class="col-lg-3">
            <div class="profile-menu collapse d-lg-block" id="profileMenu">
              <!-- User Info -->
              <div class="user-info" data-aos="fade-right">
                <div class="user-avatar">
                  <img src="<?= BASE_URL ?>assets/img/person/person-f-1.webp">

                  <span class="status-badge"><i class="bi bi-shield-check"></i></span>
                </div>
                <h4><strong>Nombre:</strong> <?= htmlspecialchars($u['nombre']) ?> <?= htmlspecialchars($u['apellido']) ?></h4>
                <div class="user-status">
                  <?php if (!empty($u['roles'])): ?>
                    <span><strong>Rol:</strong> <?= htmlspecialchars(implode(", ", $u['roles'])) ?></span>
                <?php else: ?>
                    <span><strong>Rol:</strong> Sin roles</span>
                <?php endif; ?>

                </div>
              </div>

              <!-- Navigation Menu -->
              <nav class="menu-nav">
                <ul class="nav flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#orders">
                        <i class="bi bi-box-seam"></i>
                        <span>My Orders</span>
                        <span class="badge"><?= count($pedidos) ?></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#wishlist">
                      <i class="bi bi-heart"></i>
                      <span>Wishlist</span>
                      <span class="badge">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#settings">
                      <i class="bi bi-gear"></i>
                      <span>Account Settings</span>
                    </a>
                  </li>
                </ul>

                <div class="menu-footer">
                  <a href="#" class="help-link">
                    <i class="bi bi-question-circle"></i>
                    <span>Help Center</span>
                  </a>
                  <a href="<?= BASE_URL ?>src/controller/UsuarioController.php?action=logout" class="logout-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log Out</span>
                  </a>
                </div>
              </nav>
            </div>
          </div>

          <!-- Content Area -->
          <div class="col-lg-9">
            <div class="content-area">
              <div class="tab-content">
                <!-- Orders Tab -->
                <div class="tab-pane fade show active" id="orders">
                  <div class="section-header" data-aos="fade-up">
                    <h2>My Orders</h2>
                    <div class="header-actions">
                      <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search orders...">
                      </div>
                      <div class="dropdown">
                        <button class="filter-btn" data-bs-toggle="dropdown">
                          <i class="bi bi-funnel"></i>
                          <span>Filter</span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">All Orders</a></li>
                          <li><a class="dropdown-item" href="#">Processing</a></li>
                          <li><a class="dropdown-item" href="#">Shipped</a></li>
                          <li><a class="dropdown-item" href="#">Delivered</a></li>
                          <li><a class="dropdown-item" href="#">Cancelled</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="orders-grid">

                    <?php if (empty($pedidos)): ?>
                      <p class="text-center">No tienes pedidos aún.</p>
                    <?php else: ?>
                      <?php foreach ($pedidos as $p): ?>
                        <?php $items = $pedidoController->detallePedido($p['id_pedido']); ?>
                        <?php $track = $pedidoController->tracking($p['id_pedido']); ?>

                        <div class="order-card" data-aos="fade-up">

                            <!-- HEADER -->
                            <div class="order-header">
                                <div class="order-id">
                                    <span class="label">Order ID:</span>
                                    <span class="value">#<?= $p['id_pedido'] ?></span>
                                </div>
                                <div class="order-date"><?= $p['creado_en'] ?></div>
                            </div>

                            <!-- CONTENT -->
                            <div class="order-content">
                                <div class="product-grid">

                                    <?php foreach ($items as $i): ?>
                                        <img src="<?= $i['imagen'] ?>" alt="Producto" loading="lazy">
                                    <?php endforeach; ?>

                                    <?php if (count($items) > 3): ?>
                                        <span class="more-items">+<?= count($items) - 3 ?></span>
                                    <?php endif; ?>

                                </div>

                                <div class="order-info">
                                    <div class="info-row">
                                        <span>Status</span>
                                        <span class="status"><?= ucfirst($p['estado_nombre']) ?></span>
                                    </div>

                                    <div class="info-row">
                                        <span>Items</span>
                                        <span><?= count($items) ?></span>
                                    </div>

                                    <div class="info-row">
                                        <span>Total</span>
                                        <span class="price">$<?= number_format($p['total'], 2) ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- FOOTER BUTTONS -->
                            <div class="order-footer">
                                <button type="button" class="btn-track" 
                                    data-bs-toggle="collapse"
                                    data-bs-target="#tracking<?= $p['id_pedido'] ?>">
                                    Track Order
                                </button>

                                <button type="button" class="btn-details" 
                                    data-bs-toggle="collapse"
                                    data-bs-target="#details<?= $p['id_pedido'] ?>">
                                    View Details
                                </button>
                            </div>

                            <!-- TRACKING COLLAPSE -->
                            <div class="collapse tracking-info" id="tracking<?= $p['id_pedido'] ?>">
                                <div class="tracking-timeline">

                                    <?php if (empty($track)): ?>
                                        <p class="text-center">Este pedido aún no tiene historial.</p>

                                    <?php else: ?>
                                        <?php foreach ($track as $t): ?>
                                            <div class="timeline-item <?= ($t['id_estado'] <= $p['id_estado']) ? 'completed' : '' ?>">
                                                <div class="timeline-icon">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                </div>

                                                <div class="timeline-content">
                                                    <h5><?= htmlspecialchars($t['estado_nombre']) ?></h5>
                                                    <p><?= htmlspecialchars($t['descripcion']) ?></p>
                                                    <span class="timeline-date"><?= $t['fecha'] ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <!-- DETAILS COLLAPSE -->
                            <div class="collapse order-details" id="details<?= $p['id_pedido'] ?>">
                                <div class="details-wrapper">

                                    <div class="details-header">
                                        <h4>Order Details</h4>
                                    </div>

                                    <?php foreach ($items as $i): ?>
                                        <div class="detail-item">
                                            <img src="<?= BASE_URL . $i['imagen'] ?>" alt="">

                                            <div class="detail-info">
                                                <h5><?= $i['nombre'] ?></h5>
                                                <p>Cantidad: <?= $i['cantidad'] ?></p>
                                                <p>Precio unitario: $<?= number_format($i['precio'], 2) ?></p>
                                            </div>

                                              <div class="detail-total">
                                                <span>Total</span>
                                                <span>$<?= number_format($i['precio'] * $i['cantidad'], 2) ?></span>
                                              </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>

                  <?php endif; ?>

                </div>

                <!-- Wishlist Tab -->
                <div class="tab-pane fade" id="wishlist">
                  <div class="section-header" data-aos="fade-up">
                    <h2>My Wishlist</h2>
                    <div class="header-actions">
                      <button type="button" class="btn-add-all">Add All to Cart</button>
                    </div>
                  </div>

                  <div class="wishlist-grid">
                    <!-- Wishlist Item 1 -->
                    <div class="wishlist-card" data-aos="fade-up" data-aos-delay="100">
                      <div class="wishlist-image">
                        <img src="assets/img/product/product-1.webp" alt="Product" loading="lazy">
                        <button class="btn-remove" type="button" aria-label="Remove from wishlist">
                          <i class="bi bi-trash"></i>
                        </button>
                        <div class="sale-badge">-20%</div>
                      </div>
                      <div class="wishlist-content">
                        <h4>Lorem ipsum dolor sit amet</h4>
                        <div class="product-meta">
                          <div class="rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span>(4.5)</span>
                          </div>
                          <div class="price">
                            <span class="current">$79.99</span>
                            <span class="original">$99.99</span>
                          </div>
                        </div>
                        <button type="button" class="btn-add-cart">Add to Cart</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Settings Tab -->
                <div class="tab-pane fade" id="settings">
                  <div class="section-header" data-aos="fade-up">
                    <h2>Account Settings</h2>
                  </div>

                  <div class="settings-content">

                    <!-- Personal Information -->
                    <div class="settings-section" data-aos="fade-up">
                        <h3>Personal Information</h3>

                        <?php if (!empty($_SESSION['success'])): ?>
                            <div class="alert alert-success">
                                <?= $_SESSION['success'] ?>
                            </div>
                            <?php unset($_SESSION['success']); ?>
                        <?php endif; ?>

                        <?php if (!empty($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['error'] ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <!-- FORMULARIO CORREGIDO -->
                        <form class="php-email-form settings-form"
                              action="<?= BASE_URL ?>src/controller/UsuarioController.php"
                              method="POST">

                            <input type="hidden" name="action" value="actualizar_perfil">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">Nombre</label>
                                    <input type="text" class="form-control"
                                          id="firstName" name="nombre"
                                          value="<?= htmlspecialchars($u['nombre']) ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Apellido</label>
                                    <input type="text" class="form-control"
                                          id="lastName" name="apellido"
                                          value="<?= htmlspecialchars($u['apellido']) ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control"
                                          id="correo" name="correo"
                                          value="<?= htmlspecialchars($u['correo']) ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control"
                                          id="phone" name="telefono"
                                          value="<?= htmlspecialchars($u['telefono']) ?>">
                                </div>

                            </div>

                            <div class="form-buttons mt-3">
                                <button type="submit" class="btn-save">Save Changes</button>
                            </div>
                        </form>
                    </div>


                    <!-- Security Settings -->
                    <div class="settings-section" data-aos="fade-up" data-aos-delay="200">
                      <h3>Security</h3>

                      <form class="php-email-form settings-form"
                        action="<?= BASE_URL ?>src/controller/UsuarioController.php"
                        method="POST">

                        <input type="hidden" name="action" value="actualizar_password">

                        <div class="row g-3">

                          <div class="col-md-12">
                            <label for="currentPassword" class="form-label">Current Password</label>
                              <input type="password" class="form-control"
                                id="currentPassword" name="password_actual" required>
                          </div>

                          <div class="col-md-6">
                            <label for="newPassword" class="form-label">New Password</label>
                              <input type="password" class="form-control"
                                id="newPassword" name="password_nuevo" required>
                          </div>

                          <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                              <input type="password" class="form-control"
                                id="confirmPassword" name="password_confirm" required>
                          </div>

                        </div>

                        <div class="form-buttons">
                          <button type="submit" class="btn-save">Update Password</button>
                        </div>

                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your password has been updated successfully!</div>
                      </form>
                    </div>
           

                    <!-- Delete Account -->
                    <div class="settings-section danger-zone" data-aos="fade-up" data-aos-delay="300">
                      <h3>Delete Account</h3>
                      <div class="danger-zone-content">
                        <p>Once you delete your account, there is no going back. Please be certain.</p>
                        <button type="button" class="btn-danger">Delete Account</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Account Section -->

  </main>

  <?php require_once PATH_LAYOUTS . 'footer.php'; ?>

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