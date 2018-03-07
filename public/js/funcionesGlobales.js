"use strict";

var tabla = null;

/*
Esta función auto-ejecutable simula la creación de atributos privados 
a los cuales solo se pueden acceder mediante los métodos get que devuelve la función

Nota:

e => $(e).val()

es lo mismo que

function(e){
	$(e).val()
}
*/
const datos = (function(){
	//Obtener nombre del archivo .php que esta en uso
	const vista = (window.location.href).match(/\w+(?=\.php)/);

	//Nombre de los elementos que se usan en las funciones limpiar y showOne
	const elementos = {
		producto: {
			limpiar: ["#idproducto", "#nombre", "#precioActual"],
			showOne: ["nombre", "precioActual", "idproducto"],
			parametro: "idproducto"
		},
		compra: {
			limpiar: ["#idcompra", "#idproveedor", "#fecha", "#nombre", "#apellidoPaterno", "#apellidoMaterno", "#monto", "#iva"],
			showOne: ["idcompra", "idproveedor", "fecha", "nombre", "apellidoPaterno", "apellidoMaterno", "monto", "iva"],
			parametro: "idcompra"
		},
		proveedor: {
			limpiar: ["#idproveedor", "#nombreEmpresa", "#correoElectronico", "#telefono", "#estado", "#delegacion", "#colonia", "#calle", "#numExt", "#numInt"],
			showOne: ["nombreEmpresa", "correoElectronico", "telefono", "estado", "delegacion", "colonia", "calle", "numExt", "numInt", "idproveedor"],
			parametro: "idproveedor"
		},
		insumo: {
			limpiar: ["#idinsumo", "#nombre", "#marca", "#existencias", "#piezasContiene", "#precioPromedio"],
			showOne: ["nombre", "marca", "existencias", "idinsumo", "piezasContiene", "precioPromedio"],
			parametro: "idinsumo"
		},
		cliente: {
			limpiar: ["#idcliente", "#nombre", "#apellidoPaterno", "#apellidoMaterno", "#fechaNacimiento", "#cuentaFB", "#cuentaInstagram", "#cuentaTwitter", "#correoElectronico", "#telefono"],
			showOne: ["#nombre", "#apellidoPaterno", "#apellidoMaterno", "#fechaNacimiento", "#cuentaFB", "#cuentaInstagram", "#cuentaTwitter", "#correoElectronico", "#telefono", "#idcliente"],
			parametro: "idcliente"
		},
		empleado: {
			limpiar: ["#idEmpleado", "#idSucursal", "#username", "#password", "#nombre", "#apellidoPaterno", "#apellidoMaterno", "#fechaIngreso", "#mostrarimagen", "#imagen", "#telefono", "#correoElectronico", "#puesto", "#estado", "#delegacion", "#colonia", "#calle", "#numExt", "#numInt"],
			showOne: ["idEmpleado", "idSucursal", "username", "password", "nombre", "apellidoPaterno", "apellidoMaterno", "fechaIngreso", "telefono", "correoElectronico", "puesto", "estado", "delegacion", "colonia", "calle", "numExt", "numInt"],
			parametro: "idEmpleado"

		},
		evento: {
			limpiar: ["#idevento", "#nombre", "#tipo", "#plataforma", "#recompensa", "#fechaInicio", "#fechaFin"],
			showOne: ["nombre", "tipo", "plataforma", "recompensa", "fechaInicio", "fechaFin", "idevento"],
			parametro: "idevento"
		},
		evento: {
			limpiar: ["#idFranquicia", "#nombre"],
			showOne: ["idFranquicia", "nombre"],
			parametro: "idFranquicia"
		}
		/*,
		evento: {
			limpiar: [],
			showOne: []
		}*/
	};

	//Funciones de interfaz
	return {
		getElementosHTML(funcion){
			return elementos[vista][funcion];
		},
		getVista(){
			return vista;
		}
	}
})();

mostrarform(false);
listar();
$("#formulario").on("submit", function(e){
	saveEdit(e);
});

//Quita el contenido de cada uno de los input
function limpiar(){
	datos.getElementosHTML("limpiar").forEach(e => $(e).val(""));
	if(datos.getVista() === "empleado"){
		$("#imagenactual").attr("src", "");
	}
}

function cancelarform(){
	limpiar();
	mostrarform(false);
}

//Asigna los valores enviados por las llamadas a AJAX y los pone en cada uno de los input
function showOne(id){
	var nombreParam = datos.getElementosHTML("parametro");
	$.post(
		"../ajax/"+datos.getVista()+".php?op=show",
		{nombreParam: id}, 
		function(data, status){
			data = JSON.parse(data);
			mostrarform(true);
			$("#imagenactual").val(data.imagen);
			datos.getElementosHTML("showOne").forEach(e => $("#"+e).val(data[e]));
	});

	//Caso específico para empleado
	if(datos.getVista() === "empleado"){
		$("#idSucursal").selectpicker('refresh');
		$("#mostrarimagen").show();
		$("#mostrarimagen").attr("src", "../files/empleados/"+data.imagen);

		$.post("../ajax/empleado.php?op=listPermiso&uid="+idEmpleado, function(r){
			$("#permisos").html(r);
		});
	}
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
			url: "../ajax/"+datos.getVista()+".php?op=list",
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
	var nombreParam = datos.getElementosHTML("parametro");
	bootbox.confirm("¿Desea desactivar el "+datos.getVista()+"?", function(result){
		if(result){
			$.post(
				"../ajax/"+datos.getVista()+".php?op=unactivate",
				{nombreParam: id},
				function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
			});
		}
	});
}

function activate(id){
	var nombreParam = datos.getElementosHTML("parametro");
	bootbox.confirm("¿Desea activar el "+datos.getVista()+"?", function(result){
		if(result){
			$.post(
				"../ajax/producto.php?op=activate",
				{nombreParam: id},
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
		url: "../ajax/"+datos.getVista()+".php?op=saveEdit",
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