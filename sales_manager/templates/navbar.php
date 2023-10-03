 <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
 	<a class="navbar-brand col-sm-1 bg-dark mr-0" href="#">E-Store</a>
 	<ul class="navbar-nav px-3">
 		<li class="nav-item text-nowrap">
 			<?php
				if (isset($_SESSION['admin_id'])) {
				?>
 				<a class="nav-link" href="../sales_manager/admin-logout.php">Sign out</a>
 			<?php
				} else {
					$uriAr = explode("/", $_SERVER['REQUEST_URI']);
					$page = end($uriAr);
				?>
 				<a class="nav-link" href="../sales_manager/login.php">Login</a>
 				<?php
					if ($page !== "login.php") {
					?>
 					<a class="nav-link" href="../sales_manager/login.php">Login</a>
 				<?php
					}
				}

				?>

 		</li>
 	</ul>
 </nav>