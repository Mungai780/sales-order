<?php
include("../partials/connect.php");

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$stock_quantity = $_POST['stock_quantity'];

 $target = "uploads/";
    $file_path = $target . basename($_FILES['file']['name']);
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_store = "uploads/" . $file_name;

move_uploaded_file($file_tmp, $file_store);

// Prepare the SQL statement with placeholders
$sql = "INSERT INTO products (name, price, picture, description, stock_quantity) VALUES (?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $connect->prepare($sql);

// Bind the parameters to the statement
$stmt->bind_param("sssss", $name, $price, $file_path, $description, $stock_quantity);

// Execute the statement
$stmt->execute();

// Close the statement
$stmt->close();

header('location: productsshow.php');
?>
