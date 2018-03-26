$(document).ready(() => {
	$("#frmAcceso").on('submit',function(e){
		e.preventDefault();
		username = $("#username").val();
		password = $("#password").val();
		$.post(
			"../ajax/empleado.php?op=access",
			{username: username, password: password},
			function(data){
				if(data === "null" || data === null){
					bootbox.alert("Usuario y/o contraseña incorrectos");
					$(".form-group").addClass("has-error");
				} else {
					window.location.replace("inicio.php")
				}
			}
		);
	});
})