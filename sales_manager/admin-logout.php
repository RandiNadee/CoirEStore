<?php
session_start();
?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<?php include_once("./templates/footer.php"); ?>

<?php
if (isset($_SESSION["admin_id"])) { ?>

	<script>
		set_status_logout(<?php echo json_encode($_SESSION['admin_id']); ?>);
		function set_status_logout(user_id) {
			$.ajax({
				url: '../sales_manager/classes/Credentials.php',
				method: "POST",
				data: {
					salesmanager_logout: 1,
					admin_id: user_id
				},
				success: function(response) {
					console.log(response);
					window.location.replace("../sales_manager/index.php");
				}
			});
		}
	</script>



<?php
} else {
	header("location:index.php");
}
?>