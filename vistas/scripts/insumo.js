var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
}

function limpiar(){
	$("#idinsumo").val("");
	$("#nombre").val("");
	$("#marca").val("");
	$("#existencias").val("");
	$("#piezasContiene").val("");
	$("#precioPromedio").val("");
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
			url: '../ajax/insumo.php?op=list',
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
		url: "../ajax/insumo.php?op=saveEdit",
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

function showOne(idinsumo){
	$.post("../ajax/insumo.php?op=show",{idinsumo : idinsumo}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#nombre").val(data.nombre);
		$("#marca").val(data.marca);
		$("#existencias").val(data.existencias);
		$("#idinsumo").val(data.idinsumo);
		$("#piezasContiene").val(data.piezasContiene);
		$("#precioPromedio").val(data.precioPromedio);
	});

}

function unactivate(idinsumo){
	bootbox.confirm("¿Desea desactivar el insumo?", function(result){
		if(result){
			$.post("../ajax/insumo.php?op=unactivate",{idinsumo : idinsumo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idinsumo){
	bootbox.confirm("¿Desea activar el insumo?", function(result){
		if(result){
			$.post("../ajax/insumo.php?op=activate",{idinsumo : idinsumo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

init();


