$(document).ready(function(){

	$(".register-btn").on("click", function(){

		$.ajax({
			url : '../system_admin/classes/Credentials.php',
			method : "POST",
			data : $("#admin-register-form").serialize(),
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#admin-register-form").trigger("reset");
					alert(resp.message);
					window.location.href = window.origin+"/Ecommerce/system_admin/index.php";
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}
		});

	});

	$(".login-btn").on("click", function(){
		console.log("clicked");
		$.ajax({
			url : '../system_admin/classes/Credentials.php',
			method : "POST",
			data : $("#admin-login-form").serialize(),
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#admin-login-form").trigger("reset");
					//$(".message").html('<span class="text-success">'+resp.message+'</span>');
					window.location.href = window.origin+"/Ecommerce/system_admin/index.php";
				}else if(resp.status == 303){
					$(".message").html('<span class="text-danger">'+resp.message+'</span>');
				}
			}
		});

	});

});