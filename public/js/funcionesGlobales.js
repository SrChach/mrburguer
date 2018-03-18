"use strict";

var tabla = null;

/*
e => $(e).val()

es lo mismo que 

function(e){
	$(e).val()
}
*/

const vista = (window.location.href).match(/\w+(?=\.php)/);

function iniciar(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
}

//Quita el contenido de cada uno de los input
function limpiar(){
	datos.getElementos("limpiar").forEach(e => $(e).val(""));

	switch(vista){
		case "empleado":
			$("#imagenactual").attr("src", "");
			break;
		case "producto":
			$("#mostrarimagen").attr("src", "");
			break;
		case "limpiar":
			$("#pagoTarjeta").selectpicker('refresh');
			$("#total").text("$ 0.00");
			$(".filas").remove();
			i=0;
			productos=0;
			break;
	}
}

function cancelarform(){
	limpiar();
	mostrarform(false);
}

//Asigna los valores enviados por las llamadas a AJAX y los pone en cada uno de los input
function showOne(id){
	var paramAJAX = {};
	paramAJAX[datos.getElementos("parametro")] = id;
	$.post(
		"../ajax/"+vista+".php?op=show",
		paramAJAX,
		function(data, status){
			data = JSON.parse(data);
			mostrarform(true);
			$("#imagenactual").val(data.imagen);
			if(vista === "producto"){
				showOneProducto(data.imagen);
			}
			datos.getElementos("showOne").forEach(e => $("#"+e).val(data[e]));
	});

	//Casos particulares
	switch(vista){
		case "empleado":
			showOneEmpleado();
			break;
		case "sucursal":
			showOneSucursal();
			break;
		case "venta":
			showOneVenta(id);
			break;
	}
}

function listar(){
	tabla = $("#tbllistado").dataTable({
		"aProcessing" : true,
		"aServerSide": true,
		dom: "Bfrtip",
		buttons: [
			"copyHtml5",
			"excelHtml5",
			"pdf"
		],
		"ajax": {
			url: "../ajax/"+vista+".php?op=list",
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

function unactivate(id){
	var paramAJAX = {};
	paramAJAX[datos.getElementos("parametro")] = id;
	bootbox.confirm("¿Desea desactivar el "+vista+"?", function(result){
		if(result){
			$.post(
				"../ajax/"+vista+".php?op=unactivate",
				paramAJAX,
				function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
			});
		}
	});
}

function activate(id){
	var paramAJAX = {};
	paramAJAX[datos.getElementos("parametro")] = id;
	bootbox.confirm("¿Desea activar el "+vista+"?", function(result){
		if(result){
			$.post(
				"../ajax/producto.php?op=activate",
				paramAJAX,
				function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
			});
		}
	});
}

function saveEdit(e){
	e.preventDefault();
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/"+vista+".php?op=saveEdit",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){
			bootbox.alert(datos);
			mostrarform(false);
			if(vista === "venta"){
				return listar();
			}
			tabla.ajax.reload();
		}

	});
	limpiar();
}