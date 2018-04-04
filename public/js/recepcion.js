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

function recibirInsumo(idTransporteInsumo, idInsumoEnSucursal, idCantidadRecibida, idObservacion){
	if($('#'+idCantidadRecibida.id).val() == ""){
		bootbox.alert("Antes de proceder, llena el campo \"Cantidad Recibida\"");
	} else {
		cantidadRecibida = $('#'+idCantidadRecibida.id).val();
		observaciones = $('#'+idObservacion.id).val();
		bootbox.confirm("¿Confirmar de recibido?", function(result){
			if(result){
				$.post("../ajax/transporteInsumo.php?op=receive",{idTransporteInsumo : idTransporteInsumo, cantidadRecibida : cantidadRecibida, observaciones : observaciones}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				});
			}
		});
	}
}