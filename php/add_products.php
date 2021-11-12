<?php
session_start();
include "connection.php";

if(isset($_POST["name"]) && $_POST["price"] && $_POST['quantity']){
    $count = 0;
    $sql = "SELECT P.name, S.store_name from products P, stores S where P.store_id = S.id and S.id = '$_SESSION[id]' and P.name = '$_POST[name]'";
    $result1 = mysqli_query($connection, $sql); 
    $count = mysqli_num_rows($result1);
    if($count > 0) {
        $_SESSION['error'] = 'This product already exists.';
        //echo "fail";
        //$test = $result1->fetch_assoc();
        //print_r($test); 
		header("location: ../admin.php");
		
        } else {
            $sql_insert = "INSERT INTO products (`name`, `price`, `quantity`, `store_id`) VALUES ('$_POST[name]', '$_POST[price]', '$_POST[quantity]', '$_SESSION[id]')";
            $result = mysqli_query($connection, $sql_insert);
            $_SESSION['success'] = 'Added product successfully.';
            //echo "success";
            header("location: ../admin.php");
        }
}

?>
    