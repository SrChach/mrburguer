var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
}

function limpiar(){
	$("#idevento").val("");
	$("#nombre").val("");
	$("#tipo").val("");
	$("#plataforma").val("");
	$("#recompensa").val("");
	$("#fechaInicio").val("");
	$("#fechaFin").val("");
}

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Nuevo Evento!:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Eventos");
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
			url: '../ajax/evento.php?op=list',
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
		url: "../ajax/evento.php?op=saveEdit",
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

function showOne(idevento){
	$.post("../ajax/evento.php?op=show",{idevento : idevento}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#nombre").val(data.nombre);
		$("#tipo").val(data.tipo);
		$("#plataforma").val(data.plataforma);
		$("#recompensa").val(data.recompensa);
		$("#fechaInicio").val(data.fechaInicio);
		$("#fechaFin").val(data.fechaFin);
		$("#idevento").val(data.idevento);
	});

}


init();
