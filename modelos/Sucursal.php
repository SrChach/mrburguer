<?php 

require "../config/Conexion.php";

Class Sucursal{

	public function __construct(){

	}

	public function insertar($nombre, $idFranquicia, $movil, $estado, $delegacion, $colonia, $calle, $numExt, $numInt){
		$sql = "INSERT INTO sucursal (nombre, idFranquicia, movil, estado, delegacion, colonia, calle, numExt, numInt, isActive) VALUES 
		('$nombre', '$idFranquicia', '$movil', '$estado', '$delegacion', '$colonia', '$calle', '$numExt', '$numInt', '1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idsucursal, $nombre, $idFranquicia, $movil, $estado, $delegacion, $colonia, $calle, $numExt, $numInt){
		$sql = "UPDATE sucursal SET nombre='$nombre', idFranquicia='$idFranquicia', movil='$movil', estado='$estado', delegacion='$delegacion', colonia='$colonia', calle='$calle', numExt='$numExt', numInt='$numInt' WHERE idsucursal='$idsucursal'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idsucursal){
		$sql = "UPDATE sucursal SET isActive='0' WHERE idsucursal='$idsucursal'";
		return ejecutarConsulta($sql);
	}

	public function activar($idsucursal){
		$sql = "UPDATE sucursal SET isActive='1' WHERE idsucursal='$idsucursal'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idsucursal){
		$sql = "SELECT * FROM sucursal WHERE idsucursal='$idsucursal'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT sucursal.idsucursal, sucursal.nombre, franquicia.nombre as 'franquicia', sucursal.movil, sucursal.estado, sucursal.delegacion, sucursal.colonia, sucursal.calle, sucursal.numExt, sucursal.numInt, sucursal.isActive FROM sucursal JOIN franquicia ON sucursal.idFranquicia=franquicia.idFranquicia";
		return ejecutarConsulta($sql);
	}

}

?>