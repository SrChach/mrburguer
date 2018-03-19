<?php 

require "../config/Conexion.php";

Class Empleado{

	public function __construct(){

	}

	public function insertar($idSucursal, $userName, $password, $nomPila, $apPaterno, $apMaterno, $fechaIngreso, $imagen, $permisos){
		$sql =  "INSERT INTO empleado (idSucursal, userName, password, nomPila, apPaterno, apMaterno, fechaIngreso, imagen, isActive) VALUES ('$idSucursal', '$userName', '$password', '$nomPila', '$apPaterno', '$apMaterno', '$fechaIngreso', '$imagen', '1')";
		
		$idNuevoEmpleado = ejecutarConsultaRetornarID($sql);
		$numPermisos = 0;
		$sinErrores = true;

		while($numPermisos < count($permisos)){
			$subconsulta = "INSERT INTO empleadoPermiso (idEmpleado, idPermiso) VALUES ('$idNuevoEmpleado', '$permisos[$numPermisos]')";
			ejecutarConsulta($subconsulta) or ($sinErrores = false);
			$numPermisos++;
		}

		return $sinErrores;

	}

	public function editar($idEmpleado, $idSucursal, $userName, $password, $nomPila, $apPaterno, $apMaterno, $fechaIngreso, $imagen, $permisos){
		$sql = "UPDATE empleado SET idSucursal='$idSucursal', userName='$userName', password='$password', nomPila='$nomPila', apPaterno='$apPaterno', apMaterno='$apMaterno', fechaIngreso='$fechaIngreso', imagen='$imagen' WHERE idEmpleado='$idEmpleado'";
		ejecutarConsulta($sql);
		
		//Eliminamos todos los permisos para volverlos a registrar
		$sqldel = "DELETE FROM empleadoPermiso WHERE idEmpleado='$idEmpleado'";
		ejecutarConsulta($sqldel);

		$numPermisos = 0;
		$sinErrores = true;

		while($numPermisos < count($permisos)){
			$subconsulta = "INSERT INTO empleadoPermiso (idEmpleado, idPermiso) VALUES ('$idEmpleado', '$permisos[$numPermisos]')";
			ejecutarConsulta($subconsulta) or ($sinErrores = false);
			$numPermisos++;
		}

		return $sinErrores;

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
		$sql = "DELETE FROM empleado WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idEmpleado){
		$sql = "SELECT * FROM empleado WHERE idEmpleado='$idEmpleado'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT MP.idEmpleado, SUC.nombre as sucursal, MP.userName, MP.nomPila, MP.apPaterno, MP.apMaterno, MP.fechaIngreso, MP.imagen, MP.isActive FROM empleado MP join sucursal SUC on MP.idSucursal=SUC.idSucursal";
		return ejecutarConsulta($sql);
	}

	public function listarMarcados($idEmpleado){
		$sql = "SELECT * FROM empleadoPermiso WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsulta($sql);
	}

	public function verificar($username, $password){
		$sql = "SELECT idEmpleado, userName, nomPila, apPaterno, apMaterno, fechaIngreso, imagen, idSucursal FROM empleado WHERE (userName = '$username') AND (password = '$password') AND isActive = '1'";
		return ejecutarConsulta($sql);
	}

}

?>