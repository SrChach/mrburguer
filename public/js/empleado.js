const datos = (function(){
	const elementos = {
		limpiar: ["#idEmpleado", "#idSucursal", "#username", "#password", "#nombre", "#apellidoPaterno", "#apellidoMaterno", "#fechaIngreso", "#mostrarimagen", "#imagen", "#telefono", "#correoElectronico", "#puesto", "#estado", "#delegacion", "#colonia", "#calle", "#numExt", "#numInt"],
		showOne: ["idEmpleado", "idSucursal", "username", "password", "nombre", "apellidoPaterno", "apellidoMaterno", "fechaIngreso", "telefono", "correoElectronico", "puesto", "estado", "delegacion", "colonia", "calle", "numExt", "numInt"],
		parametro: "idEmpleado"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

iniciar();
$.post("../ajax/empleado.php?op=selectSucursal", function(r){
	$("#idSucursal").html(r);
	$("#idSucursal").selectpicker('refresh');
});

$("#mostrarimagen").hide();

$.post("../ajax/empleado.php?op=listPermiso&uid=", function(r){
	$("#permisos").html(r);
});

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Registrar empleado:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Empleados");
	}
}

function borrar(idEmpleado){
	bootbox.confirm("¿Desea activar eliminar?", function(result){
		if(result){
			$.post("../ajax/empleado.php?op=delete",{idEmpleado : idEmpleado}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function showOneEmpleado(){
	$("#idSucursal").selectpicker("refresh");
	$("#mostrarimagen").show();
	$("#mostrarimagen").attr("src", "../files/empleados/"+data.imagen);

	$.post("../ajax/empleado.php?op=listPermiso&uid="+idEmpleado, function(r){
		$("#permisos").html(r);
	});
}