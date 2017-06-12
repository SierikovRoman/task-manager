jQuery(document).ready(function($) {
	$('#login-form').submit(function(event) {
		var form = $(this).serialize();
		$.ajax({
			url: 'login.php',
			type: 'POST',
			dataType: 'html',
			data: form,
			success: function(data){
				data=$.trim(data);
				if (data=="admin")//если админ
				{ 
					document.location.href="Administrator.php";
				}else if(data=='pm'){
					document.location.href="ProjectManager.php";
				}else if(data=='employee'){
					document.location.href="Employee.php";
				}else if(data=='error'){
					$('#error').text('Sorry! Your password or email is incorrect! Try again.');
				}
			}
		})		
	});
});









