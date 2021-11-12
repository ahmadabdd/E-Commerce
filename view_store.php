<?php
include "./php/connection.php";
session_start();


$id = $_GET["id"];

$sql = "SELECT * FROM products where store_id = '$id'";
$products = mysqli_query($connection, $sql);

$_SESSION['items'] = $products;
header('location: index.php');
?>