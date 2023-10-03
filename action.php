<?php
session_start();

$ip_add = getenv("REMOTE_ADDR");
include "database.php";

if (isset($_POST["category"])) {
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con, $category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li>
	";
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}

if (isset($_POST["get_hot_categories"])) {
	$category_query = "SELECT * FROM categories LIMIT 4";
	$run_query = mysqli_query($con, $category_query) or die(mysqli_error($con));
	$ar = [];
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_assoc($run_query)) {
			$ar[] = $row;
		}
	}
	echo json_encode(['status' => 202, 'message' => $ar]);
}

if (isset($_POST["brand"])) {
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con, $brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Brands</h4></a></li>
	";
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}

if (isset($_POST["page"])) {
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con, $sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count / 9);
	for ($i = 1; $i <= $pageno; $i++) {
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}

if (isset($_POST["getProduct"])) {
	$limit = 9;
	if (isset($_POST["setPage"])) {
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	} else {
		$start = 0;
	}
	$product_query = "SELECT * FROM products LIMIT $start,$limit";
	$run_query = mysqli_query($con, $product_query);
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			$pro_description = $row['product_desc'];
			echo "
				<div class='col-md-4'>
					<div class='panel panel-primary'>
						<div class='panel-heading'>$pro_title</div>
						<div class='panel-body' >
							<img src='product_images/$pro_image' style='width:160px; height:180px; display: block; margin-left: auto; margin-right: auto;'/>
						</div>
						<div class='panel-heading'>" . CURRENCY . " $pro_price.00
							<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
						</div>
					</div>
				</div>	
			";
		}
	}
}

if (isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])) {
	if (isset($_POST["get_seleted_Category"])) {
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE product_cat = '$id'";
	} else if (isset($_POST["selectBrand"])) {
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products WHERE product_brand = '$id'";
	} else {
		$keyword = $_POST["keyword"];
		$sql = "SELECT * FROM products WHERE product_keywords LIKE '%$keyword%'";
	}

	$run_query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($run_query)) {
		$pro_id    = $row['product_id'];
		$pro_cat   = $row['product_cat'];
		$pro_brand = $row['product_brand'];
		$pro_title = $row['product_title'];
		$pro_price = $row['product_price'];
		$pro_image = $row['product_image'];
		echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_price.00
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
								</div>
							</div>
						</div>	
			";
	}
}

if (isset($_POST["addToCart"])) {


	$p_id = $_POST["proId"];


	if (isset($_SESSION["uid"])) {

		$user_id = $_SESSION["uid"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con, $sql);
		$count = mysqli_num_rows($run_query);
		if ($count > 0) {
			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			"; //not in video
		} else {
			$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','$user_id','1')";
			if (mysqli_query($con, $sql)) {
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
			}
		}
	} else {
		$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
		$query = mysqli_query($con, $sql);
		if (mysqli_num_rows($query) > 0) {
			echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is already added into the cart Continue Shopping..!</b>
					</div>";
			exit();
		}
		$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`) 
			VALUES ('$p_id','$ip_add','-1','1')";
		if (mysqli_query($con, $sql)) {
			echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your product is Added Successfully..!</b>
					</div>
				";
			exit();
		}
	}
}

if (isset($_POST["count_item"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
	} else {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}

	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}

if (isset($_POST["Common"])) {

	if (isset($_SESSION["uid"])) {
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_discount,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'";
	} else {
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_discount,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con, $sql);
	if (isset($_POST["getCartItem"])) {
		if (mysqli_num_rows($query) > 0) {
			$n = 0;
			while ($row = mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row">
						<div class="col-md-3">' . $n . '</div>
						<div class="col-md-3"><img class="img-responsive" src="product_images/' . $product_image . '" /></div>
						<div class="col-md-3">' . $product_title . '</div>
						<div class="col-md-3">' . CURRENCY . '' . $product_price . '</div>
					</div>';
			}
?>
			<a style="float:right; margin-right:5%" href="cart.php" class="btn btn-warning">Checkout&nbsp;&nbsp;<span class="glyphicon glyphicon-shopping-cart"></span></a>
<?php
			exit();
		}
	}

	if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			echo "<form method='post' action='login_form.php'>";
			$n = 0;
			while ($row = mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_discount = $row["product_discount"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				$product_total = $product_price - (($product_price / 100) * $product_discount);

				echo
				'<div class="row">
								<div class="col-md-2">
									<div class="btn-group">
										<a href="#" remove_id="' . $product_id . '" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
										<a href="#" update_id="' . $product_id . '" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
									</div>
								</div>
								<input type="hidden" name="product_id[]" value="' . $product_id . '"/>
								<input type="hidden" name="" value="' . $cart_item_id . '"/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/' . $product_image . '"></div>
								<div class="col-md-2">' . $product_title . '</div>
								<div class="col-md-1"><input type="text" class="form-control qty" value="' . $qty . '" ></div>
								<div class="col-md-2"><input type="text" class="form-control price" value="' . $product_price . '" readonly="readonly"></div>
								<div class="col-md-1"><input type="text" class="form-control discount" value="' . $product_discount . '" readonly="readonly"></div>
								<div class="col-md-2"><input type="text" class="form-control total" value="' . $product_total . '" readonly="readonly"></div>
							</div>';
			}

			echo '<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4">
						<b class="net_total" style="font-size:20px;"> </b>
					</div>';
			if (!isset($_SESSION["uid"])) {
				echo '<input type="submit" style="float:right; margin:2%;" name="login_user_with_product" class="btn btn-info btn-lg" value="Checkout" >
						</form>';
			} else if (isset($_SESSION["uid"])) {
				echo '
						</form>
						<form id="checkoutform" action="process_payment.php" method="post">';
				echo '
				<div class="row" style="margin-left:5%">
					<span class="col-sm-2 m-1">Select Payment method:</span>
					<div class="btn-group btn-group-toggle" id="payment_method" data-toggle="buttons">
						<label class="btn btn-primary active" id="codbutton">
							<input type="radio" name="options" onchange="changedCodPayment();" id="cod" value="cod" autocomplete="off" checked> Cash on delivery
						</label>
						<label class="btn btn-primary" id="onlinebutton">
							<input type="radio" name="options" onchange="changedOnlinePayment();" id="onlinepay" value="online" autocomplete="off"> Online Pay
						</label>
					</div>
				</div>
				<div class="row" style="float:right; margin-right:5%">
				';

				$x = 0;
				$sql = "SELECT id FROM cart WHERE user_id='$_SESSION[uid]'";
				$query = mysqli_query($con, $sql);
				$row = mysqli_fetch_assoc($query);
				echo '<input type="hidden" name="c_id" value="' . $row["id"] . '">';

				echo	'
				<button type="submit" style="float:right; margin-right:5%" class="btn btn-primary checkout-btn">Checkout</button>
				</form> </div>';
			}
		}
	}
}

if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[uid]'";
	} else {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if (mysqli_query($con, $sql)) {
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is removed from cart</b>
				</div>";
		exit();
	}
}


if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND user_id = '$_SESSION[uid]'";
	} else {
		$sql = "UPDATE cart SET qty='$qty' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
	}
	if (mysqli_query($con, $sql)) {
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is updated</b>
				</div>";
		exit();
	}
}

if (isset($_POST["subject"])) {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];

	$sql = "INSERT INTO feedback (`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";

	if (mysqli_query($con, $sql)) {
		echo json_encode(['status' => 202, 'message' => "Feedback recieved successfuly"]);
		exit();
	} else {
		echo json_encode(['status' => 303, 'message' => "Try again"]);
		exit();
	}
}

if (isset($_POST['password_change'])) {
	extract($_POST);
	if (isset($_SESSION["uid"])) {
		$uid = $_SESSION["uid"];
		if (!empty($cur_password) && !empty($new_password) && !empty($re_password)) {
			if ($new_password == $re_password) {
				$hash_cur_password = md5($cur_password);
				$hash_new_password = md5($new_password);
				$sql = "SELECT * FROM user_info WHERE user_id = '$uid' AND password = '$hash_cur_password'";
				$query = mysqli_query($con, $sql);
				if (mysqli_num_rows($query) > 0) {
					$sql = "UPDATE user_info SET `password` = '$hash_new_password' WHERE user_id = '$uid'";
					if (mysqli_query($con, $sql)) {
						echo json_encode(['status' => 202, 'message' => 'Password Updated Successfully']);
						exit();
					}
				} else {
					echo json_encode(['status' => 303, 'message' => 'Wrong password']);
					exit();
				}
			} else {
				echo json_encode(['status' => 303, 'message' => 'Password mismatch']);
				exit();
			}
		} else {
			echo json_encode(['status' => 303, 'message' => 'Empty fields']);
			exit();
		}
	}
	echo json_encode(['status' => 303, 'message' => 'Something went wrong']);
	exit();
}

?>