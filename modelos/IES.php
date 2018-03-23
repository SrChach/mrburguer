<?php 

require "../config/Conexion.php";

Class IES{

	public function __construct(){

	}

	public function insertar($idInsumo, $idSucursal, $cantidad){
		$sql =  "INSERT INTO insumoEnSucursal (idInsumo, idSucursal, cantidad, isActive) VALUES ('$idInsumo','$idSucursal', '$cantidad','1')";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idInsumoEnSucursal){
		$sql = "UPDATE insumoEnSucursal SET isActive='0' WHERE idInsumoEnSucursal='$idInsumoEnSucursal'";
		return ejecutarConsulta($sql);
	}

	public function activar($idInsumoEnSucursal){
		$sql = "UPDATE insumoEnSucursal SET isActive='1' WHERE idInsumoEnSucursal='$idInsumoEnSucursal'";
		return ejecutarConsulta($sql);
	}

	public function listar($idSucursal){
		$sql = "SELECT insumo.nombre, insumo.precioPromedio, IES.cantidad, IES.isActive, '$idSucursal' as idSucursal, insumo.idInsumo, IES.idInsumoEnSucursal FROM insumo left join (SELECT * from insumoEnSucursal where idSucursal='$idSucursal') IES on insumo.idInsumo=IES.idInsumo";
			return ejecutarConsulta($sql);
	}

	public function check($idSucursal){
		$sql = "SELECT COUNT(idSucursal) as exist FROM sucursal WHERE idsucursal='$idSucursal'";
		return ejecutarConsulta($sql);
	}

	public function gname($idSucursal){
		$sql = "SELECT nombre FROM sucursal WHERE idSucursal='$idSucursal'";
		return consultarFila($sql);
	}
}

?>