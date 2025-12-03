<header id="header" class="header position-relative">
    <!-- Top Bar -->
    <div class="top-bar py-2">
      <div class="container-fluid container-xl">
        <div class="row align-items-center">
          <div class="col-lg-4 d-none d-lg-flex">
            <div class="top-bar-item">
              <i class="bi bi-telephone-fill me-2"></i>
              <span>¿Necesita ayuda? Llámenos: </span>
              <a href="tel:+573103812734">+57 310 381 2734</a>
            </div>
          </div>

          <div class="col-lg-4 col-md-12 text-center">
            <div class="announcement-slider swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 1,
                  "direction": "vertical",
                  "effect": "slide"
                }
              </script>

            </div>
          </div>
          
          <!-- Posiblemente podría ir algo aquí como un reloj que de la hora o similar -->

          
        </div>
      </div>
    </div>

    <!-- Main Header -->
    <div class="main-header">
      <div class="container-fluid container-xl">
        <div class="d-flex py-3 align-items-center justify-content-between">

          <!-- Logo -->
          <a href="<?= BASE_URL ?>index.php" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.webp" alt=""> -->
            <h1 class="sitename">Lenz</h1>
          </a>

          <!-- Actions -->
          <div class="header-actions d-flex align-items-center justify-content-end">

            <!-- Mobile Search Toggle -->
            <button class="header-action-btn mobile-search-toggle d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false" aria-controls="mobileSearch">
              <i class="bi bi-search"></i>
            </button>

            <!-- Account -->
            <div class="dropdown account-dropdown">
              <button class="header-action-btn" data-bs-toggle="dropdown">
                <i class="bi bi-person"></i>
              </button>
              <div class="dropdown-menu">
                <div class="dropdown-header">
                  <h6>Welcome to <span class="sitename">eStore</span></h6>
                  <p class="mb-0">Access account &amp; manage orders</p>
                </div>
                <div class="dropdown-body">
                  <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>src/view/account.php">
                    <i class="bi bi-person-circle me-2"></i>
                    <span>My Profile</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>src/view/account.php">
                    <i class="bi bi-bag-check me-2"></i>
                    <span>My Orders</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>src/view/account.php">
                    <i class="bi bi-heart me-2"></i>
                    <span>My Wishlist</span>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="<?= BASE_URL ?>src/view/account.php">
                    <i class="bi bi-gear me-2"></i>
                    <span>Settings</span>
                  </a>
                </div>
                <div class="dropdown-footer">
                  <a href="<?= BASE_URL ?>src/view/login_register.php?tab=login" class="btn btn-primary w-100 mb-2">Sign In</a>
                  <a href="<?= BASE_URL ?>src/view/login_register.php?tab=register" class="btn btn-outline-primary w-100">Register</a>
                </div>

              </div>
            </div>

            <!-- Wishlist -->
            <a href="<?= BASE_URL ?>src/view/account.php" class="header-action-btn d-none d-md-block">
              <i class="bi bi-heart"></i>
              <span class="badge">0</span>
            </a>

            <!-- Cart -->
            <a href="<?= BASE_URL ?>src/view/cart.php" class="header-action-btn">
              <i class="bi bi-cart3"></i>
              <span class="badge">3</span>
            </a>

            <!-- Mobile Navigation Toggle -->
            <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <div class="header-nav">
      <div class="container-fluid container-xl">
        <div class="position-relative">
          <nav id="navmenu" class="navmenu">
            <ul>
              <li><a href="<?= BASE_URL ?>index.php" class="active">Inicio</a></li>
              <li><a href="<?= BASE_URL ?>src/static/about.php">Sobre</a></li>
              <li><a href="<?= BASE_URL ?>src/view/category.php">Categoría</a></li>
              <li><a href="<?= BASE_URL ?>src/view/cart.php">Carrito</a></li>
              <li><a href="<?= BASE_URL ?>src/view/contact.php">Contacto</a></li>

            </ul>
          </nav>
        </div>
      </div>
    </div>

    <!-- Mobile Search Form -->
    <div class="collapse" id="mobileSearch">
      <div class="container">
        <form class="search-form">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for products">
            <button class="btn" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
      </div>
    </div>

  </header>