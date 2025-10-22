<?php
$remove_id = $_GET['rid'];
require_once('database.php');
$remove_sql = "DELETE FROM cart where id='$remove_id'";
$remove_query = mysqli_query($connect,$remove_sql);
header("Location: http://localhost/project-file/cart.php");
?>