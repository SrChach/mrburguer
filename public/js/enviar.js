const datos = (function(){
	const elementos = {
		limpiar: ["#idTransporteInsumo", "#idInsumoEnSucursal", "#cantidadEnviada"],
		showOne: ["idTransporteInsumo", "idInsumoEnSucursal", "cantidadEnviada"],
		parametro: "idTransporteInsumo"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

var param = getParameterByName("SUC");
iniciar(param);

$.post("../ajax/ies.php?op=gname&SUC="+param, function(r){
	data = JSON.parse(r);
	$("#nombresucursal").html("Peticiones de la sucursal - \""+data.nombre+"\"");
});

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