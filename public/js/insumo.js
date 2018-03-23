const datos = (function(){
	const elementos = {
		limpiar: ["#idinsumo", "#nombre", "#existencias", "#precioPromedio"],
		showOne: ["nombre", "existencias", "idinsumo", "precioPromedio"],
		parametro: "idinsumo"
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
		$("#titulo").html("Añadir nuevo insumo:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Insumos");
	}
}