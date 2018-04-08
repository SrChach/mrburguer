var tabla;

function init(){
	listar();
}

function listar(){
	tabla = $('#tbllistado').dataTable({
		"aProcessing" : true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [],
		"ajax": {
			url: '../ajax/sucursal.php?op=listActives',
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

init();


