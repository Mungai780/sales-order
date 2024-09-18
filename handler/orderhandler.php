<?php
include("../partials/connect.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $products = $_POST['product_id']; // An array of product IDs
    $quantities = $_POST['quantity']; // An array of quantities

    // Check if the customer already exists
    $customer_query = "SELECT * FROM customers WHERE customer_name = ?";
    $customer_stmt = $connect->prepare($customer_query);
    $customer_stmt->bind_param("s", $customer_name);
    $customer_stmt->execute();
    $customer_result = $customer_stmt->get_result();

    if ($customer_result->num_rows > 0) {
        // Customer already exists
        $customer_row = $customer_result->fetch_assoc();
        $customer_id = $customer_row['id'];
    } else {
        // Insert into customers table
        $insert_customer_query = "INSERT INTO customers (customer_name, phone, address, email) VALUES (?, ?, ?, ?)";
        $insert_customer_stmt = $connect->prepare($insert_customer_query);
        $insert_customer_stmt->bind_param("ssss", $customer_name, $phone, $address, $email);
        $insert_customer_stmt->execute();

        // Retrieve the auto-generated customer_id
        $customer_id = $connect->insert_id;
    }

    // Retrieve the employee_id from the session
    session_start();
    $employee_id = $_SESSION['employeeid'];

    // Insert into orders table with the associated employee_id, customer_id, and status
    $status = "pending";
    $insert_order_query = "INSERT INTO orders (employee_id, customer_id, total_amount, status) VALUES (?, ?, 0, ?)";
    $insert_order_stmt = $connect->prepare($insert_order_query);
    $insert_order_stmt->bind_param("iis", $employee_id, $customer_id, $status);
    $insert_order_stmt->execute();

    // Retrieve the auto-generated order_id
    $order_id = $connect->insert_id;

    // Insert into orderitems table using the obtained order_id
    $total = 0; // Initialize total
    for ($i = 0; $i < count($products); $i++) {
        $product_id = $products[$i];
        $quantity = $quantities[$i];

        // Retrieve price from products table
        $price_query = "SELECT price FROM products WHERE id = ?";
        $price_stmt = $connect->prepare($price_query);
        $price_stmt->bind_param("i", $product_id);
        $price_stmt->execute();
        $price_result = $price_stmt->get_result();

        if ($price_result->num_rows > 0) {
            $price_row = $price_result->fetch_assoc();
            $price = $price_row['price'];

            // Calculate total for the current order item
            $item_total = $price * $quantity;
            $total += $item_total;

            // Insert into orderitems table
            $insert_orderitem_query = "INSERT INTO orderitems (order_id, product_id, quantity, total) VALUES (?, ?, ?, ?)";
            $insert_orderitem_stmt = $connect->prepare($insert_orderitem_query);
            $insert_orderitem_stmt->bind_param("iiid", $order_id, $product_id, $quantity, $item_total);
            $insert_orderitem_stmt->execute();

            // Update stock quantity for the current product
            $update_stock_query = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ?";
            $update_stock_stmt = $connect->prepare($update_stock_query);
            $update_stock_stmt->bind_param("ii", $quantity, $product_id);
            $update_stock_stmt->execute();
        }
    }

    // Update total in orders table
    $update_total_query = "UPDATE orders SET total_amount = ? WHERE id = ?";
    $update_total_stmt = $connect->prepare($update_total_query);
    $update_total_stmt->bind_param("di", $total, $order_id);
    $update_total_stmt->execute();

    // Redirect to index.php
    header("Location: ../index.php");
    exit();
}

// Redirect to index.php if accessed directly
header('location: ../index.php');
?>
