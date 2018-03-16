const datos = (function(){
	const elementos = {
		limpiar: ["#idinsumo", "#nombre", "#marca", "#existencias", "#piezasContiene", "#precioPromedio"],
		showOne: ["nombre", "marca", "existencias", "idinsumo", "piezasContiene", "precioPromedio"],
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