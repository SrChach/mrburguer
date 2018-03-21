<?php 

require "../config/Conexion.php";

Class Insumo {

	public function __construct(){

	}

	public function insertar($nombre, $existencias, $precioPromedio){
		$sql =  "INSERT INTO insumo (nombre, existencias, precioPromedio, isActive) VALUES ('$nombre', '$existencias', '$precioPromedio', '1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idinsumo, $nombre, $existencias, $precioPromedio){
		$sql = "UPDATE insumo SET nombre='$nombre', existencias='$existencias', precioPromedio='$precioPromedio' WHERE idinsumo='$idinsumo'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idinsumo){
		$sql = "UPDATE insumo SET isActive='0' WHERE idinsumo='$idinsumo'";
		return ejecutarConsulta($sql);
	}

	public function activar($idinsumo){
		$sql = "UPDATE insumo SET isActive='1' WHERE idinsumo='$idinsumo'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idinsumo){
		$sql = "SELECT * FROM insumo WHERE idinsumo='$idinsumo'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM insumo";
		return ejecutarConsulta($sql);
	}
}
?>