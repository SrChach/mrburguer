const datos = (function(){
	const elementos = {
		limpiar: ["#idsucursal", "#nombre", "#idFranquicia", "#isMobile", "#telefono"],
		showOne: ["idsucursal", "nombre", "idFranquicia", "isMobile", "telefono"],
		parametro: "idsucursal"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

iniciar();
$.post("../ajax/sucursal.php?op=selectFranquicia", function(r){
	$("#idFranquicia").html(r);
	$("#idFranquicia").selectpicker('refresh');
});

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Registrar Sucursal:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Sucursales");
	}
}

function showOneSucursal(){
	$("#idFranquicia").selectpicker("refresh");
	$("#isMobile").selectpicker("refresh");
}