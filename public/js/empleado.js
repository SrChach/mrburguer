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
		$("#titulo").html("Registrar empleado:");
		$("#btnagregar").hide();
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