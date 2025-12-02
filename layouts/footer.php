<?php require_once __DIR__ . '/../config/config.php'; ?>

<footer id="footer" class="footer">
    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h2>Join Our Newsletter</h2>
            <p>Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form d-flex">
                <input type="email" name="email" placeholder="Your email address" required="">
                <button type="submit">Subscribe</button>
              </div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-main">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="footer-widget footer-about">
              <a href="<?= BASE_URL ?>index.php" class="logo">
                <span class="sitename">eStore</span>
              </a>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in nibh vehicula, facilisis magna ut, consectetur lorem.</p>
              <div class="footer-contact mt-4">
                <div class="contact-item">
                  <i class="bi bi-geo-alt"></i>
                  <span>123 Fashion Street, New York, NY 10001</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-telephone"></i>
                  <span>+1 (555) 123-4567</span>
                </div>
                <div class="contact-item">
                  <i class="bi bi-envelope"></i>
                  <span>hello@example.com</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Shop</h4>
              <ul class="footer-links">
                <li><a href="<?= BASE_URL ?>src/view/category.php">New Arrivals</a></li>
                <li><a href="<?= BASE_URL ?>src/view/category.php">Bestsellers</a></li>
                <li><a href="<?= BASE_URL ?>src/view/category.php">Women's Clothing</a></li>
                <li><a href="<?= BASE_URL ?>src/view/category.php">Men's Clothing</a></li>
                <li><a href="<?= BASE_URL ?>src/view/category.php">Accessories</a></li>
                <li><a href="<?= BASE_URL ?>src/view/category.php">Sale</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Support</h4>
              <ul class="footer-links">
                <li><a href="<?= BASE_URL ?>src/view/support.php">Help Center</a></li>
                <li><a href="<?= BASE_URL ?>src/view/account.php">Order Status</a></li>
                <li><a href="<?= BASE_URL ?>src/view/shiping-info.php">Shipping Info</a></li>
                <li><a href="<?= BASE_URL ?>src/static/return-policy.php">Returns &amp; Exchanges</a></li>
                <li><a href="#">Size Guide</a></li>
                <li><a href="<?= BASE_URL ?>src/view/contact.php">Contact Us</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Company</h4>
              <ul class="footer-links">
                <li><a href="<?= BASE_URL ?>src/static/about.php">About Us</a></li>
                <li><a href="<?= BASE_URL ?>src/static/about.php">Careers</a></li>
                <li><a href="<?= BASE_URL ?>src/static/about.php">Press</a></li>
                <li><a href="<?= BASE_URL ?>src/static/about.php">Affiliates</a></li>
                <li><a href="<?= BASE_URL ?>src/static/about.php">Responsibility</a></li>
                <li><a href="<?= BASE_URL ?>src/static/about.php">Investors</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-widget">
              <h4>Download Our App</h4>
              <p>Shop on the go with our mobile app</p>
              <div class="app-buttons">
                <a href="#" class="app-btn">
                  <i class="bi bi-apple"></i>
                  <span>App Store</span>
                </a>
                <a href="#" class="app-btn">
                  <i class="bi bi-google-play"></i>
                  <span>Google Play</span>
                </a>
              </div>
              <div class="social-links mt-4">
                <h5>Follow Us</h5>
                <div class="social-icons">
                  <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                  <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                  <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
                  <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
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
          <span>We Accept:</span>
          <div class="payment-icons">
            <i class="bi bi-credit-card" aria-label="Credit Card"></i>
            <i class="bi bi-paypal" aria-label="PayPal"></i>
            <i class="bi bi-apple" aria-label="Apple Pay"></i>
            <i class="bi bi-google" aria-label="Google Pay"></i>
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
          <p>© <span>Copyright</span> <strong class="sitename">eStore</strong>. All Rights Reserved.</p>
        </div>

      </div>

    </div>
</footer>