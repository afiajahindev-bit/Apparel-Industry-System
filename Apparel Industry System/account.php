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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<!--Font Awesome-->
  <script src="https://kit.fontawesome.com/d4c58442e3.js" crossorigin="anonymous"></script>
  <!--CSS-->
  <link rel="stylesheet" href="css/account.css">
</head>

<body>
  <!--Header-->

  <section class="colored-section" id="title">

      <!--Navigation-->
      <?php
      require('Navigation.php');
      ?>
  </section>

  <?php
  if(isset($_GET['update'])){
  ?>
  <div class='alert alert-success' style='text-align:center;'>Updated Successfully!</div>
  <?php
  }
  ?>

  <section class="my-5" id="info">
  <h2>Account Information</h2>
  <form class="my-4 pb-5 px-5" action="">
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="email">Email</label></div>
      <div class="col-sm-9"><input type="text" id="email" value="<?=$user_value['email'];?>" class="form-control-plaintext" readonly></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="firstname">First Name</label></div>
      <div class="col-sm-9"><input type="text" id="firstname" value="<?=$user_value['firstname'];?>" class="form-control-plaintext" readonly></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="lasttname">Last Name</label></div>
      <div class="col-sm-9"><input type="text" id="lastname" value="<?=$user_value['lastname'];?>" class="form-control-plaintext" readonly></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="contact">Contact</label></div>
      <div class="col-sm-9"><input type="text" id="contact" value="<?=$user_value['contact'];?>" class="form-control-plaintext" readonly></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="address">Shipping Address</label></div>
      <div class="col-sm-9"><input type="text" id="address" value="<?=$user_value['address'];?>" class="form-control-plaintext" readonly></div>
    </div>
      <br>
    <div class="d-grid gap-2 d-sm-flex mt-5 ml-5">
      <a href="http://localhost/project-file/update.php"><button type="button" class="btn btn-outline-light custom-button rounded-pill px-5">Update Profile</button></a>
    </div>
  </form>

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
