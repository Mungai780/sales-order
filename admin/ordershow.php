<?php
include('adminpartials/session.php');
include('../partials/connect.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve order information from 'orders' table
    $order_query = "SELECT * FROM orders WHERE id = '$order_id'";
    $order_result = $connect->query($order_query);

    if ($order_result->num_rows > 0) {
        $order_row = $order_result->fetch_assoc();
        $customer_id = $order_row['customer_id'];
        ?>
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <title>Order Details</title>
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
          <style>
            body {
              display: flex;
              min-height: 100vh;
              flex-direction: column;
            }

            main {
              flex: 1;
            }
          </style>
        </head>
        <body>
          <div class="container-fluid">
            <h1>Order Details</h1>
            <div class="row">
              <div class="col-md-6">
                <div class="card mb-3">
                  <div class="card-body">
                    <h5 class="card-title">Order Details</h5>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Order Number: <?php echo $order_row['id']; ?></li>
                      <li class="list-group-item">Employee Number: <?php echo $order_row['employee_id']; ?></li>
                      <li class="list-group-item">Customer ID: <?php echo $customer_id; ?></li>
                      <li class="list-group-item">Total: <?php echo $order_row['total_amount']; ?></li>
                      <li class="list-group-item">Date: <?php echo $order_row['created_at']; ?></li>
                    </ul>
                  </div>
                </div>

                <?php
                // Retrieve order items from 'orderitems' table
                $order_items_query = "SELECT * FROM orderitems WHERE order_id = '$order_id'";
                $order_items_result = $connect->query($order_items_query);

                if ($order_items_result->num_rows > 0) {
                    ?>
                    <div class="card mb-3">
                      <div class="card-body">
                        <h5 class="card-title">Order Items</h5>
                        <ul class="list-group list-group-flush">
                          <?php
                          while ($order_item_row = $order_items_result->fetch_assoc()) {
                              $product_id = $order_item_row['product_id'];

                              // Retrieve product information from 'products' table
                              $product_query = "SELECT * FROM products WHERE id = '$product_id'";
                              $product_result = $connect->query($product_query);

                              if ($product_result->num_rows > 0) {
                                  $product_row = $product_result->fetch_assoc();
                                  $product_name = $product_row['name'];
                              } else {
                                  $product_name = 'N/A';
                              }
                              ?>
                              <li class="list-group-item">
                                Name: <?php echo isset($product_name) ? $product_name : 'N/A'; ?> |
                                Quantity: <?php echo $order_item_row['quantity']; ?> |
                                Total: <?php echo $order_item_row['total']; ?>
                              </li>
                              <?php
                          }
                          ?>
                        </ul>
                      </div>
                    </div>
                    <?php
                } else {
                    echo '<div class="alert alert-info">No items found for this order.</div>';
                }
                ?>
              </div>
            </div>
          </div>
        </body>
        </html>
        <?php
    } else {
        echo '<div class="alert alert-danger">Order not found.</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid order ID.</div>';
}
?>
