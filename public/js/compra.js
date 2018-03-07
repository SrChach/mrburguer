$.post("../ajax/compra.php?op=selectProveedor", function(r){
	$("#idProveedor").html(r);
	$("#idProveedor").selectpicker('refresh');
});

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}