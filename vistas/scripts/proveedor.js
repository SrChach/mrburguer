var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
}

function limpiar(){
	$("#idproveedor").val("");
	$("#nombreEmpresa").val("");
	$("#correoElectronico").val("");
	$("#telefono").val("");
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
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
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
			url: '../ajax/proveedor.php?op=list',
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
	/*Desactiva la acción por defecto del Submit*/
	e.preventDefault();
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/proveedor.php?op=saveEdit",
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

function showOne(idproveedor){
	$.post("../ajax/proveedor.php?op=show",{idproveedor : idproveedor}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#nombreEmpresa").val(data.nombreEmpresa);
		$("#correoElectronico").val(data.correoElectronico);
		$("#telefono").val(data.telefono);
		$("#estado").val(data.estado);
		$("#delegacion").val(data.delegacion);
		$("#colonia").val(data.colonia);
		$("#calle").val(data.calle);
		$("#numExt").val(data.numExt);
		$("#numInt").val(data.numInt);
		$("#idproveedor").val(data.idproveedor);
	});

}

function unactivate(idproveedor){
	bootbox.confirm("¿Desea desactivar el proveedor?", function(result){
		if(result){
			$.post("../ajax/proveedor.php?op=unactivate",{idproveedor : idproveedor}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idproveedor){
	bootbox.confirm("¿Desea activar el proveedor?", function(result){
		if(result){
			$.post("../ajax/proveedor.php?op=activate",{idproveedor : idproveedor}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

init();
