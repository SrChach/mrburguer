const datos = (function(){
	const elementos = {
		limpiar: ["#idproveedor", "#nombreEmpresa", "#correoElectronico", "#telefono", "#estado", "#delegacion", "#colonia", "#calle", "#numExt", "#numInt"],
		showOne: ["nombreEmpresa", "correoElectronico", "telefono", "estado", "delegacion", "colonia", "calle", "numExt", "numInt", "idproveedor"],
		parametro: "idproveedor"
	}

	return {
		getElementos(funcion){
			return elementos[funcion];
		}	
	}
})();

iniciar();

function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		$("#titulo").html("Registrar nuevo Proveedor:");
	} else {
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
		$("#titulo").html("Proveedores");
	}
}