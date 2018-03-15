var tabla;
var i = 0;
var productos = 0;

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit", function(e){
		saveEdit(e);
	});
	
}

function limpiar(){
	$("#idCliente").val("");
	$("#pagoTarjeta").val("");
	$("#pagoTarjeta").selectpicker('refresh');
	$("#total").text("$ 0.00");
	$(".filas").remove();
	i=0;
	productos=0;
}

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").hide();
		$("#btnAgregar").hide();
		$("#btnAgregarProducto").show();
		$("#cabecera").text("Efectuar venta:");
		listarPES();
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnAgregar").show();
		$("#cabecera").text("Ventas realizadas");
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
				listar();
			});
		}
	});
}

function showOne(idventa){
	$.post("../ajax/venta.php?op=show",{idventa : idventa}, function(data, status){
		if(data==null){
			bootbox.alert("Falló la petición");
		} else {	
			data = JSON.parse(data);
			mostrarform(true);
			$("#idCliente").val(data.idCliente);
			$("#pagoTarjeta").val(data.pagoTarjeta);
			$("#pagoTarjeta").selectpicker('refresh');
			$("#btnGuardar").hide();
			$("#btnAgregarProducto").hide();
		}
	});

	$.post("../ajax/venta.php?op=listElement&vt="+idventa, function(r){
		//$("#productos").html(r);
		document.getElementById("productos").innerHTML = r;
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
		acum+=S.text;
	}
	$("#total").text("$ "+acum);
	evaluar();
}

function evaluar(){
	if(productos>0){
		$("#btnGuardar").show();
	} else {
		$("#btnGuardar").hide();
		i=0;
	}
}

function eliminarProducto(idFila){
	$("#fila"+idFila).remove();
	productos--;
	modificarSubtotales();
}

init();
