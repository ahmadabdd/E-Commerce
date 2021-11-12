<?php
include "connection.php";
session_start();


$id = $_GET["id"];

$sql = "SELECT * FROM products where store_id = '$id'";
$result = mysqli_query($connection, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
    
}


$_SESSION['products'] = $products;
$_SESSION['varify'] = true;

//header('location: ../index.php');

?>