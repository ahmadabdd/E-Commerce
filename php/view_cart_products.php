<?php
include "connection.php";

$sql = "SELECT P.name, S.store_name, P.price FROM cart C, products P, stores S
WHERE C.store_id = S.id and C.product_id = P.id;";
$result = mysqli_query($connection, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>