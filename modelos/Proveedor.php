<?php 

require "../config/Conexion.php";

Class Proveedor{

	public function __construct(){

	}

	public function insertar($nombreEmpresa, $correoElectronico, $telefono, $estado, $delegacion, $colonia, $calle, $numExt, $numInt){
		$sql =  "INSERT INTO proveedor (nombreEmpresa, correoElectronico, telefono, estado, delegacion, colonia, calle, numExt, numInt, isActive) VALUES ('$nombreEmpresa', '$correoElectronico', '$telefono', '$estado', '$delegacion', '$colonia', '$calle', '$numExt', '$numInt', '1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idproveedor, $nombreEmpresa, $correoElectronico, $telefono, $estado, $delegacion, $colonia, $calle, $numExt, $numInt){
		$sql = "UPDATE proveedor SET nombreEmpresa='$nombreEmpresa', correoElectronico='$correoElectronico', telefono='$telefono', estado='$estado', delegacion='$delegacion', colonia='$colonia', calle='$calle', numExt='$numExt', numInt='$numInt' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idproveedor){
		$sql = "UPDATE proveedor SET isActive='0' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}

	public function activar($idproveedor){
		$sql = "UPDATE proveedor SET isActive='1' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idproveedor){
		$sql = "SELECT * FROM proveedor WHERE idproveedor='$idproveedor'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM proveedor";
		return ejecutarConsulta($sql);
	}

}
?>