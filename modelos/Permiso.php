<?php 

require "../config/Conexion.php";

Class Permiso{

	public function __construct(){

	}

	public function insertar($nombre){
		$sql =  "INSERT INTO permiso (nombre) VALUES ('$nombre')";
		return ejecutarConsulta($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM permiso";
		return ejecutarConsulta($sql);
	}

}

?>