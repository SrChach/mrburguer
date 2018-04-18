var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e){
		saveEdit(e);	
	});

}

function limpiar(){
	$(".filas").remove();
}

function mostrarform(flag){
	limpiar();
	if (flag){
		$("#cabecera").html("Nueva Peticion");
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnAgregar").hide();
		listarInsumos();
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		insumos=0;
		$("#btnAgregarInsumo").show();
	} else {
		$("#cabecera").html("Peticiones realizadas(Envío pendiente)");
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnAgregar").show();
	}
}

function cancelarform(){
	limpiar();
	mostrarform(false);
}

function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'pdf'
		],
		"ajax": {
			url: '../ajax/transporteInsumo.php?op=myPetitions',
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);	
			}
		},
		"bDestroy": true,
		"iDisplayLength": 15,
		"order": [[ 0, "desc" ]]
	}).DataTable();
}

function listarInsumos(){
	tabla=$('#tblInsumos').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [],
		"ajax":{
			url: '../ajax/transporteInsumo.php?op=listOptions',
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy": true,
		"iDisplayLength": 5,
		"order": [[ 0, "desc" ]]
	}).DataTable();
}

function saveEdit(e){
	e.preventDefault();
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/transporteInsumo.php?op=request",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,
		success: function(datos){
			bootbox.alert(datos);
			mostrarform(false);
			listar();
		}
	});

	limpiar();
}

var i=0;
var insumos=0;
$("#btnGuardar").hide();

function agregarInsumo(idIES, nombre){
	var cantidadPedida=1;
	if (idIES!=""){
		var subtotal=cantidadPedida;
		var fila='<tr class="filas" id="fila'+i+'">'+
		'<td><button type="button" class="btn btn-danger" onclick="eliminarInsumo('+i+')">X</button></td>'+
		'<td><input type="hidden" name="idIES[]" value="'+idIES+'">'+nombre+'</td>'+
		'<td><input type="number" name="cantidadPedida[]" id="cantidadPedida[]" value="'+cantidadPedida+'" required></td>'+
		'</tr>';
		i++;
		insumos=insumos+1;
		$('#insumos').append(fila);
		evaluar();
	} else {
		alert("Error al ingresar el ingreso");
	}
}

function evaluar(){
	if (insumos>0){
		$("#btnGuardar").show();
	} else {
		$("#btnGuardar").hide(); 
		i=0;
	}
}

function eliminarInsumo(indice){
	$("#fila" + indice).remove();
	insumos=insumos-1;
	evaluar();
}

init();