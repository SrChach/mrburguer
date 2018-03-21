const datos = (function(){
	const elementos = {
		limpiar: ["#idEmpleado", "#idSucursal", "#username", "#password", "#nomPila", "#apPaterno", "#apMaterno", "#fechaIngreso", "#mostrarimagen", "#imagen", "#estado"],
		showOne: ["idEmpleado", "idSucursal", "username", "nomPila", "apPaterno", "apMaterno", "fechaIngreso", "estado"],
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

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Registrar empleado:");
		$.post("../ajax/empleado.php?op=listPermiso&uid=blablabla", function(r){
			console.log("")
			$("#permisos").html(r);
		});
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

function showOneEmpleado(idEmpleado){
	$("#idSucursal").selectpicker("refresh");
	$("#mostrarimagen").show();

	console.log("Hue"+idEmpleado);

	$.post("../ajax/empleado.php?op=listPermiso&uid="+idEmpleado, function(r){
		$("#permisos").html(r);
	});
}