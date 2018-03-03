<?php 

require "../config/Conexion.php";

Class IES{

	public function __construct(){

	}

	public function insertar($idInsumo, $idSucursal){
		$sql =  "INSERT INTO insumoEnSucursal (idInsumo, idSucursal, cantidad, isActive) VALUES ('$idInsumo','$idSucursal', '0','1')";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idinsumoEnSucursal){
		$sql = "UPDATE insumoEnSucursal SET isActive='0' WHERE idinsumoEnSucursal='$idinsumoEnSucursal'";
		return ejecutarConsulta($sql);
	}

	public function activar($idinsumoEnSucursal){
		$sql = "UPDATE insumoEnSucursal SET isActive='1' WHERE idinsumoEnSucursal='$idinsumoEnSucursal'";
		return ejecutarConsulta($sql);
	}

	public function listar($idSucursal){
		$sql = "SELECT insumo.nombre, insumo.marca, insumo.precioPromedio, IES.cantidad, IES.isActive, '$idSucursal' as idSucursal, IES.idInsumo, IES.idinsumoEnSucursal FROM insumo left join (SELECT * from insumoEnSucursal where idSucursal='$idSucursal') IES on insumo.idInsumo=IES.idInsumo where IES.isActive=1";
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