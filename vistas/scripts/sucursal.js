var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
}

function limpiar(){
	$("#idsucursal").val("");
	$("#nombre").val("");
	$("#franquicia").val("");
	$("#movil").val("");
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
			url: '../ajax/sucursal.php?op=list',
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
		url: "../ajax/sucursal.php?op=saveEdit",
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

function showOne(idsucursal){
	$.post("../ajax/sucursal.php?op=show",{idsucursal : idsucursal}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#idsucursal").val(data.idsucursal);
		$("#nombre").val(data.nombre);
		$("#franquicia").val(data.franquicia);
		$("#movil").val(data.movil);/*Cambiar por checked...*/
		$("#estado").val(data.estado);
		$("#delegacion").val(data.delegacion);
		$("#colonia").val(data.colonia);
		$("#calle").val(data.calle);
		$("#numExt").val(data.numExt);
		$("#numInt").val(data.numInt);
	});

}

function unactivate(idsucursal){
	bootbox.confirm("¿Desea desactivar la sucursal?", function(result){
		if(result){
			$.post("../ajax/sucursal.php?op=unactivate",{idsucursal : idsucursal}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idsucursal){
	bootbox.confirm("¿Desea activar la sucursal?", function(result){
		if(result){
			$.post("../ajax/sucursal.php?op=activate",{idsucursal : idsucursal}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

init();