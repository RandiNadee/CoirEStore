<?php
session_start();
// include_once "config/constants.php";
if (!isset($_SESSION["uid"])) {
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>E-Store</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery2.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="main.js"></script>
	<style>
		table tr td {
			padding: 10px;
		}
	</style>
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">E-Store</a>
			</div>
			<div class="collapse navbar-collapse" id="collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php"></span>Home</a></li>
					<li><a href="products.php"></span>Products</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
						<div class="dropdown-menu" style="width:400px;">
							<div class="panel panel-success">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-3">Sl.No</div>
										<div class="col-md-3">Product Image</div>
										<div class="col-md-3">Product Name</div>
										<div class="col-md-3">Total Rs.</div>
									</div>
								</div>
								<div class="panel-body">
									<div id="cart_product">
									</div>
								</div>
								<div class="panel-footer"></div>
							</div>
						</div>
					</li>
					<?php if (isset($_SESSION["uid"])) {
						echo '
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi,".$_SESSION["name"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Cart</a></li>
						<li class="divider"></li>
						<li><a href="password_change.php" style="text-decoration:none; color:blue;">Change Password</a></li>
						<li class="divider"></li>
						<li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
					</ul>
				</li>
                ';
					} else {
						echo '
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">SignIn</a>
                    <ul class="dropdown-menu">
                        <div style="width:300px;">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Login</div>
                                <div class="panel-heading">
                                    <form onsubmit="return false" id="login">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required />
                                        <label for="email">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required />
                                        <p><br /></p>
                                        <a href="#" style="color:white; list-style:none;">Forgotten Password</a><input type="submit" class="btn btn-success" style="float:right;">
                                    </form>
                                </div>
                                <div class="panel-footer" id="e_msg"></div>
                            </div>
                        </div>
                    </ul>
                </li>
                <li><a href="customer_registration.php?register=1">Register</a></li>
                ';
					} ?>
				</ul>
			</div>
		</div>
	</div>
	<p><br /></p>
	<p><br /></p>
	<p><br /></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<h1>Customer Order details</h1>
						<hr />
						<?php
						include_once("database.php");
						$user_id = $_SESSION["uid"];
						$orders_list = "SELECT o.order_id,o.user_id,o.product_id,o.qty,o.p_status,o.order_date,p.product_title,p.product_price,p.product_image FROM orders o,products p WHERE o.user_id='$user_id' AND o.product_id=p.product_id";
						$query = mysqli_query($con, $orders_list);
						if (mysqli_num_rows($query) > 0) {
							while ($row = mysqli_fetch_array($query)) {
						?>
								<div class="row" style="margin-bottom: 5%;">
									<div class="col-md-6">

										<img style="float:right; width:240px; height:260px;" src="product_images/<?php echo $row['product_image']; ?>" class="img-responsive img-thumbnail" />
									</div>
									<div class="col-md-6">
										<table>
											<tr>
												<td>Product Name</td>
												<td><b><?php echo $row["product_title"]; ?></b> </td>
											</tr>
											<tr>
												<td>Product Price</td>
												<td><b><?php echo  CURRENCY . " " . $row["product_price"] * $row["qty"]; ?></b></td>
											</tr>
											<tr>
												<td>Quantity</td>
												<td><b><?php echo $row["qty"]; ?></b></td>
											</tr>
											<tr>
												<td>Order Status</td>
												<td><b><?php echo $row["p_status"]; ?></b></td>
											</tr>
											<tr>
												<td>Date</td>
												<td><b><?php echo $row["order_date"]; ?></b></td>
											</tr>
										</table>
									</div>
								</div>
						<?php
							}
						}
						?>

					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>

</html>