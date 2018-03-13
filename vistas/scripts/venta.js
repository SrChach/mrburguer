var tabla;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
	
}

function limpiar(){
	$("#idventa").val("");
	$("#nombreEmpleado").val("");
	$("#nombreCliente").val("");
	$("#fecha").val("");
	$("#montoTotal").val("");
	$("#iva").val("");
	$("#descuentoActual").val("");
	$("#status").val("");
	$("#pagoTarjeta").val("");
}

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
		listarPES();
	} else {
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
			url: '../ajax/venta.php?op=list',
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
		url: "../ajax/venta.php?op=saveEdit",
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

function giveBack(idventa){
	bootbox.confirm("Está seguro de devolver la venta?", function(result){
		if(result){
			$.post("../ajax/venta.php?op=giveBack", {idventa : idventa}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function listarPES(){
	tabla = $('#tblPES').dataTable({
		"aProcessing" : true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [],
		"ajax": {
			url: '../ajax/venta.php?op=listPES',
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

var iva = 16;
var i = 0;
var productos = 0;

$("#guardar").hide();

function agregarProducto(idProductoEnSucursal, producto, idPrecio){
	var cantidad = 1;
	var precioUnitario = $('#'+idPrecio.id).text(); 
	var subtotal = precioUnitario * cantidad;
	if(idProductoEnSucursal != ""){
		var fila='<tr class="filas" id="fila'+i+'">'+
			'<td><button type="button" class="btn btn-danger" onclick="eliminarProducto('+i+')">X</button></td>'+
			'<td><input type="hidden" name="idProductoEnSucursal[]" value="'+idProductoEnSucursal+'">'+producto+'</td>'+
			'<td><input type="number" min="0" name="cantidad[]" onchange="modificarSubtotales()" value="'+cantidad+'"></td>'+
			'<td><input type="hidden" name="pu[]" value="'+precioUnitario+'">'+precioUnitario+'</td>'+
			'<td><span name="subtotal[]" id="subtotal'+i+'">'+subtotal+'</span></td>'+
			'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
		'</tr>';
		i++;
		productos++;
		$("#productos").append(fila);
		modificarSubtotales();
	} else {
		alert("Error al ingresar el producto");
	}
}

/*function agregarProducto(idProductoEnSucursal, nombre, idPrecio){
	var precio = 0;
	precio = $('#'+idPrecio.id).text();
	var p1 = precio * 2;
	alert(nombre + " " +precio+ " " + p1);
}*/

function modificarSubtotales(){
	var cnt = document.getElementsByName("cantidad[]");
	var prc = document.getElementsByName("pu[]");
	var stt = document.getElementsByName("subtotal[]");
	var acum = 0;

	for(var j = 0; j<cnt.length; j++){
		var C = cnt[j];
		var P = prc[j];
		var S = stt[j];
		S.text = C.value * P.value;
		$('#'+S.id).text(S.text);
		//alert('subtotal'+S.id);
		acum+=S.text;
	}
	$("#total").text("$ "+acum);
	evaluar();
}

function evaluar(){
	if(productos>0){
		$("#guardar").show();
	} else {
		$("#guardar").hide();
		i=0;
	}
}

function eliminarProducto(idFila){
	$("#fila"+idFila).remove();
	productos--;
	modificarSubtotales();
}

init();
