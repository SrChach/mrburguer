var tabla;

function init(){
	var param = getParameterByName('SUC');
	listar(param);

	$.post("../ajax/ies.php?op=gname&SUC="+param, function(r){
		data = JSON.parse(r);
		$("#nombresucursal").html("Peticiones de la sucursal - \""+data.nombre+"\"");
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
			url: '../ajax/transporteInsumo.php?op=listRequests&SUC='+idSucursal,
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
/*
function saveEdit(idInsumo, idSucursal, selector){
	if($('#'+selector.id).val() == ""){
		bootbox.alert("Antes de proceder, llena el campo \"Cantidad inicial\"");
	} else {
		cantidad = $('#'+selector.id).val();
		bootbox.confirm("¿Desea registrar el insumo?", function(result){
			if(result){
				$.post("../ajax/ies.php?op=saveEdit",{idInsumo : idInsumo, idSucursal : idSucursal, cantidad : cantidad}, function(e){
					bootbox.alert(e);
					tabla.ajax.reload();
				});
			}
		});
	}
}
*/
init();