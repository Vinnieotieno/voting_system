<?php
include "database/config.php";
$date = date("i")+ 2;
$id = $_SESSION["id"];
$sql = "UPDATE voters SET last_login = '$date' WHERE id = '$id'";
$sql_run = mysqli_query($conn, $sql);
?>
