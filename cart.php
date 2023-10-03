<?php
session_start();
include "top.php";
include "navbar.php";
?>

<style>
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		margin: 0;
	}
</style>
<p><br /></p>
<p><br /></p>
<p><br /></p>
<div class="container-fluid mx-auto">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8" id="cart_msg">
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Cart Checkout</div>
				<div class="panel-body">
					<div class="row justify-content-md-center">
						<div class="col-md-2"><b>Action</b></div>
						<div class="col-md-2"><b>Product Image</b></div>
						<div class="col-md-2"><b>Product Name</b></div>
						<div class="col-md-1"><b>Quantity</b></div>
						<div class="col-md-2"><b>Product Price <?php echo CURRENCY; ?>t </b></div>
						<div class="col-md-1"><b>Discount</b></div>
						<div class="col-md-2"><b>Total Price <?php echo CURRENCY; ?></b></div>
					</div>
					<div id="cart_checkout"></div>
				</div>
			</div>
			<div class="panel-footer"></div>
		</div>
	</div>
	<div class="col-md-2"></div>

</div>

<div class="modal fade" id="add_card_modal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="addCard" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="padding: 5%;">
			<div class="modal-header">
				<h3 class="modal-title bold" id="addCard">Add Card Details</h3>
				<button type="button" onclick="closeAddCardModal();" id="close-btn" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="add-product-form" enctype="multipart/form-data">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Card Number</label>
								<input type="number" id="card_number" class="form-control" placeholder="Enter Card Number">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Expire Date : (MM/YYYY)</label>
								<div class="row" style="margin-left: 2px;">
									<input type="number" id="exmonth" class="form-group col-xs-3" placeholder="Month">&nbsp;/&nbsp;<input type="number" id="exyear" class="form-group" placeholder="Year">
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>CVV number: (***)</label>
								<input type="number" id="cvv" class="form-control" placeholder="Enter CVV Number">
							</div>
						</div>
						<input type="hidden" name="add_product" value="1">
						<div class="col-12">
							<button type="button" class="btn btn-primary checkout-btn">Place Order</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	var CURRENCY = '<?php echo CURRENCY; ?>';
</script>
</body>

<script>
	$(document).ready(function() {
		$(".checkout-btn").on("click", function() {
			if (validateCreditCard()) {
				$.ajax({
					url: "process_payment.php",
					method: "POST",
					data: $("#checkoutform").serialize(),
					success: function(response) {
						window.location.href = "customer_order.php";
					}
				});
			}
		});

		$("#checkoutform").on("submit", function(event) {
			event.preventDefault();
			$(".overlay").show();
			$.ajax({
				url: "process_payment.php",
				method: "POST",
				data: $("#checkoutform").serialize(),
				success: function(response) {
					var resp = $.parseJSON(response);
					console.log(resp);
					if (resp.message == "checkout_success") {
						window.location.href = "orders.php";
					} else {
						$("#cart_msg").html(resp.message);
					}
				}
			});
		});
	});

	function validateCreditCard() {
		var onlinepayElement = document.getElementById('onlinepay');

		if (onlinepayElement.checked) {
			var cardnumber = document.getElementById('card_number').value;
			console.log(cardnumber);
			var cvvnumber = document.getElementById('cvv').value;
			var exmonth = document.getElementById('exmonth').value;
			var exyear = document.getElementById('exyear').value;
			if (validateCardNumber(cardnumber) && validateExpireDate(exmonth, exyear) && validateCVVNumber(cvvnumber)) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	function changedCodPayment() {
		$("#add_card_modal").modal('hide');
	}

	function changedOnlinePayment() {
		$("#add_card_modal").modal('show');
		closeAddCardModal();
	}

	function closeAddCardModal() {
		$("#codbutton").addClass("active");
		$("#cod").prop('checked', true);
		$("#onlinebutton").removeClass("active");
	}

	function validateCardNumber(cardnumber) {
		var amexCardno = /^(?:3[47][0-9]{13})$/;
		var visaCardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
		var masterCardno = /^(?:5[1-5][0-9]{14})$/;
		if (cardnumber.match(amexCardno) || cardnumber.match(visaCardno) || cardnumber.match(masterCardno)) {
			return true;
		} else {
			alert("Card Number is not valid");
			return false;
		}
	}

	function validateCVVNumber(cvvnumber) {
		console.log(cvvnumber);
		var cvv = /^[0-9]{3,4}$/;
		if (cvvnumber.match(cvv)) {
			return true;
		} else {
			alert("CVV is not valid");
			return false;
		}
	}

	function validateExpireDate(exmonth, exyear) {
		var today, someday;
		today = new Date();
		someday = new Date();
		someday.setFullYear(exyear, exmonth, 1);

		if (someday < today) {
			alert("Please select a valid expiry date");
			return false;
		} else {
			return true;
		}
	}
</script>

</html>