"use strict";

var tabla = null;
var vista = (window.location.href).match(/\w+(?=\.php)/)[0];

function iniciar(){
	mostrarform(false);
	listar(arguments[0]);
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
			$("#mostrarimagen").attr("src", "");
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
				$("#mostrarimagen").show();
				$("#mostrarimagen").attr("src", "../files/productos/"+imagen);
			}
			if(vista === "empleado"){
				$("#mostrarimagen").attr("src", "../files/empleados/"+data.imagen);
				showOneEmpleado(id);
			}
			if(vista === "venta"){
				$("#btnAgregarProducto").hide();
			}
			datos.getElementos("showOne").forEach(e => $("#"+e).val(data[e]));
	});

	//Casos particulares
	switch(vista){
		case "sucursal":
			showOneSucursal();
			break;
		case "venta":
			showOneVenta(id);
			break;
	}
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function listar(){
	var url = "";
	switch(vista){
		case "enviar":
			url = "../ajax/transporteInsumo.php?op=listRequests&SUC="+arguments[0];
			break;
		case "recepcion":
			url = "../ajax/transporteInsumo.php?op=listReceived";
			break;
		default:
			url = "../ajax/"+vista+".php?op=list";
			break;
	}
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
			url: url,
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
				"../ajax/"+vista+".php?op=activate",
				paramAJAX,
				function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
			});
		}
	});
}

function saveEdit(e){
	var url = "";
	switch(vista){
		case "enviar":
			url = "../ajax/transporteInsumo.php?op=send";
			break;
		case "recepcion":
			url = "../ajax/transporteInsumo.php?op=receive";
			break;
		default:
			url = "../ajax/"+vista+".php?op=saveEdit";
			break;
	}
	e.preventDefault();
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: url,
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