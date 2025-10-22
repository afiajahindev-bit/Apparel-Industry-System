<?php
require_once('../database.php');

$query1 = mysqli_query($connect, "SELECT * FROM registration");
$row_cust = mysqli_num_rows($query1);
$query2 = mysqli_query($connect, "SELECT * FROM fabrics");
$row_fab = mysqli_num_rows($query2);
$query3 = mysqli_query($connect, "SELECT * FROM printing");
$row_print = mysqli_num_rows($query3);
$query4 = mysqli_query($connect, "SELECT * FROM orders GROUP BY order_num");
$row_order = mysqli_num_rows($query4);

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

  <!-- Information -->
  <section id="info">
    <div class="info">
      <div class="row">
        <div class="col col-lg-4 col-md-6 col-sm-12">
          <div class="card">
            <h5 class="card-header">Customers</h5>
            <a href="customer.php"><button type="button" class="btn">
                <div class="card-body">
                  <div class="row mt-2">
                    <div class="col text-start">
                      <h3 class="card-title"><?= $row_cust ?></h3>
                      <p class="card-text">Total Customers</p>
                    </div>
                    <div class="col">
                      <i class="fa-solid fa-users fa-2xl"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  Check customer list
                </div>
              </button></a>
          </div>
        </div>

        <div class="col col-lg-4 col-md-6 col-sm-12">
          <div class="card">
            <h5 class="card-header">Fabrics</h5>
            <a href="edit-fabric.php"><button type="button" class="btn">
                <div class="card-body">
                  <div class="row">
                    <div class="col text-start">
                      <h3 class="card-title"><?= $row_fab ?></h3>
                      <p class="card-text">Total Fabrics Available</p>
                    </div>
                    <div class="col">
                      <i class="fa-regular fa-folder-open fa-2xl"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  Update fabric list
                </div>
              </button></a>
          </div>
        </div>

        <div class="col col-lg-4 col-md-6 col-sm-12">
          <div class="card">
            <h5 class="card-header">Print Collection</h5>
            <a href="edit-print.php"><button type="button" class="btn">
                <div class="card-body">
                  <div class="row">
                    <div class="col text-start">
                      <h3 class="card-title"><?= $row_print ?></h3>
                      <p class="card-text">Total Prints in collection</p>
                    </div>
                    <div class="col">
                      <i class="fa-solid fa-layer-group fa-2xl"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  Update printing list
                </div>
              </button></a>
          </div>
        </div>

        <div class="col col-lg-4 col-md-6 col-sm-12">
          <div class="card">
            <h5 class="card-header">Orders</h5>
            <a href="orders-check.php"><button type="button" class="btn">
                <div class="card-body">
                  <div class="row">
                    <div class="col text-start">
                      <h3 class="card-title"><?= $row_order ?></h3>
                      <p class="card-text">Total Orders in the list</p>
                    </div>
                    <div class="col">
                      <i class="fa-solid fa-list-check fa-2xl"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  Check order list
                </div>
              </button></a>
          </div>
        </div>


      </div>
    </div>

  </section>

  <!--Footer-->

  <section class="white-section" id="footer">
    <?php
    require_once('footer.php');
    ?>

  </section>

</body>

</html>