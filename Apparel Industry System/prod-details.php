<?php

require_once('database.php');

if (isset($_GET['id'])) {
    $input = $_GET['id'];
    $prod_id = (base64_decode($input) / 123456789);
    $prod_sql = "SELECT * FROM printing where id='$prod_id'";
    $prod_result = mysqli_query($connect, $prod_sql);
    $prod_value = mysqli_fetch_assoc($prod_result);
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/d4c58442e3.js" crossorigin="anonymous"></script>
    <!--CSS-->
    <link rel="stylesheet" href="css/prod_details.css">
</head>

<body>
    <!--Header-->

    <section class="colored-section" id="title">

        <!--Navigation-->
        <?php
        require('Navigation.php');
        ?>
    </section>

    <!--Details-->
    <section id="details">
        <?php
        if (isset($_POST["cart"])) {
            if (isset($_SESSION['logged'])) {
                $email = $_SESSION['user_email'];
                $image = $prod_value['Image'];
                $pname = $prod_value['Name'];
                $pprice = $prod_value['Price'];
                $psize = $_POST['selectedSize'];
                $fname = $_POST['fab-options'];
                $bsize = $_POST['costumeSize'];
                $ctype = $_POST['costumeType'];
                $ccolor = $_POST['chooseColor'];
                $quantity = $_POST['quantity'];

                $errors = array();

                if (empty($pname) or empty($pprice) or empty($psize) or empty($fname) or empty($bsize) or empty($bsize) or empty($ctype) or empty($ccolor) or empty($quantity)) {
                    array_push($errors, "All information fields are required");
                }
                if (!empty($fname) or !empty($ctype) or !empty($quantity)) {
                    $sql_fab =  "SELECT `$ctype` AS customer FROM `fabrics` WHERE Name = 'Satin'";
                    $fab_result = mysqli_query($connect, $sql_fab);
                    $fab_value = mysqli_fetch_assoc($fab_result);
                    $fab_cost= $fab_value['customer'];

                    if (preg_match("/^[0-9]+$/", $fab_cost) !== 1) {
                        array_push($errors, "An Error occured");
                    }else{
                    $ccost = ($fab_cost * $quantity);
                    }
                }

                if (preg_match("/^[0-9]+$/", $pprice) !== 1) {
                    array_push($errors, "An Error occured");
                } else {
                    if (!empty($quantity)) {
                        $pcost = ($pprice * $quantity);
                    }
                }

                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger' style='padding-left:40%; margin:5px 10px ; border-radius:0'>$error</div>";
                    }
                } else {
                    $sql = "INSERT INTO cart (user_email, pattern_name, pattern_image, pattern_size, fabric_name, body_size, costume_type, costume_color, 
                            quantitiy, printing_cost, costume_cost ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                    $stmtinsert = $connect->prepare($sql);

                    if ($stmtinsert) {
                        $result = $stmtinsert->execute([$email, $pname, $image, $psize, $fname, $bsize, $ctype, $ccolor, $quantity, $pcost,$ccost]);
        ?>
                        <div class='alert alert-success' style='text-align:center;'>Added to your cart!</div>
        <?php
                    }
                }
            } else {
                echo "<div class='alert alert-danger' style='text-align:center; border-radius:0'>You are not Logged in! </div>";
            }
        }
        ?>
        <form action="prod-details.php?id=<?= $input; ?>" method="post">
            <div class="row mt-4">
                <div class="col-lg-6 Description">
                    <img src="images/<?= $prod_value['Image']; ?>" alt="">
                    <h3 class="mt-4 ml-2">Description</h3>
                    <p class="pb-4 ml-2">
                        <?= $prod_value['Description']; ?>
                    </p>
                </div>
                <div class="col-lg-6 select">
                    <!--title part-->
                    <div class="name">
                        <h2 id="productName"> Pattern Name:
                            <?= $prod_value['Name']; ?>
                        </h2>
                        <div class="my-2"><small style="font-size:20px;">Price: Tk.
                                <?= $prod_value['Price']; ?> per piece
                            </small></div>
                    </div>
                    <div class="mt-5">
                        <!--Pattern info-->
                        <div>
                            <h5 class="mt-4 mb-2" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                                <strong> 1. Pattern </strong>
                            </h5>
                            <div class="row my-3 mx-2 collapse" id="collapseExample1">
                                <div class="col-sm-3 col-form-label"><label for="selectedSize">Pattern Size:</label>
                                </div>
                                <div class="col-sm-9">
                                    <select name="selectedSize" class="form-select form-select-md mb-3 d-grid gap-2 d-sm-flex size" aria-label=".form-select-md example">
                                        <option value="" selected>Choose Pattern size</option>
                                        <option value="8/12 Inch">8/12 Inch</option>
                                        <option value="11/16 Inch">11/16 Inch</option>
                                        <option value="23/39 Inch">23/39 Inch</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--Fabric info-->
                        <div>
                            <h5 class="mt-4 mb-2" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <strong> 2. Fabric</strong>
                            </h5>

                            <div class="collapse my-3" id="collapseExample2">
                                <input type="hidden" class="btn-check " name="fab-options" id="fab" value="" checked>
                                <?php
                                $query = "SELECT * FROM fabrics";
                                $result = mysqli_query($connect, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <input type="radio" class="btn-check " name="fab-options" id="fab-<?= $row['id']; ?>" value="<?= $row['Name']; ?>">
                                    <label class="btn btn-light fabric-label" for="fab-<?= $row['id']; ?>">
                                        <h4><?= $row['Name']; ?></h4>
                                        <small>
                                            <div class="row mx-1 mt-3 my-0 form-text text-start">
                                                <div class="col-sm-6 col-form-label col-leb"><label for="tshirt">T-shirt: </label></div>
                                                <div class="col-sm-6 my-0"><input type="text" id="tshirt" value="Tk. <?= $row['T-shirt']; ?> " class="form-control-plaintext col-leb" readonly></div>
                                            </div>
                                        </small>
                                        <small>
                                            <div class="row mx-1 mb-0 form-text text-start">
                                                <div class="col-sm-6 col-form-label col-leb"><label for="kurta_m">Kurta(Men): </label></div>
                                                <div class="col-sm-6 my-0"><input type="text" id="kurta_m" value="Tk. <?= $row['Kurta(For Men)']; ?>" class="form-control-plaintext col-leb" readonly></div>
                                            </div>
                                        </small>
                                        <small>
                                            <div class="row mx-1 mb-0 form-text text-start">
                                                <div class="col-sm-6 col-form-label col-leb"><label for="kurta_w">Kurta(Women): </label></div>
                                                <div class="col-sm-6 my-0"><input type="text" id="kurta_w" value="Tk. <?= $row['Kurta(For Women)']; ?>" class="form-control-plaintext col-leb" readonly></div>
                                            </div>
                                        </small>
                                    </label>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!--costume info-->
                        <div>
                            <h5 class="mt-4 mb-2" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                                <strong> 3. Costume </strong>
                            </h5>
                            <div class="collapse" id="collapseExample3">
                                <div class="row my-4 mx-2">
                                    <div class="col-sm-3 col-form-label"><label for="costumeSize">Body Size: </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select name="costumeSize" class="form-select form-select-md mb-3 d-grid gap-2 d-sm-flex size" aria-label=".form-select-md example">
                                            <option value="" selected>Choose Body size</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                            <option value="XXXL">XXXL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-2 mx-2">
                                    <div class="col-sm-3 col-form-label"><label for="costumeType">Costume Type: </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select name="costumeType" class="form-select form-select-md mb-3 d-grid gap-2 d-sm-flex size" aria-label=".form-select-md example">
                                            <option value="" selected>Choose Costume Type</option>
                                            <option value="T-shirt">T-shirt</option>
                                            <option value="Kurta(For Men)">Kurta(For Men)</option>
                                            <option value="Kurta(For Women)">Kurta(For Women)</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                                <div class="row my-2 mx-2">
                                    <div class="col-sm-3 col-form-label"><label for="color">Costume Color: </label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="chooseColor" id="black" value="Black" checked>
                                            <label class="form-check-label" for="black">Black </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="chooseColor" id="white" value="White">
                                            <label class="form-check-label" for="white">White</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="chooseColor" id="red" value="Red">
                                            <label class="form-check-label" for="red">Red</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="chooseColor" id="green" value="Green">
                                            <label class="form-check-label" for="green">Green</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="chooseColor" id="blue" value="Blue">
                                            <label class="form-check-label" for="blue">Blue</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="chooseColor" id="orange" value="Orange">
                                            <label class="form-check-label" for="orange">Orange</label>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row my-2 mx-2">
                                    <div class="col-sm-3 col-form-label"><label for="quantity">Quantity: </label></div>
                                    <div class="col-sm-9">
                                        <input type="number" name="quantity" min="2" class="form-control mb-3 d-grid gap-2 d-sm-flex size"><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-sm-flex mt-4">
                            <input type="submit" class="btn btn-outline-light custom-button rounded-pill px-5" value="ADD TO CART" name="cart">
                        </div>
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
                    <a class="btn btn-outline-light btn-floating m-1 text-white mx-3" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-floating m-1 text-white mx-3" href="#!" role="button"><i class="fab fa-twitter"></i></a>
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