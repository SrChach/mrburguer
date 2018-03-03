var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});

	$.post("../ajax/ies.php?op=selectInsumo", function(r){
		$("#idInsumo").html(r);
		$("#idInsumo").selectpicker('refresh');
	});
}

function limpiar(){
	$("#idinsumoEnSucural").val("");
	$("#idInsumo").val("");
	$("#idsucursal").val("");
	$("#cantidad").val("");
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
			url: '../ajax/ies.php?op=list',
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
		url: "../ajax/ies.php?op=saveEdit",
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

function showOne(idinsumoEnSucural){
	$.post("../ajax/ies.php?op=show",{idinsumoEnSucural : idinsumoEnSucural}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#idinsumoEnSucural").val(data.idinsumoEnSucural);
		$("#idInsumo").val(data.idInsumo);
		$("#idsucursal").val(data.idsucursal);
		$("#cantidad").val(data.cantidad);
	});

}

function unactivate(idinsumoEnSucural){
	bootbox.confirm("¿Desea desactivar el insumo?", function(result){
		if(result){
			$.post("../ajax/insumo.php?op=unactivate",{idinsumoEnSucural : idinsumoEnSucural}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idinsumoEnSucural){
	bootbox.confirm("¿Desea activar el insumo?", function(result){
		if(result){
			$.post("../ajax/ies.php?op=activate",{idinsumoEnSucural : idinsumoEnSucural}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

init();