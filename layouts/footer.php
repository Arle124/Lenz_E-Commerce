<?php require_once __DIR__ . '/../config/config.php'; ?>

<footer id="footer" class="footer">

    <div class="footer-main">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="footer-widget footer-about">
              <a href="<?= BASE_URL ?>index.php" class="logo">
                <span class="sitename">Lenz</span>
              </a>
              <p>LENZ COMPANY SAS ZOMAC es una distribuidora regional de productos Royal Prestige, especializada en ofrecer soluciones de alta calidad para la cocina.</p>
              <div class="footer-contact mt-4">
                <div class="contact-item">
                  <i class="bi bi-geo-alt"></i>
                  <span>Aguachica, Cesar</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-telephone"></i>
                  <span>+57 310 381 2734</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-envelope"></i>
                  <span>lenzcompanysas@gmail.com</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Soporte</h4>
              <ul class="footer-links">
                <li><a href="<?= BASE_URL ?>src/view/support.php">Centro de Ayuda</a></li>
                <li><a href="<?= BASE_URL ?>src/view/account.php">Estado del pedido</a></li>
                <li><a href="<?= BASE_URL ?>src/view/contact.php">Contáctenos</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Compañía</h4>
              <ul class="footer-links">
                <li><a href="<?= BASE_URL ?>src/static/about.php">Sobre Nosotros</a></li>
                <li><a href="<?= BASE_URL ?>src/static/about.php">Responsabilidad</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-widget">
              
              <div class="social-links mt-4">
                <h5>Síguenos</h5>
                <div class="social-icons">

                  <a href="https://www.facebook.com/share/1BWy7wXzCa/?mibextid=wwXIfr" target = "_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="bi bi-facebook"></i></a>

                  <a href="https://www.instagram.com/royalprestigecolombiaoficial?igsh=M2d6aGFtcTd5c3c0" target = "_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="bi bi-instagram"></i></a>

                  <a href="https://youtube.com/@royalprestigecolombiaoficial?si=3rWi4DusGR1XVEOD" target = "_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <div class="payment-methods d-flex align-items-center justify-content-center">
          <span>Aceptamos:</span>
          <div class="payment-icons">
            <i class="bi bi-shop" aria-label="Shop Pay"></i>
            <i class="bi bi-cash" aria-label="Cash on Delivery"></i>
          </div>
        </div>

        <div class="legal-links">
          <a href="<?= BASE_URL ?>src/static/tos.php">Terms of Service</a>
          <a href="<?= BASE_URL ?>src/static/privacy.php">Privacy Policy</a>
          <a href="<?= BASE_URL ?>src/static/tos.php">Cookies Settings</a>
        </div>

        <div class="copyright text-center">
          <p>© <span>Copyright</span> <strong class="sitename">Lenz</strong>. All Rights Reserved.</p>
        </div>

      </div>

    </div>
</footer>