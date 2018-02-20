<?php 

require "../config/Conexion.php";

Class Cliente{

	public function __construct(){

	}

	public function insertar($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $cuentaFB, $cuentaInstagram, $cuentaTwitter, $correoElectronico, $telefono){
		$sql =  "INSERT INTO cliente (nombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, fechaRegistro, nivel, cuentaFB, cuentaInstagram, cuentaTwitter, correoElectronico, telefono, isActive) VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$fechaNacimiento', current_date, '1', '$cuentaFB', '$cuentaInstagram', '$cuentaTwitter', '$correoElectronico', '$telefono', '1')";
		return ejecutarConsulta($sql);
	}

	public function editar($idcliente, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $cuentaFB, $cuentaInstagram, $cuentaTwitter, $correoElectronico, $telefono){
		$sql = "UPDATE cliente SET nombre='$nombre', $apellidoPaterno='$apellidoPaterno' apellidoMaterno='$apellidoMaterno', fechaNacimiento='$fechaNacimiento', cuentaFB='$cuentaFB', cuentaInstagram='$cuentaInstagram', cuentaTwitter='$cuentaTwitter', correoElectronico='$correoElectronico', telefono='$telefono' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	public function desactivar($idcliente){
		$sql = "UPDATE cliente SET isActive='0' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	public function activar($idcliente){
		$sql = "UPDATE cliente SET isActive='1' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idcliente){
		$sql = "SELECT * FROM cliente WHERE idcliente='$idcliente'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM cliente";
		return ejecutarConsulta($sql);
	}

}

?>