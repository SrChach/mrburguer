<?php 

require "../config/Conexion.php";

Class PES{

	public function __construct(){

	}

	public function insertar($idProducto, $idSucursal){
		$sql =  "INSERT INTO productoEnSucursal (idProducto, idSucursal, isActive) VALUES ('$idProducto','$idSucursal','1')";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idProducto, $idSucursal){
		$sql = "UPDATE productoEnSucursal SET isActive='0' WHERE (idProducto='$idProducto') and (idSucursal='$idSucursal')";
		return ejecutarConsulta($sql);
	}

	public function activar($idProducto, $idSucursal){
		$sql = "UPDATE productoEnSucursal SET isActive='1' WHERE (idProducto='$idProducto') and (idSucursal='$idSucursal')";
		return ejecutarConsulta($sql);
	}

	/*idProductoEnSucursal es el que dice si es o no nulo*/
	public function listar($idSucursal){
		$sql = "SELECT PROD.nombre, PROD.precioActual, PES.idProducto as idProductoEnSucursal, PROD.imagen, PES.isActive, '$idSucursal' as idSucursal, PROD.idProducto FROM producto PROD left join (SELECT * from productoEnSucursal where idSucursal='$idSucursal') PES on PROD.idProducto=PES.idProducto where PROD.isActive=1";
		return ejecutarConsulta($sql);
	}

	public function check($idSucursal){
		$sql = "SELECT COUNT(idsucursal) as exist FROM sucursal WHERE idsucursal='$idSucursal'";
		return ejecutarConsulta($sql);
	}

	public function gname($idSucursal){
		$sql = "SELECT nombre as nom FROM sucursal WHERE idSucursal='$idSucursal'";
		return consultarFila($sql);
	}

	public function listarPES($idSucursal){
		$sql = "SELECT PROD.nombre, PROD.precioActual, PROD.imagen, '$idSucursal' as idSucursal, PES.idProducto FROM producto PROD join (SELECT * from productoEnSucursal where idSucursal='$idSucursal') PES on PROD.idProducto=PES.idProducto where (PROD.isActive=1) and (PES.isActive=1)";
		return ejecutarConsulta($sql);
	}


}

?>