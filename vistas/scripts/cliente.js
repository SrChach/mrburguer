var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
}

function limpiar(){
	$("#idcliente").val("");
	$("#nombre").val("");
	$("#apellidoPaterno").val("");
	$("#apellidoMaterno").val("");
	$("#fechaNacimiento").val("");
	$("#cuentaFB").val("");
	$("#cuentaInstagram").val("");
	$("#cuentaTwitter").val("");
	$("#correoElectronico").val("");
	$("#telefono").val("");
	/*Estas sentencias no borran el elemento, VACIAN EL CONTENIDO*/
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
			url: '../ajax/cliente.php?op=list',
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
		url: "../ajax/cliente.php?op=saveEdit",
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

function showOne(idcliente){
	$.post("../ajax/cliente.php?op=show",{idcliente : idcliente}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);
		$("#nombre").val(data.nombre);
		$("#apellidoPaterno").val(data.apellidoPaterno);
		$("#apellidoMaterno").val(data.apellidoMaterno);
		$("#fechaNacimiento").val(data.fechaNacimiento);
		$("#cuentaFB").val(data.cuentaFB);
		$("#cuentaInstagram").val(data.cuentaInstagram);
		$("#cuentaTwitter").val(data.cuentaTwitter);
		$("#correoElectronico").val(data.correoElectronico);
		$("#telefono").val(data.telefono);
		$("#idcliente").val(data.idcliente);
	});

}

function unactivate(idcliente){
	bootbox.confirm("¿Desea desactivar el cliente?", function(result){
		if(result){
			$.post("../ajax/cliente.php?op=unactivate",{idcliente : idcliente}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idcliente){
	bootbox.confirm("¿Desea activar el cliente?", function(result){
		if(result){
			$.post("../ajax/cliente.php?op=activate",{idcliente : idcliente}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

init();
