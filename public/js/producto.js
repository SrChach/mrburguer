const datos = (function(){
	const elementos = {
		limpiar: ["#idproducto", "#nombre", "#precioActual", "#imagenactual", "#imagen"],
		showOne: ["nombre", "precioActual", "idproducto"],
		parametro: "idproducto"
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
		$("#titulo").html("Añadir nuevo producto:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Productos manejados");
	}
}

function showOneProducto(imagen){
	$("#mostrarimagen").show();
	$("#mostrarimagen").attr("src", "../files/productos/"+imagen);
}