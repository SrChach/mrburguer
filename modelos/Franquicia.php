<?php

require "../config/Conexion.php";

Class Franquicia{

	public function __construct(){

	}

	public function insertar($nombre){
		$sql = "INSERT INTO franquicia (nombre, isActive) VALUES ('$nombre', '1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idFranquicia, $nombre){
		$sql = "UPDATE franquicia SET nombre='$nombre' where idFranquicia='$idFranquicia'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idFranquicia){
		$sql = "UPDATE franquicia SET isActive='0' WHERE idFranquicia='$idFranquicia'";
		return ejecutarConsulta($sql);
	}

	public function activar($idFranquicia){
		$sql = "UPDATE franquicia SET isActive='1' WHERE idFranquicia='$idFranquicia'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idFranquicia){
		$sql = "SELECT idFranquicia, nombre FROM franquicia WHERE idFranquicia='$idFranquicia'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM franquicia";
		return ejecutarConsulta($sql);
	}

}

?>