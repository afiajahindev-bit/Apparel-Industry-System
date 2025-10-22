<?php
require_once('database.php');
session_destroy();
header("Location: http://localhost/project-file/home.php");
?>