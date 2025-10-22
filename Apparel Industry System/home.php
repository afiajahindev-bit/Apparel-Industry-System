<?php
require_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Royel Group</title>
  <!--Google Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
    crossorigin="anonymous"></script>
  <!--Font Awesome-->
  <script src="https://kit.fontawesome.com/d4c58442e3.js" crossorigin="anonymous"></script>
  <!--CSS-->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!--Header-->

  <section class="colored-section" id="title">
    <div class="container-fluid">

      <!--Navigation-->
      <?php
      require('Navigation.php');
      ?>

      <!--Title-->

      <div class="row">
        <div class="col-lg-6">
          <h1>Direct To Film Printing.</h1>
          <p>Print multiple colors of any <strong>logo or design</strong> of your choice.</p>
          <a href="http://localhost/project-file/fabric.php"><button type="button"
              class="btn btn-outline-light btn-lg collection-button">Collection</button></a>
        </div>

        <div class="col-lg-6 text-center align-middle">
          <img class="title-image align-middle" href="" src="images/home.png" alt="Royel-group-logo">
        </div>

      </div>

    </div>
  </section>

  <!--Features-->

  <section id="features">
    <div class="row">
      <div class="col-lg-4 feature-box">
        <i class="fa-sharp fa-regular fa-square-check fa-3x feature-icon"></i>
        <h4>Exquisite Quality.</h4>
        <p class="feature-font">Print printed by advanced quality chemicals with the guarantee of being soft and
          intact
          for a lifetime.</p>
      </div>
      <div class="col-lg-4 feature-box">
        <i class="fa-sharp fa-solid fa-tags fa-3x feature-icon"></i>
        <h4>Reasonable Price.</h4>
        <p class="feature-font">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
          incididunt ut.</p>
      </div>
      <div class="col-lg-4 feature-box">
        <i class="fa-sharp fa-solid fa-truck-fast fa-3x feature-icon"></i>
        <h4>Fast Shipping.</h3>
          <p class="feature-font">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor
            incididunt ut labore et dolore magna aliqua.</p>
      </div>
    </div>
  </section>

  <!-- Custom -->

  <section id="custom">
    <div class="custom-box">
      <h3>Customize Printing</h3>
      <h5 style=" color: #6f6e6e;">Upload designs to print your customized design on the fabrics</h5>
      <button type="button" class="btn btn-outline-light custom-button rounded-pill">Uplaod Design</button>
    </div>
  </section>

  <!--Pricing-->
  <section id="pricing">
    <h2 class="section-heading">Pricing</h2>
    <p>Price ranges are same for any design or fabric</p>

    <div class="row">
      <div class="pricing-column col-lg-4 col-md-6 ">
        <div class="card shadow bg-white rounded">
          <div class="card-header">
            <h3>A4</h3>
          </div>
          <div class="card-body">
            <div class="price-feature">
              <h2 class="price-text">Price</h2>
              <small>per piece</small>
            </div>
            <p>7.3x 11 inches</p>
            <p>No minimum order</p>
            <p>For all design or fabric</p>
          </div>
        </div>
      </div>

      <div class="pricing-column col-lg-4 col-md-6">
        <div class="card shadow bg-white rounded">
          <div class="card-header">
            <h3>A3</h3>
          </div>
          <div class="card-body">
            <div class="price-feature">
              <h2 class="price-text">Price</h2>
              <small>per piece</small>
            </div>

            <p>11x15 inches </p>
            <p>No minimum order</p>
            <p>For all design or fabric</p>
          </div>
        </div>
      </div>

      <div class="pricing-column col-lg-4">
        <div class="card shadow bg-white rounded">
          <div class="card-header">
            <h3> (1 meter)</h3>
          </div>
          <div class="card-body">
            <div class="price-feature">
              <h2 class="price-text">Price</h2>
              <small>per piece</small>
            </div>

            <p>22.5x39 inches</p>
            <p>No minimum order</p>
            <p>For all design or fabric</p>

          </div>
        </div>
      </div>

  </section>

  <!--Footer-->

  <section class="white-section" id="footer">
    <div>
      <h5>Contact us on social networks: </h5>
      <div class="container p-2 pb-0">
        <div class="mb-4">
          <a class="btn btn-outline-light btn-floating m-1 text-white mx-3" href="#!" role="button"><i
              class="fab fa-facebook-f"></i></a>
          <a class="btn btn-outline-light btn-floating m-1 text-white mx-3" href="#!" role="button"><i
              class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
    <hr class=" hr hr-blurry">
    <div class="row contact text-white my-5">
      <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4 mx-auto mb-md-0 mb-4">
        <h6 class="text-uppercase fw-bold mb-4 mt-4">Explore</h6>
        <p><a href="home.html" class="footer-anchor">Home</a></p>
        <p><a href="#" class="footer-anchor">Fabrics Available</a></p>
        <p><a href="#" class="footer-anchor">Pattern Catalog</a></p>
        <p><a href="#" class="footer-anchor">Pricing</a></p>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4 mx-auto mb-md-0">
        <h6 class="text-uppercase fw-bold mb-4 mt-4">Support</h6>
        <p><a href="" class="footer-anchor">About</a></p>
        <p><a href="" class="footer-anchor">Contact us</a></p>
        <p><a href="" class="footer-anchor">FAQ</a></p>
      </div>

      <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4 mx-auto mb-md-0">
        <h6 class="text-uppercase fw-bold mb-4 mt-4">Contact</h6>
        <p>House-1/3, Road-01 (Avenue), Block-C, Mirpur-1, Dhaka-1216, Bangladesh</p>
        <p>royelgroupbangladesh@gmail.com</p>
        <p>Phone: 01878-726339</p>
      </div>
    </div>

    <hr class=" hr hr-blurry">
    <div class="text-center p-3">
      <p>© Copyright 2023 Royel Group</p>
    </div>

  </section>

</body>

</html>