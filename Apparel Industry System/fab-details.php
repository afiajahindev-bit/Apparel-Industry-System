<?php

require_once('database.php');

if (isset($_GET['id'])) {
    $input = $_GET['id'];
    $fab_id = (base64_decode($input) / 123456789);
    $fab_sql = "SELECT * FROM fabrics where id='$fab_id'";
    $fab_result = mysqli_query($connect, $fab_sql);
    $fab_value = mysqli_fetch_assoc($fab_result);
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
        <form action="">
            <div class="row mt-0">
                <div class="col-lg-6 mb-5">
                    <img style="width:70%; margin-left:15%;" src="images/<?= $fab_value['Image']; ?>" alt="">
                </div>
                <div class="col-lg-6">
                    <!--title part-->
                    <div class="name">
                        <h2 class="mb-4" id="productName"> Fabric Name:
                            <?= $fab_value['Name']; ?>
                        </h2>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <!--costume info-->
                        <div>
                            <h5 class="mt-4 mb-2"><strong> Fabric Information </strong>
                            </h5>
                            <div>
                                <h5>Prices: </h5>
                            </div>
                            <div class="my-4 mx-2">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr class="table-success">
                                            <th scope="col">#</th>
                                            <th scope="col">T-Shirt</th>
                                            <th scope="col">Kurta(Men)</th>
                                            <th scope="col">Kurta(Women)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-warning">
                                            <th scope="row">(Tk.)</th>
                                            <td><?= $fab_value['T-shirt']; ?></td>
                                            <td><?= $fab_value['Kurta(For Men)']; ?></td>
                                            <td><?= $fab_value['Kurta(For Women)']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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