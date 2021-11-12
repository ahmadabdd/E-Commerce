<?php
include "connection.php";
session_start();
$id = $_GET['name'];

$sql = "select * from products";
$result = mysqli_query($connection, $sql);

while($row = mysqli_fetch_assoc($result)) {
    if($row['id'] == $id){
        $quantity = $row['quantity'];
    }
}
//print_r($products);
if($quantity > 0) {
    $value = 1;
    $sql1 = "UPDATE products SET quantity = quantity - $value WHERE id = $id";
    $result1 = mysqli_query($connection, $sql1);
}


header('location: ../index.php');
?>
