<?php
require_once('database.php');

$sql_admin =  "SELECT * FROM `admin`";
$admin_query = mysqli_query($connect, $sql_admin);
$admin = mysqli_fetch_assoc($admin_query);
?>

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
    <section id="title">
        <div class="container-fluid">
            <h2>Royel Group</h2>
        </div>
    </section>

    <section class="mt-2">
        <!--PHP code-->
        <div>
            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

                if ($email == $admin['Email']) {
                    if (password_verify($password, $admin["Password"])) {
                        $_SESSION['admin_logged'] = "1";
                        $_SESSION['admin_email'] = $admin['Email'];

                        header("Location: http://localhost/project-file/admin/admin-home.php");
                        die();
                    }
                }

                $sql = "SELECT * FROM registration WHERE email = '$email'";
                $result = mysqli_query($connect, $sql);
                $user = mysqli_fetch_assoc($result);
                //$id = $user['id'];
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION['logged'] = "1";
                        $_SESSION['user_email'] = $user['email'];
                        header("Location: http://localhost/project-file/");
                        die();
                    } else {
                        echo "<div class='alert alert-danger' style='text-align:center; border-radius:0'>Wrong Password</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' style='text-align:center; border-radius:0'>Email Does not exists</div>";
                }
            }
            ?>
        </div>

        <!--Form Structure-->
        <div class="center">
            <!--Form Title-->
            <h2>Login</h2>
            <!--Form-->
            <form action="Login.php" method="post">
                <div class="txt_field">
                    <input type="text" name="email" required>
                    <span></span>
                    <label for="email">Email</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" required>
                    <span></span>
                    <label for="password">Password</label>
                </div>
                <div class="pass">Forgot Password?</div>
                <!--Submit Button-->
                <input type="submit" name="login" value="Log in">
                <div class="signup_link">
                    Not a member? <a href="http://localhost/project-file/Registration.php">Register</a>
                </div>
            </form>
        </div>
    </section>
</body>

</html>