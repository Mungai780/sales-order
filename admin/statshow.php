<?php
include('../partials/connect.php');

// Update pending_orders and total_pending in sales_stats table
$pending_query = "SELECT COUNT(*) AS pending_count, SUM(total_amount) AS pending_total FROM orders WHERE status = 'pending'";
$pending_result = $connect->query($pending_query);
if ($pending_result->num_rows > 0) {
  $pending_row = $pending_result->fetch_assoc();
  $pending_count = $pending_row['pending_count'];
  $pending_total = $pending_row['pending_total'];

  // Update sales_stats table
  $update_pending_query = "UPDATE sales_stats SET pending_orders = ?, total_pending = ?";
  $update_pending_stmt = $connect->prepare($update_pending_query);
  $update_pending_stmt->bind_param("ii", $pending_count, $pending_total);
  $update_pending_stmt->execute();
  $update_pending_stmt->close();
}

// Update cleared_orders and total_sales in sales_stats table
$cleared_query = "SELECT COUNT(*) AS cleared_count, SUM(total_amount) AS cleared_total FROM orders WHERE status = 'cleared'";
$cleared_result = $connect->query($cleared_query);
if ($cleared_result->num_rows > 0) {
  $cleared_row = $cleared_result->fetch_assoc();
  $cleared_count = $cleared_row['cleared_count'];
  $cleared_total = $cleared_row['cleared_total'];

  // Update sales_stats table
  $update_cleared_query = "UPDATE sales_stats SET cleared_orders = ?, total_sales = ?";
  $update_cleared_stmt = $connect->prepare($update_cleared_query);
  $update_cleared_stmt->bind_param("ii", $cleared_count, $cleared_total);
  $update_cleared_stmt->execute();
  $update_cleared_stmt->close();
}

// Retrieve total worth of pending orders from 'orders' table
$pending_total_query = "SELECT IFNULL(SUM(total_amount), 0) AS total_pending_worth FROM orders WHERE status = 'pending'";
$pending_total_result = $connect->query($pending_total_query);
if ($pending_total_result->num_rows > 0) {
  $pending_total_row = $pending_total_result->fetch_assoc();
  $total_pending_worth = $pending_total_row['total_pending_worth'];
} else {
  $total_pending_worth = 0; // Set default value if no pending orders found
}

// Update total worth of pending orders in sales_stats table
$update_pending_worth_query = "UPDATE sales_stats SET total_pending = ?";
$update_pending_worth_stmt = $connect->prepare($update_pending_worth_query);
$update_pending_worth_stmt->bind_param("i", $total_pending_worth);
$update_pending_worth_stmt->execute();
$update_pending_worth_stmt->close();

// Retrieve list of pending orders from 'orders' table
$pending_orders_query = "SELECT id, total_amount, created_at FROM orders WHERE status = 'pending'";
$pending_orders_result = $connect->query($pending_orders_query);
$pending_orders = array();
while ($pending_order_row = $pending_orders_result->fetch_assoc()) {
  $pending_orders[] = $pending_order_row;
}

// Retrieve total worth of cleared orders from 'orders' table
$cleared_total_query = "SELECT IFNULL(SUM(total_amount), 0) AS total_cleared_worth FROM orders WHERE status = 'cleared'";
$cleared_total_result = $connect->query($cleared_total_query);
if ($cleared_total_result->num_rows > 0) {
  $cleared_total_row = $cleared_total_result->fetch_assoc();
  $total_cleared_worth = $cleared_total_row['total_cleared_worth'];
} else {
  $total_cleared_worth = 0; // Set default value if no cleared orders found
}

// Update total worth of cleared orders in sales_stats table
$update_cleared_worth_query = "UPDATE sales_stats SET total_sales = ?";
$update_cleared_worth_stmt = $connect->prepare($update_cleared_worth_query);
$update_cleared_worth_stmt->bind_param("i", $total_cleared_worth);
$update_cleared_worth_stmt->execute();
$update_cleared_worth_stmt->close();

// Retrieve list of cleared orders from 'orders' table
$cleared_orders_query = "SELECT id, total_amount, created_at FROM orders WHERE status = 'cleared'";
$cleared_orders_result = $connect->query($cleared_orders_query);
$cleared_orders = array();
while ($cleared_order_row = $cleared_orders_result->fetch_assoc()) {
  $cleared_orders[] = $cleared_order_row;
}

// Remember to include necessary database connections or includes if required
// include('../partials/connect.php');
// ...
?>
