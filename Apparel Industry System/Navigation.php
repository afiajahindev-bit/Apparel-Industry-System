<nav class="navbar fixed-top navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="home.html">Royel Group</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/home.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/fabric.php">Fabrics</a></li>
            <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/print.php">Collection</a></li>

            <?php
            if (!isset($_SESSION['logged'])) {
            ?>
                <li style="padding: 0 3px; " class="nav-item"><a class="nav-link" href=""><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li><a class="nav-link" href="http://localhost/project-file/Registration.php">
                        <i class="fa-solid fa-user"></i></a></li>
            <?php
            } else {
            ?>
                <li style="padding: 0 3px; " class="nav-item"><a class="nav-link" href="http://localhost/project-file/cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li style="padding: 0 3px; " class="nav-item">
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" style="padding: 2px 8px; top: 5px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <a class="nav-link drop-a" style="padding: 0px 3px; display:inline;" href="">
                                <i class="fa-solid fa-user"></i></a></button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li class="dropdown-item-text opacity-50"><small><?= $user_value['email']; ?></small></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="http://localhost/project-file/account.php">View Profile</a></li>
                            <li><a class="dropdown-item" href="http://localhost/project-file/logout.php">Log out</a></li>
                        <?php
                    }
                        ?>
                        </ul>
                    </div>
                </li>

    </div>
</nav>