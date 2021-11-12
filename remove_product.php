<?php
include "./php/connection.php";
$name = $_GET['name'];

$sql_remove = "delete from products where name = '$name'";
$result = mysqli_query($connection, $sql_remove);
header('location: admin.php');
?>

    