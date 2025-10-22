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


    <!-- Collection -->
    <section class="collection">
        <div class="mt-1 mb-3">
            <h2>Fabric Collection</h2>
            <hr class="w-75 m-auto">
        </div>

        <!-- Add new -->
        <div class="new m-auto" style="width:80%;">
            <?php
            if (isset($_POST['new'])) {
                $_SESSION['upload_info'] = "fabric";
                header("Location: add.php");
            }
            if (isset($_SESSION['upload'])) {
                echo "<div class='alert alert-success' style=' margin:5px 10px ; border-radius:0'>Fabric Added Successfully</div>";
                unset($_SESSION['upload']);
            }
            ?>
            <form action="edit-fabric.php" method="post">
                <div class="d-grid gap-2 d-flex justify-content-end">
                    <input class="btn mr-4 custom-button" style="margin-right: 55px;" type="submit" name="new" value="+ Add New Fabric">
                </div>
            </form>
        </div>

        <!--List-->
        <div class="col col-9 d-flex flex-wrap justify-content-around m-auto mb-5" style="width:80%;">

            <?php
            $query = "SELECT * FROM fabrics";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="card my-4">
                    <?php
                    $data = $row['id'];
                    $input = ($data * 123456789);
                    $encrypt = base64_encode($input);
                    ?>
                    <img src="../images/<?= $row['Image']; ?>" class="card-img-top" height="300" alt="">
                    <div class="card-body">
                        <?php
                        if (isset($_POST['delete' . $data])) {
                            $sql = "DELETE FROM fabrics WHERE id = '$data'";
                            $sql_query = mysqli_query($connect, $sql);
                            echo "<script>window.location.reload();</script>";
                        }
                        ?>
                        <form action="edit-fabric.php" method="post">
                            <p class="card-text fw-bold"><?= $row['Name']; ?></p>
                            <a href="fab-update.php?id=<?=$encrypt?>"><input type="button" style="width: 35%;" class="btn btn-outline-primary rounded-1 mx-2" value="Update"></a>
                            <input type="submit" style="width: 35%;" class="btn btn-outline-danger rounded-1 mx-2" name="delete<?= $data ?>" value="Delete" onclick="return checkdelete()">
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <!--Footer-->

    <section class="white-section" id="footer">
        <?php
        require_once('footer.php');
        ?>
    </section>

</body>

<script>
    function checkdelete(){
        return confirm('Are you sure you want to delete this Fabric record?');
    }
</script>

</html>