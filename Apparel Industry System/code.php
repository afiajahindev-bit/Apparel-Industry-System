<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width">
    <title>Royel Group</title>
    <!--Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--CSS-->
    <link rel="stylesheet" href="css/log.css">
</head>

<body>

    <div>
        <input type="hidden" class="btn-check " name="fab-options" id="fab" value="" checked>
        <?php
        require_once('database.php');
        $query = "SELECT * FROM fabrics";
        $result = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <input type="radio" class="btn-check " name="fab-options" id="fab-<?= $row['id']; ?>" value="<?= $row['Name']; ?>" onclick="myFunction()">
            <label class="btn btn-light btn-outline-dark fabric-label" for="fab-<?= $row['id']; ?>">
                <h4><?= $row['Name']; ?></h4>
            </label>
            <script>
                function myFunction() {
                    var name_element = document.getElementById('<?= $row['id']; ?>');
                    var user_name = name_element.value;
                    document.cookie = "name = " + user_name;
                }
            </script>
        <?php
        }
        $name = $_COOKIE['name'];
        echo $name;
        ?>
    </div>

    <?php
    $passing_value = $_COOKIE['selected_item'];
    echo $passing_value;
    ?>

    <script>
        let selected_text =  "Pass value from javascript to PHP";
        document.cookie = "selected_item"+selected_text;
    </script>



</body>

</html>

<div class="card-body">
                        <?php
                        if (isset($_POST['update'])) {
                            header("Location: fab_update.php?id=$encrypt");
                        } else if (isset($_POST['delete'])) {
                            $sql = "DELETE * FROM fabrics WHERE id = '$data'";
                            $sql_query = mysqli_query($connect, $sql);
                        }
                        ?>
                        <form action="edit-fabric.php" method="post">
                            <p class="card-text fw-bold"><?= $row['Name']; ?></p>
                            <input type="submit" style="width: 35%;" class="btn btn-outline-primary rounded-1 mx-2" name="update" value="Update">
                            <input type="submit" style="width: 35%;" class="btn btn-outline-danger rounded-1 mx-2" name="delete" value="Delete">
                        </form>
                    </div>