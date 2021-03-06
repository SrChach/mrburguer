var tabla;

function init(){
	var param = getParameterByName('SUC');
	listar(param);

	$.post("../ajax/pes.php?op=gname&SUC="+param, function(r){
		data = JSON.parse(r);
		$("#nombresucursal").html(data.nom);
	});
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
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

function unactivate(idProducto, idSucursal){
	bootbox.confirm("¿Retirar producto del menú?", function(result){
		if(result){
			$.post("../ajax/pes.php?op=unactivate",{idProducto : idProducto, idSucursal : idSucursal}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	});
}

function activate(idProducto, idSucursal){
	bootbox.confirm("¿Añadir producto al menú?", function(result){
		if(result){
			$.post("../ajax/pes.php?op=activate",{idProducto : idProducto, idSucursal : idSucursal}, function(e){
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


