<?php
include "connection.php";
session_start();

// Validatiting credentials.
if(isset($_POST["email"]) and $_POST["email"] !="") {
	$email = $_POST["email"];
} else { 
	die("Enter a valid email.");
}

if(isset($_POST["password"]) and $_POST["password"] !="") {
	$password = $_POST["password"];
} else {
	die("Enter a valid password.");
}

if(isset($_POST["user_type"]) && $_POST["user_type"] != "" ) {
    $user_type = $_POST["user_type"];
}else{
    die ("Enter a valid user type");
}
$hash = hash('sha256', $password);

if($user_type == 1) {
	$sql1="Select * from customers where email = ?";
	$stmt1 = $connection->prepare($sql1);
	$stmt1->bind_param("s", $email);
	$stmt1->execute();
	$result = $stmt1->get_result();
	$row = $result->fetch_assoc();

	if(empty($row)) {
		$_SESSION['email'] = "Please try again with another email.";
		header("location: ../login.php");
	} else {
		if($hash === $row['password']) {
			$_SESSION['customer_data_email'] = $row['email'];
			$_SESSION['customer_data_fname'] = $row['first_name'];
			$_SESSION['customer_data_lname'] = $row['last_name'];
			$_SESSION['customer_data_id'] = $row['id'];
			$_SESSION['varify'] = $email;
			header("location: ../index.php");
		} else {
			$_SESSION['password'] = "Incorrect Password.";
			header("location: ../login.php");
		}
	}
}


if($user_type == 2) {
	$sql2 = "Select * from stores where email = ?";
	$stmt2 = $connection->prepare($sql2);
	$stmt2->bind_param("s", $email);
	$stmt2->execute();
	$result2 = $stmt2->get_result();
	$row2 = $result2->fetch_assoc();

	if(empty($row2)) {
		$_SESSION['email'] = "Please try again with another email.";
		header("location: ../login.php");
	} else {
		if($hash === $row2['password']) {
			$_SESSION['stores'] = $stores;
			$_SESSION['store_name'] = $row2['store_name'];
			$_SESSION['varify'] = $email;
			header("location: ../admin.php");
		} else {
			$_SESSION['password'] = "Incorrect Password.";
			header("location: ../login.php");
		}
	}
}
?>



