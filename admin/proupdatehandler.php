<?php
include('../partials/connect.php');

if (isset($_POST['update'])) {
    $newid = $_POST['form_id'];
    $newname = mysqli_real_escape_string($connect, $_POST['name']);
    $newprice = $_POST['price'];
    $newdesc = $_POST['description'];
    $newsto = $_POST['stock_quantity'];

    $target = "uploads/";
    $file_path = $target . basename($_FILES['file']['name']);
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_store = "uploads/" . $file_name;

    move_uploaded_file($file_tmp, $file_store);

    // Escape the name value using prepared statements
    $stmt = $connect->prepare("UPDATE products SET name=?, price=?, description=?, stock_quantity=?, picture=? WHERE id=?");
    $stmt->bind_param("ssssss", $newname, $newprice, $newdesc, $newsto, $file_path, $newid);

    if ($stmt->execute()) {
        header('location: productsshow.php');
    } else {
        header('location: adminindex.php');
    }

    $stmt->close();
}
?>
