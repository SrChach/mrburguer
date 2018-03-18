const datos = (function(){
	const elementos = {
		limpiar: ["#idCliente","#pagoTarjeta"],
		showOne: ["idCliente", "pagoTarjeta"],
		parametro: "idventa"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

iniciar();

var i = 0;
var productos = 0;

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


function giveBack(idventa){
	bootbox.confirm("Está seguro de devolver la venta?", function(result){
		if(result){
			$.post("../ajax/venta.php?op=giveBack", {idventa: idventa}, function(e){
				bootbox.alert(e);
				listar();
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

function showOneVenta(idventa) {
	$("#pagoTarjeta").selectpicker('refresh');
	$("#btnGuardar").hide();
	$("#btnAgregarProducto").hide();

	$.post("../ajax/venta.php?op=listElement&vt="+idventa, function(r){
		$("#productos").html(r);
	});
}