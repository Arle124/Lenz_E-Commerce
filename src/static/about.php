<?php require_once __DIR__ . '/../../config/autoload.php'; ?>
<?php require_once PATH_CONFIG . "config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>About - eStore Bootstrap Template</title>
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

<body class="about-page">

  <!-- Header -->
  <?php include_once PATH_LAYOUTS . 'header.php'; ?>
  <!-- End Header -->

  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">About</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">About</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- About 2 Section -->
    <section id="about-2" class="about-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <span class="section-badge"><i class="bi bi-info-circle"></i> About Us</span>
        <div class="row">
          <div class="col-lg-6">
            <h2 class="about-title">Nemo enim ipsam voluptatem quia voluptas aspernatur</h2>
            <p class="about-description">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.</p>
          </div>
          <div class="col-lg-6">
            <p class="about-text">Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
            <p class="about-text">Amet eos ut. Officiis soluta ab id dolor non sint. Corporis omnis consequatur quisquam ex consequuntur quo omnis. Quo eligendi cum. Amet mollitia qui quidem dolores praesentium quasi ut et.</p>
          </div>
        </div>

        <div class="row features-boxes gy-4 mt-3">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-box">
              <div class="icon-box">
                <i class="bi bi-bullseye"></i>
              </div>
              <h3><a href="#" class="stretched-link">At vero eos</a></h3>
              <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat.</p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-box">
              <div class="icon-box">
                <i class="bi bi-person-check"></i>
              </div>
              <h3><a href="#" class="stretched-link">Sed ut perspiciatis</a></h3>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="feature-box">
              <div class="icon-box">
                <i class="bi bi-clipboard-data"></i>
              </div>
              <h3><a href="#" class="stretched-link">Nemo enim ipsam</a></h3>
              <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam.</p>
            </div>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-12" data-aos="zoom-in" data-aos-delay="200">
            <div class="video-box">
              <img src="assets/img/about/about-wide-1.webp" class="img-fluid" alt="Video Thumbnail">
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About 2 Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="avatars d-flex align-items-center">
              <img src="assets/img/person/person-m-2.webp" alt="Avatar 1" class="rounded-circle" loading="lazy">
              <img src="assets/img/person/person-m-3.webp" alt="Avatar 2" class="rounded-circle" loading="lazy">
              <img src="assets/img/person/person-f-5.webp" alt="Avatar 3" class="rounded-circle" loading="lazy">
              <img src="assets/img/person/person-m-5.webp" alt="Avatar 4" class="rounded-circle" loading="lazy">
            </div>
          </div>

          <div class="col-lg-8">
            <div class="row counters">
              <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <h2><span data-purecounter-start="0" data-purecounter-end="185" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                <p>Nemo enim ipsam</p>
              </div>

              <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <h2><span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>K</h2>
                <p>Voluptatem sequi</p>
              </div>

              <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <h2><span data-purecounter-start="0" data-purecounter-end="128" data-purecounter-duration="1" class="purecounter"></span>+</h2>
                <p>Dolor sit consectetur</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Stats Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <div class="container">

        <div class="testimonial-masonry">

          <div class="testimonial-item" data-aos="fade-up">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Implementing innovative strategies has revolutionized our approach to market challenges and competitive positioning.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/person/person-f-7.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Rachel Bennett</h3>
                  <span class="position">Strategy Director</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Exceptional service delivery and innovative solutions have transformed our business operations, leading to remarkable growth and enhanced customer satisfaction across all touchpoints.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/person/person-m-7.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Daniel Morgan</h3>
                  <span class="position">Chief Innovation Officer</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Strategic partnership has enabled seamless digital transformation and operational excellence.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/person/person-f-8.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Emma Thompson</h3>
                  <span class="position">Digital Lead</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Professional expertise and dedication have significantly improved our project delivery timelines and quality metrics.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/person/person-m-8.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Christopher Lee</h3>
                  <span class="position">Technical Director</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="400">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Collaborative approach and industry expertise have revolutionized our product development cycle, resulting in faster time-to-market and increased customer engagement levels.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/person/person-f-9.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Olivia Carter</h3>
                  <span class="position">Product Manager</span>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-item" data-aos="fade-up" data-aos-delay="500">
            <div class="testimonial-content">
              <div class="quote-pattern">
                <i class="bi bi-quote"></i>
              </div>
              <p>Innovative approach to user experience design has significantly enhanced our platform's engagement metrics and customer retention rates.</p>
              <div class="client-info">
                <div class="client-image">
                  <img src="assets/img/person/person-m-13.webp" alt="Client">
                </div>
                <div class="client-details">
                  <h3>Nathan Brooks</h3>
                  <span class="position">UX Director</span>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Testimonials Section -->

  </main>

  <!-- Footer -->
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