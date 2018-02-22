<?php 

require "../config/Conexion.php";

Class Empleado{

	public function __construct(){

	}

	public function insertar($idSucursal, $username, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaIngreso, $telefono, $correoElectronico, $puesto, $estado, $delegacion, $colonia, $calle, $numExt, $numInt){
		$sql =  "INSERT INTO empleado (idSucursal, username, password, nombre, apellidoPaterno, apellidoMaterno, fechaIngreso, telefono, correoElectronico, puesto, estado, delegacion, colonia, calle, numExt, numInt, isActive) VALUES ('$idSucursal', '$username', '$password', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$fechaIngreso', '$telefono', '$correoElectronico', '$puesto', '$estado', '$delegacion', '$colonia', '$calle', '$numExt', '$numInt','1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idEmpleado, $idSucursal, $username, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaIngreso, $telefono, $correoElectronico, $puesto, $estado, $delegacion, $colonia, $calle, $numExt, $numInt){
		$sql = "UPDATE empleado SET idSucursal='$idSucursal', username='$username', password='$password', nombre='$nombre', apellidoPaterno='$apellidoPaterno', apellidoMaterno='$apellidoMaterno', fechaIngreso='$fechaIngreso', telefono='$telefono', correoElectronico='$correoElectronico', puesto='$puesto', estado='$estado', delegacion='$delegacion', colonia='$colonia', calle='$calle', numExt='$numExt', numInt='$numInt' WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idEmpleado){
		$sql = "UPDATE empleado SET isActive='0' WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsulta($sql);
	}

	public function activar($idEmpleado){
		$sql = "UPDATE empleado SET isActive='1' WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsulta($sql);
	}

	public function eliminar($idEmpleado){
		$sql = "DELETE FROM persona WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idEmpleado){
		$sql = "SELECT * FROM empleado WHERE idEmpleado='$idEmpleado'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT MP.idEmpleado, SUC.nombre as sucursal, MP.username, MP.password, MP.nombre, MP.apellidoPaterno, MP.apellidoMaterno, MP.fechaIngreso, MP.telefono, MP.correoElectronico, MP.puesto, MP.estado, MP.delegacion, MP.colonia, MP.calle, MP.numExt, MP.numInt, MP.isActive FROM empleado MP join sucursal SUC on MP.idSucursal=SUC.idSucursal";
		return ejecutarConsulta($sql);
	}

}

?>