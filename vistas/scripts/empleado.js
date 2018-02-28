var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});

	$.post("../ajax/empleado.php?op=selectSucursal", function(r){
		$("#idSucursal").html(r);
		$("#idSucursal").selectpicker('refresh');
	});

	$("#mostrarimagen").hide();

	$.post("../ajax/empleado.php?op=listPermiso&uid=", function(r){
		$("#permisos").html(r);
	});
}

function limpiar(){
	$("#idEmpleado").val("");
	$("#idSucursal").val("");
	$("#username").val("");
	$("#password").val("");
	$("#nombre").val("");
	$("#apellidoPaterno").val("");
	$("#apellidoMaterno").val("");
	$("#fechaIngreso").val("");
	$("#mostrarimagen").attr("src", "");
	$("#imagenactual").val("");
	$("#imagen").val("");
	$("#telefono").val("");
	$("#correoElectronico").val("");
	$("#puesto").val("");
	$("#estado").val("");
	$("#delegacion").val("");
	$("#colonia").val("");
	$("#calle").val("");
	$("#numExt").val("");
	$("#numInt").val("");
}

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

function cancelarform(){
	limpiar();
	mostrarform(false);
}

function listar(){
	tabla = $('#tbllistado').dataTable({
		"aProcessing" : true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'pdf'
		],
		"ajax": {
			url: '../ajax/empleado.php?op=list',
			type: "get",
			dataType: "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 5,
		"order": [[ 0, "desc"]]
	}).DataTable();
}

function saveEdit(e){
	e.preventDefault();
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/empleado.php?op=saveEdit",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}

	});
	limpiar();
}

function showOne(idEmpleado){
	$.post("../ajax/empleado.php?op=show",{idEmpleado : idEmpleado}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#idEmpleado").val(data.idEmpleado);
		$("#idSucursal").val(data.idSucursal);
		$("#idSucursal").selectpicker('refresh');
		$("#username").val(data.username);
		$("#password").val(data.password);
		$("#nombre").val(data.nombre);
		$("#apellidoPaterno").val(data.apellidoPaterno);
		$("#apellidoMaterno").val(data.apellidoMaterno);
		$("#fechaIngreso").val(data.fechaIngreso);
		$("#telefono").val(data.telefono);
		$("#correoElectronico").val(data.correoElectronico);
		$("#puesto").val(data.puesto);
		$("#estado").val(data.estado);
		$("#delegacion").val(data.delegacion);
		$("#colonia").val(data.colonia);
		$("#calle").val(data.calle);
		$("#numExt").val(data.numExt);
		$("#numInt").val(data.numInt);
		$("#mostrarimagen").show();
		$("#mostrarimagen").attr("src", "../files/empleados/"+data.imagen);
		$("#imagenactual").val(data.imagen);
	});
	$.post("../ajax/empleado.php?op=listPermiso&uid="+idEmpleado, function(r){
		$("#permisos").html(r);
	});
}

function unactivate(idEmpleado){
	bootbox.confirm("¿Desea desactivar el Empleado?", function(result){
		if(result){
			$.post("../ajax/empleado.php?op=unactivate",{idEmpleado : idEmpleado}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idEmpleado){
	bootbox.confirm("¿Desea activar al empleado?", function(result){
		if(result){
			$.post("../ajax/empleado.php?op=activate",{idEmpleado : idEmpleado}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
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

init();