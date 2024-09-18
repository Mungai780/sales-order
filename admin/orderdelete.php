<?php
include('../partials/connect.php');
$order_id = $_GET['del_id'];

// Retrieve the customer ID associated with the order being deleted
$customer_query = "SELECT customer_id FROM orders WHERE id = '$order_id'";
$customer_result = $connect->query($customer_query);

if ($customer_result->num_rows > 0) {
    $customer_row = $customer_result->fetch_assoc();
    $customer_id = $customer_row['customer_id'];

    // Check if the customer is associated with any other order
    $associated_orders_query = "SELECT id FROM orders WHERE customer_id = '$customer_id'";
    $associated_orders_result = $connect->query($associated_orders_query);

    if ($associated_orders_result->num_rows == 1) {
        // The customer is not associated with any other order, so deregister the customer
        $deregister_customer_query = "DELETE FROM customers WHERE id = '$customer_id'";
        $connect->query($deregister_customer_query);
    }
}

// Update the stock quantity for the items in the order
$update_stock_query = "UPDATE products 
                       SET stock_quantity = stock_quantity + (
                           SELECT quantity FROM orderitems WHERE order_id = '$order_id'
                       )
                       WHERE id IN (
                           SELECT product_id FROM orderitems WHERE order_id = '$order_id'
                       )";
$connect->query($update_stock_query);

// Delete the order items associated with the order
$delete_order_items_query = "DELETE FROM orderitems WHERE order_id = '$order_id'";
$connect->query($delete_order_items_query);

// Delete the order from the 'orders' table
$delete_order_query = "DELETE FROM orders WHERE id = '$order_id'";
$connect->query($delete_order_query);

// Execute stats.php to update the statistics
include('../admin/stats.php');

// Redirect to orders.php
header('location: orders.php');
exit();
?>
