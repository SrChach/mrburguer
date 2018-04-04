const datos = (function(){
	const elementos = {
		limpiar: ["#idcliente", "#nombre", "#apellidoPaterno", "#apellidoMaterno", "#fechaNacimiento", "#cuentaFB", "#cuentaInstagram", "#cuentaTwitter", "#correoElectronico", "#telefono"],
		showOne: ["#nombre", "#apellidoPaterno", "#apellidoMaterno", "#fechaNacimiento", "#cuentaFB", "#cuentaInstagram", "#cuentaTwitter", "#correoElectronico", "#telefono", "#idcliente"],
		parametro: "idcliente"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

iniciar();

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Registrar Cliente:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Clientes");
	}
}

function necesidades(){
	$.post("../ajax/transporteInsumo.php?op=listNeeds",{}, function(data, status){
		$("#necesidades").html(data);
 	});
 	$.post("../ajax/transporteInsumo.php?op=toConfirm",{}, function(data, status){
		$("#notif").html(data);
 	});
}

necesidades();