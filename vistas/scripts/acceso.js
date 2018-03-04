$("#frmAcceso").on('submit',function(e){
	e.preventDefault();
	username = $("#username").val();
	password = $("#password").val();

	$.post("../ajax/empleado.php?op=access", { username:username, password:password}, function(data){
		if(data == "null"){
			alert("Usuario y/o contraseña incorrectos")
		} else {
			$(location).attr("href", "producto.php");
		}
	});
});