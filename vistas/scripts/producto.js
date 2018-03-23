var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
}

function limpiar(){
	$("#idproducto").val("");
	$("#nombre").val("");
	$("#precioActual").val("");
	$("#mostrarimagen").attr("src", "");
	$("#imagenactual").val("");
	$("#imagen").val("");
}

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Añadir nuevo producto:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Productos manejados");
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
			url: '../ajax/producto.php?op=list',
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
		url: "../ajax/producto.php?op=saveEdit",
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

function showOne(idproducto){
	$.post("../ajax/producto.php?op=show",{idproducto : idproducto}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#nombre").val(data.nombre);
		$("#precioActual").val(data.precioActual);
		$("#idproducto").val(data.idproducto);
		$("#mostrarimagen").show();
		$("#mostrarimagen").attr("src", "../files/productos/"+data.imagen);
		$("#imagenactual").val(data.imagen);
	});

}

function unactivate(idproducto){
	bootbox.confirm("¿Desea desactivar el producto?", function(result){
		if(result){
			$.post("../ajax/producto.php?op=unactivate",{idproducto : idproducto}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idproducto){
	bootbox.confirm("¿Desea activar el producto?", function(result){
		if(result){
			$.post("../ajax/producto.php?op=activate",{idproducto : idproducto}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

init();

