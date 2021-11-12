<?php
session_start();
include "connection.php";

if(isset($_POST["firstname"]) && $_POST["firstname"] != "" && strlen($_POST["firstname"]) >= 3) {
    $firstname = $_POST["firstname"];
}else{
    die ("Enter a valid firstname");
}

if(isset($_POST["lastname"]) && $_POST["lastname"] != "" && strlen($_POST["lastname"]) >= 3) {
    $lastname = $_POST["lastname"];
}else{
    die ("Enter a valid lastname");
}

if(isset($_POST["email"]) && $_POST["email"] != "" ) {
    $email = $_POST["email"];
}else{
    die ("Enter a valid email");
}

if(isset($_POST["store_name"]) && $_POST["store_name"] != "" ) {
    $store_name = $_POST["store_name"];
}else{
    die ("Enter a valid store name");
}

if(isset($_POST["password"]) && $_POST["password"] != "" ) {
    $password = $_POST["password"];
}else{
    die ("Enter a valid password");
}

if(isset($_POST["confirm_password"]) && $_POST["confirm_password"] != "" ) {
    $confirm_password = $_POST["confirm_password"];
}else{
    die ("Enter a valid password");
}


$sql1="Select * from customers C, stores S where (C.email = ? or S.email = ?) or store_name = ?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("sss", $email, $email, $store_name);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();

$hash = hash('sha256', $password);


if(empty($row)) {
    if($password != $confirm_password) {
        $_SESSION["password"] = "Passwords do not match.";
        header('location: ../store-sign-up.php');
    } else {
        $sql2 = "INSERT INTO `stores` (`first_name`, `last_name`, `store_name`, `email`, `password`) VALUES (?, ?, ?, ?, ?);"; #add the new user to the database
        $stmt2 = $connection->prepare($sql2);
        $stmt2->bind_param("sssss", $firstname, $lastname, $store_name, $email, $hash);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        header("location: ../login.php");
    }
} else {
    if(in_array($email, $row)) {
        $_SESSION["email"] = "This email is already used.";
        header('location: ../store-sign-up.php');
    } 
    if(in_array($store_name, $row)) {
        $_SESSION["store_name"] = "This store name is already used.";
        header('location: ../store-sign-up.php');
    } 
    if($password != $confirm_password) {
        $_SESSION["password"] = "Passwords do not match.";
        header('location: ../store-sign-up.php');
    }
}

?>