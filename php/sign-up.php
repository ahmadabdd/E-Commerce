<?php
include "connection.php";
session_start();

if(isset($_POST["firstname"]) && $_POST["firstname"] != "" && strlen($_POST["firstname"]) >= 3) {
    $firstname = $_POST["firstname"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["lastname"]) && $_POST["lastname"] != "" && strlen($_POST["lastname"]) >= 3) {
    $lastname = $_POST["lastname"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["email"]) && $_POST["email"] != "" ) {
    $email = $_POST["email"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["password"]) && $_POST["password"] != "" ) {
    $password = $_POST["password"];
}else{
    die ("Enter a valid input");
}

if(isset($_POST["confirm_password"]) && $_POST["confirm_password"] != "" ) {
    $confirm_password = $_POST["confirm_password"];
}else{
    die ("Enter a valid input");
}


$sql1="Select * from customers C, stores S where C.email = ? or S.email = ?"; #Check if the email already exists in the database
$stmt1 = $connection->prepare($sql1);
$stmt1->bind_param("ss", $email, $email);
$stmt1->execute();
$result = $stmt1->get_result();
$row = $result->fetch_assoc();

$hash = hash('sha256', $password);

if(empty($row)) {
    if($password == $confirm_password) {
        $sql2 = "INSERT INTO `customers` (`first_name`, `last_name`,`email`, `password`) VALUES (?, ?, ?, ?);"; #add the new user to the database
        $stmt2 = $connection->prepare($sql2);
        $stmt2->bind_param("ssss", $firstname, $lastname, $email, $hash);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        header("location: ../login.php");
    } else {
        $_SESSION["password"] = "Passwords do not match.";
        header('location: ../user-sign-up.php');
    }
} else {
    $_SESSION["email"] = "This email is already used.";
    header('location: ../user-sign-up.php');
} if($password != $confirm_password) {
    $_SESSION["password"] = "Passwords do not match.";
    header('location: ../user-sign-up.php');
}
?>