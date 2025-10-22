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

    <!-- Customer list -->
    <section>
    <div class="mt-1 mb-3">
            <h2 class="text-center">Registered Customers</h2>
            <hr class="w-75 m-auto">
        </div>
        <?php
        $sql =  "SELECT * FROM registration";
        $query = mysqli_query($connect, $sql);
        ?>
        <div class="table-responsive">
            <div class="cust_list">
                <table class="table table-dark table-striped align-middle table-lg">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $result['id']; ?></th>
                                <td><?= $result['email']; ?></td>
                                <td><?= $result['firstname']; ?></td>
                                <td><?= $result['lastname']; ?></td>
                                <td><?= $result['address']; ?></td>
                                <td><?= $result['contact']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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