const datos = (function(){
	const elementos = {
		limpiar: ["#idTransporteInsumo", "#cantidadRecibida", "#idEmpleadoRecibe", "#observaciones"],
		showOne: ["idTransporteInsumo", "cantidadRecibida", "idEmpleadoRecibe", "observaciones"],
		parametro: "idTransporteInsumo"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

iniciar();
$("#nombresucursal").html("Confirmar recepcion de Insumos");

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Recibir insumo:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Insumos");
	}
}