<?php
require_once('../database.php');
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
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

    <!-- Order list -->
    <section>
    <div class="mt-1 mb-1">
            <h2 class="text-center">Orders Pending</h2>
            <hr class="w-75 m-auto">
        </div>
        <?php
        $sql =  "SELECT * FROM orders GROUP BY order_num";
        $query = mysqli_query($connect, $sql);
        ?>
        <div class="table-responsive">
            <div class="order_list">
                <table class="table table-dark table-striped align-middle table-lg text-center">
                    <thead>
                        <tr>
                            <th scope="col">Order Number</th>
                            <th scope="col">Customer Email</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Transaction Number</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">View</th>
                            <th scope="col">Payment</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php
                        while ($result = mysqli_fetch_assoc($query)) {
                            $data = $result['order_num'];
                            $input = ($data * 123456789);
                            $encrypt = base64_encode($input);

                            if (isset($_POST['confirm' . $data])) {
                                $order = $data;
                            }
                        ?>
                            <form action="orders-check.php" method="post">
                                <tr>
                                    <th scope="row"><?= $result['order_num']; ?></th>
                                    <td><?= $result['user_email']; ?></td>
                                    <td><?= $result['order_date']; ?></td>
                                    <td><?= $result['pay_method']; ?></td>
                                    <td><?= $result['transaction_id']; ?></td>
                                    <td><?= $result['transaction_number']; ?></td>
                                    <td><?= $result['pay_status']; ?></td>
                                    <td><a href="order_details.php?id=<?= $encrypt ?>"><input type="button" class="btn btn-outline-light rounded-1 mx-2" style="font-size: small;" value="Order Details"></a></td>
                                    <td><a href="order_details.php"><input type="submit" class="btn btn-outline-light rounded-1 mx-2" style="font-size: small;" name="confirm<?= $result['order_num']; ?>" value="Confirm"></a></td>
                                </tr>
                            </form>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php
    if(isset($order)){
        $sql = "UPDATE `orders` SET `pay_status`='Paid' WHERE `order_num`='$order'";
        $query = mysqli_query($connect,$sql);
        echo "<script> window.location.href='orders-check.php';</script>";
    }
    ?>

    <!--Footer-->

    <section class="white-section" id="footer">
        <?php
        require_once('footer.php');
        ?>

    </section>


</body>

</html>