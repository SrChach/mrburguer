const datos = (function(){
	const elementos = {
		limpiar: ["#idcompra", "#idproveedor", "#fecha", "#nombre", "#apellidoPaterno", "#apellidoMaterno", "#monto", "#iva"],
		showOne: ["idcompra", "idproveedor", "fecha", "nombre", "apellidoPaterno", "apellidoMaterno", "monto", "iva"],
		parametro: "idcompra"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

iniciar();
$.post("../ajax/compra.php?op=selectProveedor", function(r){
	$("#idProveedor").html(r);
	$("#idProveedor").selectpicker('refresh');
});

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}