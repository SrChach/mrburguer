const datos = (function(){
	const elementos = {
		limpiar: ["#idventa", "#idCliente", "#idEmpleado", "#fecha", "#montoTotal", "#iva", "#descuentoTotal", "#status", "#pagoTarjeta"],
		parametro: "idventa"
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
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
	}
}
