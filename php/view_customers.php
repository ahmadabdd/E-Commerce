<?php
include "connection.php";

$sql1="Select * from customers";
$result1 = mysqli_query($connection, $sql);

while($row = mysqli_fetch_assoc($result1)) {
    $customers[] = $row;
}
?>