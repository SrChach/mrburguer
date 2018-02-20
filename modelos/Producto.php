<?php 

require "../config/Conexion.php";

Class Producto{

	public function __construct(){

	}

	public function insertar($nombre, $precioActual){
		$sql =  "INSERT INTO producto (nombre, precioActual, isActive) VALUES ('$nombre','$precioActual','1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idproducto, $nombre, $precioActual){
		$sql = "UPDATE producto SET nombre='$nombre', precioActual='$precioActual' WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idproducto){
		$sql = "UPDATE producto SET isActive='0' WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	public function activar($idproducto){
		$sql = "UPDATE producto SET isActive='1' WHERE idproducto='$idproducto'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idproducto){
		$sql = "SELECT * FROM producto WHERE idproducto='$idproducto'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM producto";
		return ejecutarConsulta($sql);
	}

}

?>