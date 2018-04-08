const datos = (function(){
	const elementos = {
		limpiar: [],
		showOne: [],
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
	if(!flag){
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Insumos");
	}
}

function enviarInsumo(idTransporteInsumo, idInsumoEnSucursal, idCantidadEnviada){
	if($('#'+idCantidadEnviada.id).val() == ""){
		bootbox.alert("Antes de proceder, llena el campo \"Cantidad Recibida\"");
	} else {
		cantidadEnviada = $('#'+idCantidadEnviada.id).val();
		bootbox.confirm("¿Está seguro de enviar el insumo?", function(result){
			if(result){
				$.post("../ajax/transporteInsumo.php?op=send",{idTransporteInsumo : idTransporteInsumo, idInsumoEnSucursal : idInsumoEnSucursal, cantidadEnviada : cantidadEnviada}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				});
			}
		});
	}
}