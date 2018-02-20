var tabla;

function init(){
	var param = getParameterByName('SUC');
	listar(param);
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function nomCabecera(idSucursal){
	/*$.post("../ajax/sucursal.php?op=gname",{idSucursal : idSucursal}, function(data, status){
		alert(data);
		//$("#box-title").val(data.nombre);
	});*/
	$("#box-title").val(idSucursal);
}

function listar(idSucursal){
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
			url: '../ajax/pes.php?op=list&SUC='+idSucursal,
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

function unactivate(idproductoEnSucursal){
	bootbox.confirm("¿Retirar producto del menú?", function(result){
		if(result){
			$.post("../ajax/pes.php?op=unactivate",{idproductoEnSucursal : idproductoEnSucursal}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idproductoEnSucursal){
	bootbox.confirm("¿Añadir producto al menú?", function(result){
		if(result){
			$.post("../ajax/pes.php?op=activate",{idproductoEnSucursal : idproductoEnSucursal}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function saveEdit(idProducto, idSucursal){
	bootbox.confirm("¿Desea activar el producto?", function(result){
		if(result){
			$.post("../ajax/pes.php?op=saveEdit",{idProducto : idProducto, idSucursal : idSucursal}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

init();


