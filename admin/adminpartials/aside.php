<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel"> </div>
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"><?php echo $_SESSION['email'] ?></li>
      <li class="active treeview">
        <li>
          <a href="adminindex.php">
            <i class="fa fa-th"></i> <span>Home</span>
          </a>
        </li>
        <li>
          <a href="productsshow.php">
            <i class="fa fa-th"></i> <span>Products</span> 
          </a>
        </li>
        <li>
          <a href="orders.php">
            <i class="fa fa-th"></i> <span>Orders</span>
          </a>
        </li>
        <li>
          <a href="customers.php">
            <i class="fa fa-th"></i> <span>Customers</span>
          </a>
        </li>
        <li>
          <a href="employees.php">
            <i class="fa fa-th"></i> <span>Employees</span>
          </a>
        </li>
        <li>
         <li>
  <a href="statis.php">
    <i class="fa fa-th"></i> <span>Statistics</span>
  </a>
</li>

        </li>
        <li>
          <a href="adminpartials/logout.php">
            <i class="fa fa-th"></i> <span>Sign Out</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>
