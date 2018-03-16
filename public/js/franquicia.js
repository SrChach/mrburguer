const datos = (function(){
	const elementos = {
		limpiar: ["#idFranquicia", "#nombre"],
		showOne: ["idFranquicia", "nombre"],
		parametro: "idFranquicia"
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
		$("#titulo").html("Añadir nueva franquicia:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Franquicias");
	}
}