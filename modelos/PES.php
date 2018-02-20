<?php 

require "../config/Conexion.php";

Class PES{

	public function __construct(){

	}

	public function insertar($idProducto, $idSucursal){
		$sql =  "INSERT INTO productoEnSucursal (idProducto, idSucursal, isActive) VALUES ('$idProducto','$idSucursal','1')";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idproductoEnSucursal){
		$sql = "UPDATE productoEnSucursal SET isActive='0' WHERE idproductoEnSucursal='$idproductoEnSucursal'";
		return ejecutarConsulta($sql);
	}

	public function activar($idproductoEnSucursal){
		$sql = "UPDATE productoEnSucursal SET isActive='1' WHERE idproductoEnSucursal='$idproductoEnSucursal'";
		return ejecutarConsulta($sql);
	}

	public function listar($idSucursal){
		$sql = "SELECT PROD.nombre, PROD.precioActual, PES.idproductoEnSucursal, PES.isActive, '$idSucursal' as idSucursal, PROD.idProducto FROM producto PROD left join (SELECT * from productoEnSucursal where idSucursal='$idSucursal') PES on PROD.idProducto=PES.idProducto where PROD.isActive=1";
		return ejecutarConsulta($sql);
		/*
			resultado:
				nombre
				precioActual
				idproductoEnSucursal->posible nulo
				isActive
				idSucursal
				idProducto
		*/
	}

	public function check($idSucursal){
		$sql = "SELECT COUNT(idSucursal) as exist FROM sucursal WHERE idsucursal='$idSucursal'";
		return ejecutarConsulta($sql);
	}

	public function gname($idSucursal){
		$sql = "SELECT nombre as nom FROM sucursal WHERE idSucursal='$idSucursal'";
		return ejecutarConsulta($sql);
	}


}

?>