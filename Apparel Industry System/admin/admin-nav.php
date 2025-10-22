<?php
if (!isset($_SESSION['admin_logged'])) {
    header("Location: ../home.php");
} else {
?>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="admin-home.php">Royel Group</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/admin/admin-home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/admin/customer.php">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/admin/orders-check.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/admin/edit-fabric.php">Fabrics</a></li>
                <li class="nav-item"><a class="nav-link" href="http://localhost/project-file/admin/edit-print.php">Collection</a></li>
                <li style="padding: 0 3px; " class="nav-item">
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" style="padding: 2px 8px; top: 5px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <a class="nav-link drop-a" style="padding: 0px 3px; display:inline;">
                                <i class="fa-solid fa-user"></i></a>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li class="dropdown-item-text opacity-50"><small><?= $_SESSION['admin_email']; ?></small></li>
                            <li><a class="dropdown-item" href="../logout.php">Log out</a></li>

                    </div>
                </li>
    </nav>
<?php
}
?>