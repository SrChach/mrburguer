<?php 

require "../config/Conexion.php";

Class Sucursal{

	public function __construct(){

	}

	public function insertar($idFranquicia, $nombre, $isMobile, $telefono){
		$sql = "INSERT INTO sucursal (idFranquicia, idUbicacion, nombre, isMobile, telefono, isActive) VALUES 
		('$idFranquicia', null, '$nombre', '$isMobile', '$telefono', '1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idsucursal, $idFranquicia, $nombre, $isMobile, $telefono){
		$sql = "UPDATE sucursal SET idFranquicia='$idFranquicia', nombre='$nombre', isMobile='$isMobile', telefono='$telefono' WHERE idsucursal='$idsucursal'";
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
		$sql = "SELECT idsucursal, idFranquicia, nombre, isMobile, telefono FROM sucursal WHERE idsucursal='$idsucursal'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT sucursal.idsucursal, sucursal.nombre, franquicia.nombre as 'franquicia', sucursal.isMobile, sucursal.telefono, sucursal.isActive FROM sucursal JOIN franquicia ON sucursal.idFranquicia=franquicia.idFranquicia";
		return ejecutarConsulta($sql);
	}
	
	public function listarActivas(){
		$sql = "SELECT sucursal.idsucursal, sucursal.nombre, franquicia.nombre as 'franquicia' FROM sucursal JOIN franquicia ON sucursal.idFranquicia=franquicia.idFranquicia WHERE sucursal.isActive='1'";
		return ejecutarConsulta($sql);
	}

	public function select(){
		$sql = "SELECT sucursal.idSucursal, sucursal.nombre, franquicia.nombre as franquicia FROM sucursal join franquicia on sucursal.idFranquicia=franquicia.idFranquicia WHERE (franquicia.isActive=1)";
		return ejecutarConsulta($sql);
	}

}

?>