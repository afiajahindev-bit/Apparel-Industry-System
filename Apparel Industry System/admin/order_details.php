<?php
require_once('../database.php');
$total = 0;
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
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!--Header-->
    <section class="colored-section" id="title">

        <!--Navigation-->
        <?php
        require('admin-nav.php');
        ?>
    </section>

    <section id="cart">
        <?php
        $input = $_GET['id'];
        $order_id = (base64_decode($input) / 123456789);

        $sql = "SELECT * FROM orders where order_num='$order_id'";
        $query = mysqli_query($connect, $sql);
        ?>

        <div class="box justify-content-center">
        <div class="my-4 pl-5">
            <h4><i class="fa-regular fa-square-full" style="color: #808693;"></i> Order Number <?=$order_id?></h4>
        </div>
            <div class="card shadow">
                <div class="card-body">
                    <form action="cart.php" method="post">
                        <div class="row">
                            <div class="col-lg-5 col-sm-12">
                                <h3>Order Details</h3>
                                <hr>
                                <?php
                                $value =  mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                $id = $value['user_email'];

                                $sql_user = "SELECT * FROM registration WHERE email = '$id'";
                                $query_user = mysqli_query($connect, $sql_user);
                                $row = mysqli_fetch_assoc($query_user);
                                ?>
                                <div class="form-text">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="<?= $row['firstname'] ?> <?= $row['lastname'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" value="<?= $row['email'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact" class="form-label">Contact</label>
                                        <input type="text" class="form-control" name="contact" value="<?= $row['contact'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Shipping Address</label>
                                        <textarea class="form-control" name="address" readonly><?= $row['address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-12">
                                <h3>Delivery Details</h3>
                                <hr>
                                <div>
                                    <?php
                                    while ($result = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <div class="card mb-4 mx-5">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="d-flex flex-row justify-content-evenly">
                                                        <div style="width: 25%;">
                                                            <img src="../images/<?= $result['pattern_image']; ?>" class="img-fluid rounded-3">
                                                        </div>
                                                        <div class="mx-4">
                                                            <div>
                                                                <p class=" mb-2"><strong>Pattern Name: <?= $result['pattern_name']; ?></strong></p>
                                                                <?php
                                                                $lines = explode(";", $result['order_details']);
                                                                foreach ($lines as $line) {
                                                                ?>
                                                                    <p class="small mb-0"><?= $line; ?></p>
                                                                <?php } ?>

                                                                <p class="small mb-0 mt-2"><strong>Amount: Tk.<?= $result['amount']; ?></strong></p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $total = $total + $result['amount'];
                                    }
                                    ?>
                                </div>
                                <div class="d-flex justify-content-end mx-5">
                                    <div class="d-flex justify-content-evenly mt-4 w-50">
                                        <h5 class="mb-2">Total Amount</h5>
                                        <h5 class="mb-2">Tk. <?= $total; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>>
    </section>