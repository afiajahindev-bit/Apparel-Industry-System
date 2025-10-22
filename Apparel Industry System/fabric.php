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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/d4c58442e3.js" crossorigin="anonymous"></script>
    <!--CSS-->
    <link rel="stylesheet" href="css/fabric.css">
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
                <div class="row">
                    <div class="col-lg-6">
                        <h1>FABRIC PRINTING.</h1>
                        <p>Do you want to custom print on your preferable fabric? Than you are on the right place! Durable
                            and the highest quality of fabric printing on sewing fabrics.</p>
                    </div>

                    <div class="col-lg-6 text-center align-middle">
                        <img class="title-image align-middle rounded-circle" style="width:70%;" href="" src="images/b.jpg" alt="cloth-logo">
                    </div>
                </div>

            </div>

        </div>
        </div>
    </section>
    <!--Collection-->

    <section id="collection">
        <h2 class="display-6 py-5">Fabric Collection</h2>

        <div class="col col-9 d-flex flex-wrap justify-content-between box m-auto mb-5">
            <?php
            $query = "SELECT * FROM fabrics";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="card m-4">
                    <?php
                    $data = $row['id'];
                    $input = ($data * 123456789);
                    $encrypt = base64_encode($input);
                    ?>
                    <a href="http://localhost/project-file/fab-details.php?id=<?= $encrypt; ?>">
                        <img src="images/<?= $row['Image']; ?>" class="card-img-top" height="300" alt="">
                    </a>
                    <div class="card-body">
                        <p class="card-text fw-bold"><?= $row['Name']; ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
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