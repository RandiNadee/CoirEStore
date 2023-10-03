$(document).ready(function () {

	getSalesManagers();

	function getSalesManagers() {
		$.ajax({
			url: '../system_admin/classes/SalesManagers.php',
			method: 'POST',
			data: { GET_SALES_MANAGERS: 1 },
			success: function (response) {

				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {

					var salesManagersHTML = "";

					$.each(resp.message, function (index, value) {

						salesManagersHTML += '<tr>' +
							'<td>#</td>' +
							'<td>' + value.name + '</td>' +
							'<td>' + value.email + '</td>' +
							'<td>' + value.is_active + '</td>' +
							'<td><a class="btn btn-sm btn-info edit-password"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a class="btn btn-sm btn-danger delete-sales-manager"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-trash-alt"></i></a></td>'+
							'</tr>'

					});

					$("#sales_manager_list").html(salesManagersHTML);

				} else if (resp.status == 303) {

				}
			}
		})
	}


	$(".register-btn").on("click", function () {

		$.ajax({
			url: '../system_admin/classes/SalesManagers.php',
			method: "POST",
			data: $("#salesmanager-register-form").serialize(),
			success: function (response) {
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#salesmanager-register-form").trigger("reset");
					alert(resp.message);
					window.location.href = window.origin+"/Ecommerce/system_admin/salesManagers.php";
				} else if (resp.status == 303) {
					alert(resp.message);
				}
			}
		});
	});

	
	$("#new-salesmanager").on("click", function () {
		window.location.href = window.origin+"/Ecommerce/system_admin/register_sales_manager.php";
	});


	$(document.body).on("click", ".edit-password", function(){
		var sales_manager = $.parseJSON($.trim($(this).children("span").html()));
		console.log(sales_manager);
		$("input[name='name']").val(sales_manager.name);
		$("input[name='email']").val(sales_manager.email);
		$("#change_sales_manager_password").modal('show');
	});


	$(document.body).on("click", ".delete-sales-manager", function(){
		var sales_manager = $.parseJSON($.trim($(this).children("span").html()));
		if (confirm("Are you sure to delete this account ?")) {
			$.ajax({
				url : '../system_admin/classes/SalesManagers.php',
				method : 'POST',
				data : {DELETE_SALES_MANAGER: 1, userid:sales_manager.id},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						getSalesManagers();
					}else if (resp.status == 303) {
						alert(resp.message);
					}
				}

			});
		}else{
			alert('Cancelled');
		}
	});


	$(document.body).on("click", ".update-password-btn", function(){
		console.log("clicked");
		$.ajax({
			url : '../system_admin/classes/SalesManagers.php',
			method : 'POST',
			data : $("#sales-manager-password-change").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getSalesManagers();
					console.log("updated");
					$("#change_sales_manager_password").trigger("reset");
					$("#change_sales_manager_password").modal('hide');
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				
			}
		});
	});

});