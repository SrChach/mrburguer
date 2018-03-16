const datos = (function(){
	const elementos = {
		limpiar: ["#idevento", "#nombre", "#tipo", "#plataforma", "#recompensa", "#fechaInicio", "#fechaFin"],
		showOne: ["nombre", "tipo", "plataforma", "recompensa", "fechaInicio", "fechaFin", "idevento"],
		parametro: "idevento"
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
		$("#titulo").html("Nuevo Evento!:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Eventos");
	}
}