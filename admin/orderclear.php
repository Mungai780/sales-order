<?php
include('../partials/connect.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Update the status of the order to "cleared"
    $update_status_query = "UPDATE orders SET status = 'cleared' WHERE id = '$order_id'";
    $connect->query($update_status_query);

    // Redirect back to orders.php
    header("Location: orders.php");
    exit();
} else {
    echo '<div class="alert alert-danger">Invalid order ID.</div>';
}
?>
