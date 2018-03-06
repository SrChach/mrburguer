<?php

require "../config/Conexion.php";

Class Interaccion{

	public function __construct(){

	}

	public function insertar($idCliente, $idEvento, $accionRealizada, $fechaHoraInteraccion){
		$sql =  "INSERT INTO Interaccion(idCliente, idEvento, accionRealizada, fechaHoraInteraccion) VALUES ('$idCliente', '$idEvento', '$accionRealizada', '$fechaHoraInteraccion')";
		return ejecutarConsulta($sql);
	}

	public function editar($idinteraccion, $idCliente, $idEvento, $accionRealizada, $fechaHoraInteraccion, $fechaInicio, $fechaFin){
		$sql = "UPDATE interaccion SET idCliente='$idCliente', idCliente='$idCliente', accionRealizada='$accionRealizada', fechaHoraInteraccion='$fechaHoraInteraccion', fechaInicio='$fechaInicio', fechaFin='$fechaFin' WHERE idinteraccion='$idinteraccion'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idinteraccion){
		$sql = "SELECT * FROM interaccion WHERE idinteraccion='$idinteraccion'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM interaccion";
		return ejecutarConsulta($sql);
	}

}

?>