var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});

	$.post("../ajax/compra.php?op=selectProveedor", function(r){
		$("#idProveedor").html(r);
		$("#idProveedor").selectpicker('refresh');
	});
}

function limpiar(){
	$("#idcompra").val("");
	$("#idproveedor").val("");
	$("#fecha").val("");
	$("#nombre").val("");
	$("#apellidoPaterno").val("");
	$("#apellidoMaterno").val("");
	$("#monto").val("");
	$("#iva").val("");
}

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
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
			url: '../ajax/compra.php?op=list',
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



function showOne(idcompra){
	$.post("../ajax/compra.php?op=show",{idcompra : idcompra}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#idcompra").val(data.idcompra);
		$("#idproveedor").val(data.idproveedor);
		$("#fecha").val(data.fecha);
		$("#nombre").val(data.nombre);
		$("#apellidoPaterno").val(data.apellidoPaterno);
		$("#apellidoMaterno").val(data.apellidoMaterno);
		$("#monto").val(data.monto);
		$("#iva").val(data.iva);
	});

}

init();