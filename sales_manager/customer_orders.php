<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
	header("location:login.php");
}
?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
	<div class="row">

		<?php include "./templates/sidebar.php"; ?>

		<div class="row">
			<div class="col-10">
				<h2>Customers</h2>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th>#</th>
						<th>Order Id</th>
						<th>User Name</th>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Order Date</th>
						<th>Total</th>
						<th>Payment Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="customer_order_list">
				</tbody>
			</table>
		</div>
		</main>
	</div>
</div>


<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/customers.js"></script>