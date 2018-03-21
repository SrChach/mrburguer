<?php 
/*
	FechaSolicitud	=>	FechaEnvio
*/

require "../config/Conexion.php";

Class transporteInsumo{

	public function __construct(){

	}

	public function solicitar($idInsumoEnSucursal, $idInsumo, $cantidadPedida){
		$sql = "INSERT INTO transporteInsumo (idInsumoEnSucursal, idInsumo, fechaSolicitud, cantidadPedida) VALUES ('$idInsumoEnSucursal', '$idInsumo', current_timestamp, '$cantidadPedida')";
		return ejecutarConsulta($sql);
	}

	public function Enviar($idInsumoEnSucursal, $idInsumo, $cantidadEnviada){
		$sql =  "INSERT INTO transporteInsumo (idInsumoEnSucursal, idInsumo, fechaEnvio, cantidadEnviada) VALUES ('$idInsumoEnSucursal', '$idInsumo', current_timestamp, '$cantidadEnviada')";
		return ejecutarConsulta($sql);
	}

	public function responderSolicitud($idTransporteInsumo, $cantidadEnviada){
		$sql = "UPDATE transporteInsumo SET cantidadEnviada='$cantidadEnviada', fechaEnvio=current_timestamp WHERE idTransporteInsumo='$idTransporteInsumo'";
		return ejecutarConsulta($sql);
	}

	public function confirmarRecibo($idTransporteInsumo, $cantidadRecibida, $observaciones, $idEmpleadoRecibe){
		$sql = "UPDATE transporteInsumo SET cantidadRecibida='$cantidadRecibida', fechaRecepcion=current_timestamp, observaciones='$observaciones', idEmpleadoRecibe='$idEmpleadoRecibe' WHERE idTransporteInsumo='$idTransporteInsumo'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idTransporteInsumo){
		$sql = "SELECT * FROM transporteInsumo WHERE idTransporteInsumo='$idTransporteInsumo'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM transporteInsumo";
		return ejecutarConsulta($sql);
	}

}

?>