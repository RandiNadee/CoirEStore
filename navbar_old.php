<div class="wait overlay">
    <div class="loader"></div>
</div>
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
                <?php if (isset($_SESSION["uid"])) { ?>
                    <li><a href="customer_order.php"></span>My Orders</a></li>
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi," . $_SESSION["name"]; ?></a>
                        <ul class="dropdown-menu">
                            <li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Cart</a></li>
                            <li class="divider"></li>
                            <li><a href="password_change.php" style="text-decoration:none; color:blue;">Change Password</a></li>
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