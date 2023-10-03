$(document).ready(function () {

	getCustomers();
	getCustomerOrders();

	$(".confirm-order").on("click", function () {
		console.log("clicked");
		var order = $.parseJSON($.trim($(this).children("span").html()));
		console.log(order);
		$.ajax({
			url: '../sales_manager/classes/Products.php',
			method: 'POST',
			data: { CONFIRM_ORDER: 1, o_id: order.id },
			success: function (response) {
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getBrands();
					$("#add_brand_modal").modal('hide');
					alert(resp.message);
				} else if (resp.status == 303) {
					alert(resp.message);
				}

			}
		});

	});

});

function getCustomers() {
	$.ajax({
		url: '../sales_manager/classes/Customers.php',
		method: 'POST',
		data: { GET_CUSTOMERS: 1 },
		success: function (response) {

			console.log(response);
			var resp = $.parseJSON(response);
			if (resp.status == 202) {

				var customersHTML = "";

				$.each(resp.message, function (index, value) {

					customersHTML += '<tr>' +
						'<td>#</td>' +
						'<td>' + value.first_name + ' ' + value.last_name + '</td>' +
						'<td>' + value.email + '</td>' +
						'<td>' + value.mobile + '</td>' +
						'<td>' + value.address1 + '<br>' + value.address2 + '</td>' +
						'</tr>'

				});

				$("#customer_list").html(customersHTML);

			} else if (resp.status == 303) {

			}

		}
	})

}

function getCustomerOrders() {
	// $.ajax({
	// 	url: 'https://formsubmit.co/hansajithsenarath@gmail.com',
	// 	method: 'POST',
	// 	data: { name: "hansajith senarath" },
	// 	success: function (response) {
	// 		console.log(response);
	// 	}
	// });

	$.ajax({
		url: '../sales_manager/classes/Customers.php',
		method: 'POST',
		data: { GET_CUSTOMER_ORDERS: 1 },
		success: function (response) {

			console.log(response);
			var resp = $.parseJSON(response);
			if (resp.status == 202) {

				var customerOrderHTML = "";

				$.each(resp.message, function (index, value) {
					console.log(value.product_price*value.qty );
					customerOrderHTML += '<tr>' +
						'<td>#</th>' +
						'<td>' + value.order_id + '</td>' +
						'<td>' + value.first_name +" "+ value.last_name + '</td>' +
						'<td>' + value.product_title + '</td>' +
						'<td>' + value.qty + '</td>' +
						'<td>' + value.order_date + '</td>' +
						'<td>' + value.product_price*value.qty + '</td>' +
						'<td>' + value.p_status + '</td>';

					if (value.p_status == "Inprogress") {
						customerOrderHTML += '<td><button class="btn btn-sm btn-success" onclick="confirm_order('+value.order_id+')"><a class="confirm-order" ><i class="fa fa-check"></i></a></button></td>' +
							'</tr>';
					} else {
						customerOrderHTML += '<td></td></tr>';
					}

				});

				$("#customer_order_list").html(customerOrderHTML);

			} else if (resp.status == 303) {
				$("#customer_order_list").html(resp.message);
			}

		}
	});

}

function confirm_order(order_id) {
	console.log("clicked");
	console.log(order_id);
	$.ajax({
		url: '../sales_manager/classes/Products.php',
		method: 'POST',
		data: { CONFIRM_ORDER: 1, o_id: order_id },
		success: function (response) {
			console.log(response);
			var resp = $.parseJSON(response);
			console.log(resp);
			if (resp.status == 202) {
				getCustomerOrders();
				alert(resp.message);
			} else if (resp.status == 303) {
				alert(resp.message);
			}

		}
	});
}