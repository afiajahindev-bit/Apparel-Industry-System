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
    <link rel="stylesheet" href="css/payment.css">
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
            if (isset($_POST["payment"])) {
                $transNum = $_POST["number"];
                $transID = $_POST['trxid'];

                if (preg_match("/^(01[0-9]{9})$/", $transNum) !== 1) {
                    echo "<div class='alert alert-danger' style='text-align:center; border-radius:0'>Enter correct Phone number! </div>";
                } else {
                    require_once('order.php');
                    Header("Location:payment.php");
                }
            }
            ?>
            <div class="container">
                <form action="nagad.php" method="post">
                    <h6 class="title"><i class="fa-solid fa-check fa-sm" style="color: #40e006;"></i> Order Recieved</h6>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p>Your order number: <?= $order_num ?></p>
                            <div class="mb-2">
                                <label for="number" class="form-label">Nagad Number</label>
                                <input type="text" id="number" name="number" class="form-control" placeholder="01XXXXXXXXX" required>
                            </div>
                            <div class="mb-4">
                                <label for="trxid" class="form-label">Transaction ID</label>
                                <input type="text" id="trxid" name="trxid" class="form-control" required>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <div style="width:25%;"><img src="images/nagad.png" alt="" class="img-fluid rounded-3"></div>
                                    <div>
                                        <small>reference number</small>
                                        <h6>
                                            <?php
                                            echo rand(100000000, 999999999);
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-5 mx-3 pb-2 pt-2 down">
                                <p class="mb-0">Payment Amount</p>
                                <p class="mb-0">Tk. <?= $_SESSION['total'] ?></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-1" style="width:90%">
                                <h6 style="font-size: 15px; padding-left:15px;">To Complete Payment:</h6>
                                <ol>
                                    <li>Visit Nagad App</li>
                                    <li>Go to 'Merchant Pay' option</li>
                                    <li>Enter Merchant number '01878-726339'</li>
                                    <li>Enter the total amount</li>
                                    <li>Add the given reference number</li>
                                    <li>Complete your payment</li>
                                    <li>Return to this page and Enter your Nagad Transaction ID</li>
                                    <li>Cofirm your payment.</li>
                                </ol>
                                <p style="font-size:0.8rem; color: #373b3e; padding-left:18px;">[ The Counter Number is 2 if you are paying manually]</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-sm-flex">
                        <input type="submit" class="btn btn-outline-light custom-button px-5" value="Comfirm Payment" name="payment">
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