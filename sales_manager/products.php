<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("location:login.php");
}else{
  if($_SESSION['user_type'] != 2){
    header("location:templates/access_denied.php");
  }
}
?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    
    <?php include "./templates/sidebar.php"; ?>

      <div class="row">
      	<div class="col-10">
      		<h2>Product List</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th>Price</th>
              <th>Discount</th>
              <th>Quantity</th>
              <th>Category</th>
              <th>Brand</th>
            </tr>
          </thead>
          <tbody id="product_list">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/products.js"></script>