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
    <!-- Fabric -->
    <?php
    if (isset($_POST['fab_upload'])) {
        $name = $_POST['name'];
        $tshirt = $_POST['tshirt'];
        $kurta_men = $_POST['kurta_men'];
        $kurta_women = $_POST['kurta_women'];

        $folder = "../images/";
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $path = $folder . $image;
        $imageType = pathinfo($path, PATHINFO_EXTENSION);

        $errors = array();
        if ($imageType != "jpg" && $imageType != "jpeg" && $imageType != "png" && $imageType != "JPG" && $imageType != "JPEG" && $imageType != "PNG") {
            array_push($errors, "Image Format not supported");
        } else {
            if ($_FILES['image']['size'] > 2097152) {
                array_push($errors, "Image must be less than 2 MB.");
            }
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger' style='padding-left:40%; margin:5px 10px ; border-radius:0'>$error</div>";
            }
        } else {
            move_uploaded_file($tmp, $path);
            $sql = "INSERT INTO `fabrics`(`Image`, `Name`, `T-shirt`, `Kurta(For Men)`, `Kurta(For Women)`) VALUES (?,?,?,?,?)";
            $stmtinsert = $connect->prepare($sql);
            if ($stmtinsert) {
                $result = $stmtinsert->execute([$image, $name, $tshirt, $kurta_men, $kurta_women]);
                $_SESSION['upload'] = 1;
                header("Location: edit-fabric.php");
            }
        }
    }
    ?>

    <!-- Fabric -->
    <?php
    if ($_SESSION['upload_info'] == "fabric") {
    ?>
        <div class="new m-auto mb-5" style="width:80%;">
            <form class="form" action="add.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <div class="col-sm-3 col-form-label"><label for="image">Fabric Image</label></div>
                    <div class="col-sm-9"><input type="file" class="form-control" name="image" accept="image/png, image/jpg, image/jpeg" required>
                        <small class="text-warning">Image must be less than 2 MB</small>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-3 col-form-label"> <label for="name">Fabric Name</label></div>
                    <div class="col-sm-9"> <input type="text" class="form-control" name="name" required></div>
                </div>
                <br>
                <div class="text-left">
                    <h5>Pricing</h5>
                    <div class="row form-text justify-content-evenly">
                        <div class="col-md-4">
                            <label for="tshirt" class="form-label">T-Shirt</label>
                            <input type="number" min="0" class="form-control" name="tshirt" required>
                        </div>
                        <div class="col-md-4">
                            <label for="kurta_men" class="form-label">Kurta(For Men)</label>
                            <input type="number" min="0" class="form-control" name="kurta_men" required>
                        </div>
                        <div class="col-md-4">
                            <label for="kurta_women" class="form-label">Kurta(For Women)</label>
                            <input type="number" min="0" class="form-control" name="kurta_women" required>
                        </div>
                    </div>
                </div>
                <div><input type="submit" class="btn custom-button mt-4" name="fab_upload" value="Upload"></div>
            </form>
        </div>
    <?php } ?>
    <!-- Pattern -->

    <?php
    if (isset($_POST['print_upload'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['desc'];

        $folder = "../images/";
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $path = $folder . $image;
        $imageType = pathinfo($path, PATHINFO_EXTENSION);

        $errors = array();
        if ($imageType != "jpg" && $imageType != "jpeg" && $imageType != "png" && $imageType != "JPG" && $imageType != "JPEG" && $imageType != "PNG") {
            array_push($errors, "Image Format not supported");
        } else {
            if ($_FILES['image']['size'] > 2097152) {
                array_push($errors, "Image must be less than 2 MB.");
            }
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger' style='padding-left:40%; margin:5px 10px ; border-radius:0'>$error</div>";
            }
        } else {
            move_uploaded_file($tmp, $path);
            $sql = "INSERT INTO `printing`(`Image`, `Name`, `Price`, `Description`) VALUES (?,?,?,?)";
            $stmtinsert = $connect->prepare($sql);
            if ($stmtinsert) {
                $result = $stmtinsert->execute([$image, $name, $price, $description]);
                $_SESSION['upload'] = 1;
                header("Location: edit-print.php");
            }
        }
    }
    ?>
    <!-- Pattern -->
    <?php
    if ($_SESSION['upload_info'] == "print") {
    ?>
        <div class="new m-auto mb-5" style="width:80%;">
            <form class="form" action="add.php" method="post" enctype="multipart/form-data">
                <div class="input-group form-text">
                    <div class="col-sm-3 col-form-label"><label for="image">Pattern Image</label></div>
                    <div class="col-sm-9"><input type="file" class="form-control" name="image" accept="image/png, image/jpg, image/jpeg" required>
                        <small class="text-warning">Image must be less than 2 MB</small>
                    </div>
                </div><br>
                <div class="row form-text">
                    <div class="col-sm-3 col-form-label"> <label for="name">Pattern Name</label></div>
                    <div class="col-sm-9"> <input type="text" class="form-control" name="name" required></div>
                </div><br>
                <div class="row form-text">
                    <div class="col-sm-3 col-form-label"> <label for="name">Price</label></div>
                    <div class="col-sm-9"> <input type="number" class="form-control" name="price" required></div>
                </div><br>
                <div class="row form-text">
                    <div class="col-sm-3 col-form-label"> <label for="name">Description</label></div>
                    <div class="col-sm-9"> <textarea class="form-control" name="desc" rows="8" required></textarea></div>
                </div><br>

                <div><input type="submit" class="btn custom-button mt-4" name="print_upload" value="Upload"></div>
            </form>
        </div>
    <?php } ?>

    <!--Footer-->

    <section class="white-section" id="footer">
        <?php
        require_once('footer.php');
        ?>
    </section>
</body>

</html>