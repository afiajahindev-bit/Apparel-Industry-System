<?php

require_once('database.php');
$total = 0;
$ship = 300;
$email = $_SESSION['user_email'];
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
    <link rel="stylesheet" href="css/cart.css">
</head>

<body>
    <!--Header-->
    <section class="colored-section" id="title">

        <!--Navigation-->
        <?php
        require('Navigation.php');
        ?>
    </section>

    <!--cart-->
    <section id="cart">
        <?php
        $cart_sql = "SELECT * FROM CART WHERE user_email='$email'";
        $qyery_run = mysqli_query($connect, $cart_sql);
        $row_num = mysqli_num_rows($qyery_run);

        if (isset($_POST["checkout"])) {
            $orders = $_POST["cart-check"];


            if (empty($orders)) {
                echo "<div class='alert alert-danger' style='text-align:center; border-radius:0'> Nothing is selected </div>";
            } else {
                $_SESSION['orders'] = $orders;
                header("Location: checkout.php");
            }
        }
        ?>
        <div class="box justify-content-center">
            <div class="card">
                <div class="card-body">
                    <h2>Order Cart</h2>
                    <hr>
                    <?php
                    if ($row_num == 0) {
                    ?>
                        <div class="none">
                            <p> There is no order prepared in the cart yet.</p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <p class="mx-5">You have <?= $row_num ?> items in your cart</p>
                        <form action="cart.php" method="post">
                            <div class="row">
                                <div class="col-lg-7 col-sm-12">
                                    <div class="form-check">
                                        <?php
                                        while ($cart_row = mysqli_fetch_assoc($qyery_run)) {
                                        ?>
                                            <input class="form-check-input" type="checkbox" name="cart-check[]" value="<?= $cart_row['id']; ?>" id="<?= $cart_row['id']; ?>" checked>
                                            <label class="form-check-label" for="<?= $cart_row['id']; ?>">
                                                <div class="card shadow mb-4 mx-5">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex flex-row">
                                                                <div style="width: 18%;">
                                                                    <img src="images/<?= $cart_row['pattern_image']; ?>" class="img-fluid rounded-3">
                                                                </div>
                                                                <div class="mx-4">
                                                                    <div>
                                                                        <h5><?= $cart_row['pattern_name']; ?></h5>
                                                                        <p class="small mb-0">Fabric: <?= $cart_row['fabric_name']; ?></p>
                                                                        <p class="small mb-0">Pattern Size: <?= $cart_row['pattern_size']; ?></p>
                                                                        <p class="small mb-0">Costume Type: <?= $cart_row['costume_type']; ?></p>
                                                                        <p class="small mb-0">Body Size: <?= $cart_row['body_size']; ?></p>
                                                                        <p class="small mb-0">Costume Color: <?= $cart_row['costume_color']; ?></p>
                                                                        <p class="small mb-0">Quantity: <?= $cart_row['quantitiy']; ?></p>

                                                                        <div class="mt-3">
                                                                            <p class="mb-0">Fabric Cost: Tk. <?= $cart_row['costume_cost']; ?></p>
                                                                            <p class="mb-0">Printing Cost: Tk. <?= $cart_row['printing_cost']; ?></p>
                                                                            <?php
                                                                            $total = $total + $cart_row['costume_cost'] + $cart_row['printing_cost'];
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex flex-row align-items-center">
                                                                <a href="http://localhost/project-file/remove-cart.php?rid=<?= $cart_row['id']; ?>"><i class="fa-solid fa-circle-minus fa-xl mx-3" style="color: #d21922;"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-12">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Subtotal</p>
                                        <p class="mb-2">Tk. <?= $total; ?></p>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Shipping Fee</p>
                                        <p class="mb-2">Tk. <?= $ship; ?></p>
                                    </div>

                                    <div class="d-flex justify-content-between mb-4">
                                        <p class="mb-2">Total Payment</p>
                                        <p class="mb-2">Tk. <?= $total + $ship; ?></p>
                                    </div>
                                    <div>
                                        <input class="btn btn-outline-light custom-button rounded-pill mt-4 mb-4" type="submit" value="Checkout" name="checkout">
                                    </div>
                                    <?php
                                    $_SESSION['subtotal'] = $total;
                                    $_SESSION['ship'] = $ship;
                                    $_SESSION['total'] = $total + $ship;
                                    ?>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        <?php
                    }
        ?>
        </div>
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