<?php require_once __DIR__ . '/../../config/autoload.php'; ?>
<?php require_once __DIR__ . "/../../config/sesion.php"; ?>
<?php require_once "../../layouts/header.php"; ?>


<?php require_once PATH_CONFIG . 'config.php'; 
// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login_register.php?tab=login");
    exit;
}

$u = $_SESSION['usuario'];
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
                  <img src="assets/img/person/person-f-1.webp" alt="Profile" loading="lazy">
                  <span class="status-badge"><i class="bi bi-shield-check"></i></span>
                </div>
                <h4><strong>Nombre:</strong> <?= htmlspecialchars($u['nombre']) ?> <?= htmlspecialchars($u['apellido']) ?></h4>
                <div class="user-status">
                </div>
              </div>

              <!-- Navigation Menu -->
              <nav class="menu-nav">
                <ul class="nav flex-column" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#orders">
                      <i class="bi bi-box-seam"></i>
                      <span>My Orders</span>
                      <span class="badge">3</span>
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
                  <a href="#" class="logout-link">
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
                    <!-- Order Card 1 -->
                    <div class="order-card" data-aos="fade-up" data-aos-delay="100">
                      <div class="order-header">
                        <div class="order-id">
                          <span class="label">Order ID:</span>
                          <span class="value">#ORD-2024-1278</span>
                        </div>
                        <div class="order-date">Feb 20, 2025</div>
                      </div>
                      <div class="order-content">
                        <div class="product-grid">
                          <img src="assets/img/product/product-1.webp" alt="Product" loading="lazy">
                          <img src="assets/img/product/product-2.webp" alt="Product" loading="lazy">
                          <img src="assets/img/product/product-3.webp" alt="Product" loading="lazy">
                        </div>
                        <div class="order-info">
                          <div class="info-row">
                            <span>Status</span>
                            <span class="status processing">Processing</span>
                          </div>
                          <div class="info-row">
                            <span>Items</span>
                            <span>3 items</span>
                          </div>
                          <div class="info-row">
                            <span>Total</span>
                            <span class="price">$789.99</span>
                          </div>
                        </div>
                      </div>
                      <div class="order-footer">
                        <button type="button" class="btn-track" data-bs-toggle="collapse" data-bs-target="#tracking1" aria-expanded="false">Track Order</button>
                        <button type="button" class="btn-details" data-bs-toggle="collapse" data-bs-target="#details1" aria-expanded="false">View Details</button>
                      </div>

                      <!-- Order Tracking -->
                      <div class="collapse tracking-info" id="tracking1">
                        <div class="tracking-timeline">
                          <div class="timeline-item completed">
                            <div class="timeline-icon">
                              <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Orden realizada.</h5>
                              <p>tu orden ha sido resibida via whats App, pronto alguien se comunicar con usted.</p>
                              <span class="timeline-date">Feb 20, 2025 - 10:30 AM</span>
                            </div>
                          </div>

                          <div class="timeline-item completed">
                            <div class="timeline-icon">
                              <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>procesando</h5>
                                <p>Tu orden fue recibida y está siendo procesada.</p>
                              <span class="timeline-date">Feb 20, 2025 - 2:45 PM</span>
                            </div>
                          </div>

                          <div class="timeline-item active">
                            <div class="timeline-icon">
                              <i class="bi bi-box-seam"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Aprobada</h5>
                              <p>Tu orden ha sido aprobada esperando confirmación de pago</p>
                              <span class="timeline-date">Feb 20, 2025 - 4:15 PM</span>
                            </div>
                          </div>

                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="bi bi-truck"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Confirmada</h5>
                              <p>tu orden ha sido confirmada</p>
                            </div>
                          </div>

                          <div class="timeline-item">
                            <div class="timeline-icon">
                              <i class="bi bi-house-door"></i>
                            </div>
                            <div class="timeline-content">
                              <h5>Terminada</h5>
                              <p>tu orden ha sido terminada</p>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Order Details -->
                      <div class="collapse order-details" id="details1">
                        <div class="details-content">
                          <div class="detail-section">
                            <h5>Order Information</h5>
                            <div class="info-grid">
                              <div class="info-item">
                                <span class="label">Payment Method</span>
                                <span class="value">Credit Card (**** 4589)</span>
                              </div>
                              <div class="info-item">
                                <span class="label">Shipping Method</span>
                                <span class="value">Express Delivery (2-3 days)</span>
                              </div>
                            </div>
                          </div>

                          <div class="detail-section">
                            <h5>Items (3)</h5>
                            <div class="order-items">
                              <div class="item">
                                <img src="assets/img/product/product-1.webp" alt="Product" loading="lazy">
                                <div class="item-info">
                                  <h6>Lorem ipsum dolor sit amet</h6>
                                  <div class="item-meta">
                                    <span class="sku">SKU: PRD-001</span>
                                    <span class="qty">Qty: 1</span>
                                  </div>
                                </div>
                                <div class="item-price">$899.99</div>
                              </div>

                              <div class="item">
                                <img src="assets/img/product/product-2.webp" alt="Product" loading="lazy">
                                <div class="item-info">
                                  <h6>Consectetur adipiscing elit</h6>
                                  <div class="item-meta">
                                    <span class="sku">SKU: PRD-002</span>
                                    <span class="qty">Qty: 2</span>
                                  </div>
                                </div>
                                <div class="item-price">$599.95</div>
                              </div>

                              <div class="item">
                                <img src="assets/img/product/product-3.webp" alt="Product" loading="lazy">
                                <div class="item-info">
                                  <h6>Sed do eiusmod tempor</h6>
                                  <div class="item-meta">
                                    <span class="sku">SKU: PRD-003</span>
                                    <span class="qty">Qty: 1</span>
                                  </div>
                                </div>
                                <div class="item-price">$129.99</div>
                              </div>
                            </div>
                          </div>

                          <div class="detail-section">
                            <h5>Price Details</h5>
                            <div class="price-breakdown">
                              <div class="price-row">
                                <span>Subtotal</span>
                                <span>$1,929.93</span>
                              </div>
                              <div class="price-row">
                                <span>Shipping</span>
                                <span>$15.99</span>
                              </div>
                              <div class="price-row">
                                <span>Tax</span>
                                <span>$159.98</span>
                              </div>
                              <div class="price-row total">
                                <span>Total</span>
                                <span>$2,105.90</span>
                              </div>
                            </div>
                          </div>

                          <div class="detail-section">
                            <h5>Shipping Address</h5>
                            <div class="address-info">
                              <p>Sarah Anderson<br>123 Main Street<br>Apt 4B<br>New York, NY 10001<br>United States</p>
                              <p class="contact">+1 (555) 123-4567</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Order Card 4 -->
                    <div class="order-card" data-aos="fade-up" data-aos-delay="400">
                      <div class="order-header">
                        <div class="order-id">
                          <span class="label">Order ID:</span>
                          <span class="value">#ORD-2024-1245</span>
                        </div>
                        <div class="order-date">Feb 5, 2025</div>
                      </div>
                      <div class="order-content">
                        <div class="product-grid">
                          <img src="assets/img/product/product-7.webp" alt="Product" loading="lazy">
                          <img src="assets/img/product/product-8.webp" alt="Product" loading="lazy">
                          <img src="assets/img/product/product-9.webp" alt="Product" loading="lazy">
                          <span class="more-items">+2</span>
                        </div>
                        <div class="order-info">
                          <div class="info-row">
                            <span>Status</span>
                            <span class="status cancelled">Cancelled</span>
                          </div>
                          <div class="info-row">
                            <span>Items</span>
                            <span>5 items</span>
                          </div>
                          <div class="info-row">
                            <span>Total</span>
                            <span class="price">$1,299.99</span>
                          </div>
                        </div>
                      </div>
                      <div class="order-footer">
                        <button type="button" class="btn-reorder">Reorder</button>
                        <button type="button" class="btn-details">View Details</button>
                      </div>
                    </div>
                  </div>

                  <!-- Pagination -->
                  <div class="pagination-wrapper" data-aos="fade-up">
                    <button type="button" class="btn-prev" disabled="">
                      <i class="bi bi-chevron-left"></i>
                    </button>
                    <div class="page-numbers">
                      <button type="button" class="active">1</button>
                      <button type="button">2</button>
                      <button type="button">3</button>
                      <span>...</span>
                      <button type="button">12</button>
                    </div>
                    <button type="button" class="btn-next">
                      <i class="bi bi-chevron-right"></i>
                    </button>
                  </div>
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

                <!-- Settings Tab -->
                <div class="tab-pane fade" id="settings">
                  <div class="section-header" data-aos="fade-up">
                    <h2>Account Settings</h2>
                  </div>

                  <div class="settings-content">
                    <!-- Personal Information -->
                    <div class="settings-section" data-aos="fade-up">
                      <h3>Personal Information</h3>
                      <form class="php-email-form settings-form">
                        <div class="row g-3">
                          <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" value="Sarah" required="">
                          </div>
                          <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" value="Anderson" required="">
                          </div>
                          <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="sarah@example.com" required="">
                          </div>
                          <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" value="+1 (555) 123-4567">
                          </div>
                        </div>

                        <div class="form-buttons">
                          <button type="submit" class="btn-save">Save Changes</button>
                        </div>

                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your changes have been saved successfully!</div>
                      </form>
                    </div>

                    <!-- Email Preferences -->
                    <div class="settings-section" data-aos="fade-up" data-aos-delay="100">
                      <h3>Email Preferences</h3>
                      <div class="preferences-list">
                        <div class="preference-item">
                          <div class="preference-info">
                            <h4>Order Updates</h4>
                            <p>Receive notifications about your order status</p>
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="orderUpdates" checked="">
                          </div>
                        </div>

                        <div class="preference-item">
                          <div class="preference-info">
                            <h4>Promotions</h4>
                            <p>Receive emails about new promotions and deals</p>
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="promotions">
                          </div>
                        </div>

                        <div class="preference-item">
                          <div class="preference-info">
                            <h4>Newsletter</h4>
                            <p>Subscribe to our weekly newsletter</p>
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="newsletter" checked="">
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Security Settings -->
                    <div class="settings-section" data-aos="fade-up" data-aos-delay="200">
                      <h3>Security</h3>
                      <form class="php-email-form settings-form">
                        <div class="row g-3">
                          <div class="col-md-12">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" required="">
                          </div>
                          <div class="col-md-6">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" required="">
                          </div>
                          <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required="">
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