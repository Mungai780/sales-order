<!DOCTYPE html>
<html>
<?php
include('adminpartials/session.php');
include('adminpartials/head.php');
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php
  include('adminpartials/header.php');
  include('adminpartials/aside.php');
  ?>
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-sm-9">
          <?php
          include('../partials/connect.php');

          $sql = "SELECT * FROM orders";
          $results = $connect->query($sql);
          while ($final = $results->fetch_assoc()) {
            echo '<a href="ordershow.php?order_id=' . $final['id'] . '">';
            echo '<h3>Order Number: ' . $final['id'] . '</h3><br>';
            echo '<h3>Employee Number: ' . $final['employee_id'] . '</h3><br>';
            echo '<h3>Customer ID: ' . $final['customer_id'] . '</h3><br>';
            echo '<h3>Total: ' . $final['total_amount'] . '</h3><br>';
            echo '<h3>Date: ' . $final['created_at'] . '</h3><br>';
            echo '<h3>Status: ' . $final['status'] . '</h3><br>';
            echo '</a>';

            if ($final['status'] === 'pending') {
              echo '<a href="orderclear.php?order_id=' . $final['id'] . '">';
              echo '<button style="color:green">Clear Order</button>';
              echo '</a>';
            }

            echo '<a href="orderdelete.php?del_id=' . $final['id'] . '">';
            echo '<button style="color:red">Delete</button>';
            echo '</a><hr>';
          }
          ?>
        </div>

        <div class="col-sm-3"></div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php
 include('adminpartials/footer.php');
 ?>
</body>
</html>
