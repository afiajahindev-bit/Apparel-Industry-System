<?php
require_once('database.php');
$oldemail= $user_value['email'];
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

  <section class="my-5" id="info">
    <!--PHP code-->
    <div>
                <?php
                if(isset($_POST["update"])){
                    $newemail = $_POST["email"];
                    $firstname = $_POST["firstname"];
                    $lastname = $_POST["lastname"];
                    $address = $_POST["address"];
                    $contact = $_POST["contact"];

                    $sql_s = "SELECT * FROM registration WHERE email='$newemail'";
                    $search = mysqli_query($connect, $sql_s);
                    $row = mysqli_num_rows($search);

                    $errors = array();

                    if(empty($newemail) OR empty($firstname) OR empty($lastname) OR empty($address) OR empty($contact)){
                        array_push($errors,"All fields are required");
                    }
                    if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)){
                        array_push($errors,"Email is not valid");
                    }
                    if($newemail!=$oldemail){
                      if($row>0){
                        array_push($errors, "Email already exists");
                      }
                    }

                    if(preg_match("/^([0-9]{11})$/",$contact)!==1){
                        array_push($errors,"Wrong Phone Number");
                    }

                    if(count($errors)>0){
                        foreach($errors as $error){
                            echo "<div class='alert alert-danger' style='padding-left:40%; margin:5px 10px ; border-radius:0'>$error</div>";
                        }
                    }
                    else{
                      $sql = "UPDATE registration SET email= '$newemail', firstname='$firstname',lastname='$lastname',address='$address', 
                              contact='$contact' WHERE email='$oldemail'";
                      $update_result = mysqli_query($connect,$sql);
                        if($update_result){
                          $_SESSION['updated']="1"; 
                          header("Location: http://localhost/project-file/account.php?update=1");
                        }
                    }
                }
                ?>
            </div>
    <div>
    <h2>Account Information</h2>
  <form class="my-4 pb-5 px-5" action="update.php" method="POST">
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="email">Email</label></div>
      <div class="col-sm-9"><input type="text" name="email" value="<?=$user_value['email'];?>" class="form-control"></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="firstname">First Name</label></div>
      <div class="col-sm-9"><input type="text" name="firstname" value="<?=$user_value['firstname'];?>" class="form-control"></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="lasttname">Last Name</label></div>
      <div class="col-sm-9"><input type="text" name="lastname" value="<?=$user_value['lastname'];?>" class="form-control" ></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="contact">Contact</label></div>
      <div class="col-sm-9"><input type="text" name="contact" value="<?=$user_value['contact'];?>" class="form-control"></div>
    </div>
    <hr>
    <div class="row mb-3 mx-2 form-text">
      <div class="col-sm-3 col-form-label"><label for="address">Shipping Address</label></div>
      <div class="col-sm-9"><input type="text" name="address" value="<?=$user_value['address'];?>" class="form-control" style="height: 80px;"></div>
    </div>
    <br>
    <div class="d-grid gap-2 d-sm-flex mt-4">
         <input type="submit" class="btn btn-outline-light custom-button rounded-pill px-5" value="Save Changes" name="update">
         <a href="http://localhost/project-file/account.php">
         <button class="btn btn-outline-light custom-button rounded-pill px-5" type="button">Go back</button></a>
    </div>

  </form>

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
