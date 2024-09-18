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
        Statistics
        <small>Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Statistics</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Pending Orders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
              include('statshow.php');
              echo "<h4>Total Pending Orders: $pending_count</h4>";
              echo "<h4>Total Worth of Pending Orders: $total_pending_worth</h4>";
              if (count($pending_orders) > 0) {
                echo "<h4>List of Pending Orders:</h4>";
                echo "<ul>";
                foreach ($pending_orders as $order) {
                  echo "<li>ID: {$order['id']} | Amount: {$order['total_amount']} | Date: {$order['created_at']}</li>";
                }
                echo "</ul>";
              } else {
                echo "<p>No pending orders found.</p>";
              }
              ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Cleared Orders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php
              include('statshow.php');
              echo "<h4>Total Cleared Orders: $cleared_count</h4>";
              echo "<h4>Total Worth of Cleared Orders: $total_cleared_worth</h4>";
              if (count($cleared_orders) > 0) {
                echo "<h4>List of Cleared Orders:</h4>";
                echo "<ul>";
                foreach ($cleared_orders as $order) {
                  echo "<li>ID: {$order['id']} | Amount: {$order['total_amount']} | Date: {$order['created_at']}</li>";
                }
                echo "</ul>";
              } else {
                echo "<p>No cleared orders found.</p>";
              }
              ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php
 include('adminpartials/footer.php');
 ?>
</body>
</html>
