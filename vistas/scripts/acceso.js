$("#frmAcceso").on('submit',function(e){
	e.preventDefault();
	username = $("#username").val();
	password = $("#password").val();

	$.post("../ajax/empleado.php?op=access", { username:username, password:password}, function(data){
		if(data == "null" || data == null || data ==""){
			alert("Usuario y/o contraseña incorrectos");
		} else {
			alert(data);
			$(location).attr("href", "producto.php");
		}
		<?php 
			exit();
		?>
	});
});