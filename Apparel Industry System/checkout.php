<?php
require_once('database.php');
$query = "SELECT * FROM ORDERS ORDER BY order_num DESC limit 1";
$query_result = mysqli_query($connect, $query);
$query_value = mysqli_fetch_assoc($query_result);
$query_num = mysqli_num_rows($query_result);

if ($query_num == 0) {
    $order_num = 1;
} else {
    $lastid = $query_value['order_num'];
    $order_num = $lastid + 1;
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/d4c58442e3.js" crossorigin="anonymous"></script>
    <!--CSS-->
    <link rel="stylesheet" href="css/checkout.css">
</head>

<body>
    <section id="title">
        <div class="container-fluid">
            <h2>Royel Group</h2>
        </div>
    </section>
    <section id="checkout">
        <?php
        if (isset($_SESSION['total'])) {
        ?>
            <?php
            if (isset($_POST["order"])) {
                $paymethod = $_POST["payMethod"];
                $_SESSION['paymethod'] = $paymethod;

                if ($paymethod == "bKash") {
                    Header("Location:bkash.php");
                }
                if ($paymethod == "Nagad") {
                    Header("Location:nagad.php");
                }
                if ($paymethod == "Cash On Delivery") {
                    $transID = "NULL";
                    $transNum = "NULL";
                    require_once('order.php');
                    Header("Location:payment.php");
                } else {
                    echo "<div class='alert alert-danger' style='text-align:center; border-radius:0'>Select the payment method! </div>";
                }
            }
            ?>
            <div class="container">
                <form action="checkout.php" method="post">
                    <div class="row">
                        <div class="col">
                            <h5 class="title">Customer Details</h5>
                            <div class="mt-4">
                                <p><strong>Deliver to:
                                        <?= $user_value['firstname']; ?>
                                        <?= $user_value['lastname']; ?>
                                    </strong></p>
                                <p class="mb-0">Shipping Address : </p>
                                <p>
                                    <?= $user_value['address']; ?>
                                </p>
                                <p class="mb-0">Email : </p>
                                <p>
                                    <?= $user_value['email']; ?>
                                </p>
                                <p class="mb-0">Contact : </p>
                                <p>
                                    <?= $user_value['contact']; ?>
                                </p>
                            </div>

                        </div>

                        <div class="col">
                            <div>
                                <h5 class="title">payment</h5>
                                <label for="payMethod" class="mb-2">Payment Method: </label>
                                <select name="payMethod" class="form-select form-select-md mb-3 d-grid gap-2 d-sm-flex size" aria-label=".form-select-md example">
                                    <option value="" selected>Select Payment Method</option>
                                    <option value="Cash On Delivery">Cash On Delivery</option>
                                    <option value="bKash">bKash</option>
                                    <option value="Nagad">Nagad</option>
                                </select>
                            </div>

                            <div class="pt-4">
                                <hr>
                                <div class=" d-flex justify-content-between">
                                    <p class="mb-2">Subtotal</p>
                                    <p class="mb-2">Tk.
                                        <?= $_SESSION['subtotal'] ?>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Shipping Fee</p>
                                    <p class="mb-2">Tk.
                                        <?= $_SESSION['ship'] ?>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Total Payment</p>
                                    <p class="mb-2">Tk.
                                        <?= $_SESSION['total'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-light custom-button rounded-pill px-5" value="Place Order" name="order">
                    </div>
                </form>
            </div>
        <?php
        } else {
            header("Location:home.php");
        }
        ?>
    </section>
</body>

</html>