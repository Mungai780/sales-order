<?php
include('../partials/connect.php');
$employee_name = $_POST['employee_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if ($password == $password2) {
	$sql = "INSERT INTO employees(employee_name, username, password) VALUES ('$employee_name', '$email', '$password')";
	$connect->query($sql);
	$employee_id = $connect->insert_id;

	// Update the employee_id in the orders table
	$sql = "UPDATE orders SET employee_id = '$employee_id' WHERE employee_id IS NULL";
	$connect->query($sql);

	echo "<script> alert('You are registered');
			window.location.href='../employeeforms.php';
			</script>";
} else {
	echo "<script> alert('Password did not match');
			window.location.href='../employeeforms.php';
			</script>";
}
?>
