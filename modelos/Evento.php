<?php

require "../config/Conexion.php";

Class Evento{

	public function __construct(){

	}

	public function insertar($nombre, $tipo, $plataforma, $recompensa, $fechaInicio, $fechaFin){
		$sql =  "INSERT INTO evento(nombre, tipo, plataforma, recompensa, fechaInicio, fechaFin) VALUES ('$nombre', '$tipo', '$plataforma', '$recompensa', '$fechaInicio', '$fechaFin')";
		return ejecutarConsulta($sql);
	}

	public function editar($idevento, $nombre, $tipo, $plataforma, $recompensa, $fechaInicio, $fechaFin){
		$sql = "UPDATE evento SET nombre='$nombre', tipo='$tipo', plataforma='$plataforma', recompensa='$recompensa', fechaInicio='$fechaInicio', fechaFin='$fechaFin' WHERE idevento='$idevento'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idevento){
		$sql = "SELECT * FROM evento WHERE idevento='$idevento'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM evento";
		return ejecutarConsulta($sql);
	}

}

?>