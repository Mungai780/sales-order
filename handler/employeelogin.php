<?php
session_start();

if (isset($_POST['login'])) {
	include('../partials/connect.php');
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM employees WHERE username = '$email' AND password = '$password'";
	$results = $connect->query($sql);
	$final = $results->fetch_assoc();

	if ($final && $final['id']) {
		$_SESSION['email'] = $final['username'];
		$_SESSION['password'] = $final['password'];
		$_SESSION['employeeid'] = $final['id'];

		header('location: ../index.php');
	} else {
		echo "<script> alert('Credentials are wrong');
        window.location.href='../employeeforms.php';
        </script>";
	}
}
?>
