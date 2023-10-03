<?php
session_start();
if (!isset($_SESSION['uid'])) {
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
</head>

<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
                    <span class="sr-only"> navigation toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">E-Store</a>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php"></span>Home</a></li>
                    <li><a href="products.php">Product</a></li>
                    <li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
                    <li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Search</button></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" id="cart_container" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
                        <div class="dropdown-menu" style="width:400px;">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-3">Product No</div>
                                        <div class="col-md-3 col-xs-3">Product Image</div>
                                        <div class="col-md-3 col-xs-3">Product Name</div>
                                        <div class="col-md-3 col-xs-3">Total Rs. </div>
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
                    <?php if (isset($_SESSION["uid"])) { ?>
                        <li><a href="customer_order.php"></span>My Orders</a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi," . $_SESSION["name"]; ?></a>
                            <ul class="dropdown-menu">
                                <li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Cart</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
                            </ul>
                        </li>
                    <?php } else { ?>
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
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <p><br /></p>
    <p><br /></p>
    <p><br /></p>
    <div class="container">
        <div class="row justify-content-center" style="margin:100px 0;">
            <div class="col-md-4">
                <h4>Password Change</h4>
                <p class="message"></p>
                <form id="change-password-form">
                    <div class="form-group">
                        <label for="cur_password">Current Password</label>
                        <input type="password" class="form-control" name="cur_password" id="cur_password" placeholder="Current Password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="re_password">Confirm New Password</label>
                        <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Confirm Password">
                    </div>
                    <input type="hidden" name="password_change" value="1">
                    <button type="button" class="btn btn-primary change-password">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        $(".change-password").on("click", function() {
            console.log("clicked");
            $.ajax({
                url: 'action.php',
                method: "POST",
                data: $("#change-password-form").serialize(),
                success: function(response) {
                    console.log(response);
                    var resp = $.parseJSON(response);
                    if (resp.status == 202) {
                        $("#change-password-form").trigger("reset");
                        window.location.href = "index.php";
                    } else if (resp.status == 303) {
                        alert(resp.message);
                        location.reload();
                    }
                }
            });

        });

    });
</script>