<!DOCTYPE html>
<html lang="en">
<?php
include ("partials/head.php");
?>
<body class="animsition">
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
</header>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/about1.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Products
	</h2>
</section>	

<!-- Separator -->
<!-- Separator -->
<hr class="separator">


<!-- Product section -->
<div class="row isotope-grid">
	<?php
	include("partials/connect.php");
	$sql="select * from products";
	$results=$connect->query($sql);

	while ($final=$results->fetch_assoc()) {
	?>
	<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $final['stock_quantity'] ?>">
		<!-- Block2 -->
		<div class="block2">
			<div class="block2-pic hov-img0">
				<img src="<?php echo $final['picture'] ?>" alt="IMG-PRODUCT" style="min-height: 400px; max-height: 400px">
			</div>

			<div class="block2-txt flex-w flex-t p-t-14">
				<div class="block2-txt-child1 flex-col-l ">
					<span class="stext-105 cl3">
						ID:<?php echo $final['id'] ?><br>
						<?php echo $final['name'] ?><br>
						Price: KES<?php echo $final['price'] ?><br>
						Amount in Stock: <?php echo $final['stock_quantity'] ?>
					</span>
				</div>

				
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<!-- Footer -->
<?php
include('partials/footer.php');
?>

</body>
</html>
