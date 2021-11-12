<?php
session_start();
include "./php/connection.php";
include "./php/view_stores.php";
include "./php/view_products.php";
include "./php/view_customers.php";
if (!(isset($_SESSION['varify']))) {
	header('location: login.php');
	exit();
}	
	$email = $_SESSION['varify'];
	foreach($customers as $customer) {
		if($customer['email'] = $email) {
			$id = $customer['store_id'];
			$email = $customer['email'];
			$customer_id = $customer['id'];
		} 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <?php
	include "header.html";
  ?>

</head>

<body id="body">

<!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
	
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.html">
						<!-- replace logo here -->
						<svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1" xmlns="http://www.w3.org/2000/svg"
							xmlns:xlink="http://www.w3.org/1999/xlink">
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" font-size="40"
								font-family="AustinBold, Austin" font-weight="bold">
								<g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
									<text id="AVIATO">
										<tspan x="108.94" y="325">AVIATO</tspan>
									</text>
								</g>
							</g>
						</svg>
					</a>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Cart -->
				<ul class="top-menu text-right list-inline">
					<li class="dropdown cart-nav dropdown-slide">
						<a href="login.php"></i>Log out</a>
					</li>
				</ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Shop</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">shop</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="products section">
	<div class="container" style="padding-left: 10%; padding-right: 10%;">
		<div class="row">
			<div class="col-md-12">
				<?php
				if (count($products) > 0 && count($stores) > 0) {
					foreach($stores as $store) {
						$ids[] = $store['id'];
					}
					foreach($products as $product) {
						$pos = $product['store_id'];
						$quantity = $product['quantity'];
						$x = array_search($pos, $ids);

						?>
						<div class="col-md-4">
							<div class="product-item">
								<div class="product-thumb">
									<img class="img-responsive" src="images/shop/products/product-1.jpg" alt="product-img" />
									<div class="preview-meta">
										<ul>
											<li>
												<a href="./php/add_to_cart.php?name=<?php echo $product["id"]?>"><i class="tf-ion-android-cart"></i></a>
											</li>
											<h4><a href="#">
												<?php 
												if($quantity > 0) {
													echo "Quantity: ". $quantity;
												} else {
													echo "Out of stock.";
												}
												?>
												</a>
											</h4>
										</ul>
									</div>
								</div>
								<div class="row">
									<div class="product-content">
										<h4><a style = "font-weight: bold" href="#"><?php echo $product['name'] ?></a></h4>					
									</div>
									<div class="product-content">
										<h4>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16"><path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/></svg>
											<a href="#"><?php  echo $stores[$x]['store_name'] ?></a>
										</h4>					
									</div>
									<div class="product-content">
										<h4><a href="#"><?php echo "$ " . $product['price'] ?></a></h4>					
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</section>

<?php
	include "footer.html";
?>
  </body>
  </html>


