<?php
include "connection.php";

$sql = "SELECT * FROM products";
$result = mysqli_query($connection, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>