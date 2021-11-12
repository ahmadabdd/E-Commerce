<?php
include "connection.php";

$sql="Select * from stores";
$result = mysqli_query($connection, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $stores[] = $row;
}
?>