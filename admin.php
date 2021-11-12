<?php

	include "./php/connection.php";
	session_start();
	if(!(isset($_SESSION['varify']))) {
		header('location: login.php');
		exit();
	}


	$store_name = $_SESSION['store_name'];
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
				<div class="contact-number">
					<h3 class="text-center">
						
					<?php
						echo $_SESSION['store_name'];
					?>
					<br> Admin
					</h3>
				</div>
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
			<ul class="top-menu text-right list-inline">
					<li class="dropdown cart-nav dropdown-slide">
						<a href="login.php"></i>Log out</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			</div>
		</div>
	</div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <form class="text-left clearfix" action="./php/add_products.php" method="POST">
			<h4>Add products</h4>
		  	<div class="form-group">
              <input type="text" class="form-control"  placeholder="Enter item name" name="name" required>
            </div>
			<div class="form-group">
              <input type="text" class="form-control"  placeholder="Enter item price" name="price" required>
            </div>
			<div class="form-group">
              <input type="text" class="form-control"  placeholder="Enter item quantity" name="quantity" required>
            </div>
			<?php
				if (!empty($_SESSION["success"])) {
					$success = $_SESSION["success"];
					printf('<div class="alert alert-success" role="alert"> %s </div>', $success);
				}
				$_SESSION["success"] = '';
				if (!empty($_SESSION["error"])) {
					$error= $_SESSION["error"];
					printf('<div class="alert alert-danger" role="alert"> %s </div>', $error);
				}
				$_SESSION["error"] = '';
			?>
            <div class="text-right">
              <button type="submit" class="btn btn-main" >Add item</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="page-wrapper">
  <div class="cart shopping">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="block">
            <div class="product-list">
              <form method="post">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Item Name</th>
                      <th>Item Price</th>
					  <th>Quantity</th>
					  <th>Remove Item</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
						$sql2 = "SELECT * FROM stores where store_name = '$store_name'";
						$result = mysqli_query($connection, $sql2);
						$row = mysqli_fetch_assoc($result);
						$id = $row['id'];
						$_SESSION['id'] = $id;

						
						$sql = "SELECT * FROM products where store_id = '$id'";
						$products = mysqli_query($connection, $sql);
						if (mysqli_num_rows($products) > 0) {
							while($product = mysqli_fetch_array($products)) {
					?>
					<tr>
						<td class="">
							<div class="product-info">
							<img width="80" src="images/shop/cart/cart-1.jpg" alt="" />
							</div>
						</td>
						<td>
						<?php echo $product['name'] ?>
						</td>
						<td>
						<?php echo "$ " . $product['price'] ?>
						</td>
						<td>
						<?php echo $product['quantity'] ?>
						</td>
						<td>
                        	<a href="remove_product.php?name=<?php echo $product["name"]?>" class="product-remove">Remove</a>
                      </td>
					</tr>
					<?php
						}
					}
					?>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
	<?php
		include "footer.html";
	?>

  </body>
  </html>
