<!DOCTYPE html>
<html lang="en">
<?php
include 'partials/session.php';
include("partials/connect.php");
include("partials/head.php");
?>

<!-- Header -->
<header>
  <!-- Header desktop -->
  <div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
      <div class="content-topbar flex-sb-m h-full container">  
        <div class="left-top-bar">
          Rada Negro
        </div>

        <div class="right-top-bar flex-w h-full">
          <?php
          if (!empty($_SESSION['email'])) {?>
            <a href="handler/employeelogout.php" class="flex-c-m trans-04 p-lr-25">
              Logout
            </a>
          <?php } else { ?> 
            <a href="employeeforms.php" class="flex-c-m trans-04 p-lr-25">
              Logout
            </a>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="wrap-menu-desktop">
      <nav class="limiter-menu-desktop container">          
        <!-- Logo desktop -->   
        <a href="index.php" class="logo">
          <img src="images/icons/logo-01.png" alt="IMG-LOGO">
        </a>

        <!-- Menu desktop -->
        <div class="menu-desktop">
          <ul class="main-menu">
            <li>
              <a href="index.php">Home</a>
            </li>

            <li>
              <a href="products.php">Products</a>
            </li>
          </ul>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
          <ul class="main-menu-m">
            <li>
              <a href="index.php">Home</a>
            </li>
            <li>
              <a href="products.php">Products</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/about1.jpg');">
  <h2 class="ltext-105 cl0 txt-center">
    Employee Panel
  </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
  <div class="container">
    <div class="flex-w flex-tr">
      <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
        <form action="handler/orderhandler.php" method="POST">
          <h4 class="mtext-105 cl2 txt-center p-b-30">
            Sales Order
          </h4>
          <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="customer_name" placeholder="Customer Name" required>
          </div>
          <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="phone" placeholder="Phone Number" required>
          </div>
          <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="address" placeholder="Address" required>
          </div>
          <div class="bor8 m-b-20 how-pos4-parent">
            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Email Address" required>
            <img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
          </div>
          <h2 class="mtext-105 cl2 txt-center p-b-30">
            Order Items
          </h2>
          <?php for ($i = 1; $i <= 5; $i++) { ?>
            <h1 class="mtext-105 cl2 txt-center p-b-30">Item <?php echo $i; ?></h1>
            <hr style="display: block;
              height: 1px;
              border: 0;
              border-top: 1px solid #ccc;
              margin: 1em 0;
              padding: 0;">
            <div class="bor8 m-b-20 how-pos4-parent">
              <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="product_id[]" placeholder="Product ID">
            </div>
            <div class="bor8 m-b-20 how-pos4-parent">
              <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="quantity[]" placeholder="Quantity">
            </div>
          <?php } ?>
          <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
            Submit
          </button>
        </form>
      </div>
      <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
        <div class="flex-w w-full p-b-42">
          <!-- Display employee details -->
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-user"></span>
          </span>
          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Employee No.
            </span>
            <p class="stext-115 cl6 size-213 p-t-18">
              <?php echo $employeeNo; ?>
            </p>
          </div>
        </div>

        <div class="flex-w w-full p-b-42">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-user"></span>
          </span>
          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Name
            </span>
            <p class="stext-115 cl6 size-213 p-t-18">
              <?php echo $employeeName; ?>
            </p>
          </div>
        </div>

        <div class="flex-w w-full p-b-42">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-map-marker"></span>
          </span>
          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Address
            </span>
            <p class="stext-115 cl6 size-213 p-t-18">
              Luthuli Avenue, Nairobi Store: 10018 Murumbi House
            </p>
          </div>
        </div>

        <div class="flex-w w-full p-b-42">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-phone-handset"></span>
          </span>
          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Sales Manager Contacts
            </span>
            <p class="stext-115 cl1 size-213 p-t-18">
              +254 793973309
            </p>
          </div>
        </div>

        <div class="flex-w w-full">
          <span class="fs-18 cl5 txt-center size-211">
            <span class="lnr lnr-envelope"></span>
          </span>
          <div class="size-212 p-t-2">
            <span class="mtext-110 cl2">
              Sale Support
            </span>
            <p class="stext-115 cl1 size-213 p-t-18">
              sales@cozastoreltd.com
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include('partials/footer.php');
?>

</body>
</html>
