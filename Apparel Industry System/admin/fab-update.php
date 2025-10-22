<?php

require_once('../database.php');

if (isset($_GET['id'])) {
    $in = $_GET['id'];
    $_SESSION['input'] = $in;
    $input = $_SESSION['input'];
    $fab_id = (base64_decode($input) / 123456789);
    $fab_sql = "SELECT * FROM fabrics where id='$fab_id'";
    $fab_result = mysqli_query($connect, $fab_sql);
    $fab_value = mysqli_fetch_assoc($fab_result);
    $str = ltrim($fab_value['Kurta(For Men)']);
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

    <!--Details-->
    <section id="details">
        <?php
        if (isset($_POST['update'])) {
            $errors = array();
            $Name = $_POST['name'];
            $tshirt = $_POST['t-shirt'];
            $kurta_men = $_POST['kurta-men'];
            $kurta_women = $_POST['kurta_women'];
            $id = $fab_value['id'];

            if ($_FILES['image']['name']) {
                $folder = "../images/";
                $image = $_FILES['image']['name'];
                $tmp = $_FILES['image']['tmp_name'];
                $path = $folder . $image;
                $imageType = pathinfo($path, PATHINFO_EXTENSION);

                if ($imageType != "jpg" && $imageType != "jpeg" && $imageType != "png" && $imageType != "JPG" && $imageType != "JPEG" && $imageType != "PNG") {
                    array_push($errors, "Image Format not supported");
                } else {
                    if ($_FILES['image']['size'] > 2097152) {
                        array_push($errors, "Image must be less than 2 MB.");
                    }
                }
            } else {
                $image = $fab_value['Image'];
            }

            if (empty($Name) or empty($tshirt) or empty($kurta_men) or empty($kurta_women)) {
                array_push($errors, "All fields are required");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger' style='padding-left:40%; margin:5px 10px ; border-radius:0'>$error</div>";
                }
            } else {
                if($_FILES['image']['tmp_name']){
                    move_uploaded_file($tmp, $path);
                }
                
                $sql = "UPDATE `fabrics` SET `Image`='$image', `Name`='$Name',`T-shirt`='$tshirt',`Kurta(For Men)`='$kurta_men',`Kurta(For Women)`='$kurta_women' WHERE id = '$id'";
                $update_result = mysqli_query($connect, $sql);

                if ($update_result) {
                    $status = "Updated";
                    echo "<script> window.location.href='fab-update.php?id=$input;</script>";
                }
                else{
                    echo "<div class='alert alert-danger' style='padding-left:40%; margin:5px 10px ; border-radius:0'>Update Failed</div>"; 
                }
            }
        }
        ?>
        <?php
        if (isset($status)) {
            echo "<div class='alert alert-success' style='padding-left:40%; margin:5px 10px ; border-radius:0'>Updated Successfully</div>";
        }
        ?>
        <form action="fab-update.php?id=<?= $input; ?>" method="post" enctype="multipart/form-data">
            <div class="row mt-0">
                <div class="col-lg-4 mb-5">
                    <div style="margin-left:20%;">
                        <img style="width:60%;" src="../images/<?= $fab_value['Image']; ?>" alt="">
                        <div>
                            <p class="mt-4 mb-1">Change Pattern Image</p>
                            <input type="file" class="form-control" name="image" accept="image/png, image/jpg, image/jpeg">
                            <small class="text-warning">Image must be less than 2 MB</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div>
                        <h2 class="mb-4"> Fabric Name:
                            <?= $fab_value['Name']; ?>
                        </h2>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <div>
                            <h5 class="mt-4 mb-2"><strong> Pricing </strong>
                            </h5>
                            <div class="my-4 mx-2 px-5">

                                <table class="table">
                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col">Name</th>
                                            <th scope="col">T-Shirt</th>
                                            <th scope="col">Kurta(For Men)</th>
                                            <th scope="col">Kurta(For Women)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="name" value="<?= $fab_value['Name']; ?>" class="form-control"></td>
                                            <td><input type="number" min="2" name="t-shirt" value="<?= $fab_value['T-shirt']; ?>" class="form-control"></td>
                                            <td><input type="number" min="2" name="kurta-men" value="<?= $str; ?>" class="form-control"></td>
                                            <td><input type="number" min="2" name="kurta_women" value="<?= $fab_value['Kurta(For Women)']; ?>" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="submit" style="width: 35%;" class="btn btn-outline-dark rounded-1" name="update" value="Update">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>


    <!--Footer-->
    <section class="white-section" id="footer">
        <?php
        require_once('footer.php');
        ?>

    </section>

</body>

</html>