<?php 

require "../config/Conexion.php";

Class TransporteInsumo{

	public function __construct(){

	}

	public function pedir($idInsumoEnSucursal, $cantidadPedida){
		$sinErrores = true;
		$elementoActual=0;

		while($elementoActual < count($cantidadPedida)){
			$idInsumo = 0;
			$temp = "SELECT idInsumo FROM insumoEnSucursal WHERE idInsumoEnSucursal=$idInsumoEnSucursal[$elementoActual]";
			$idInsumo = consultarFila($temp)['idInsumo'];
			if($idInsumo != 0){
				$sql = "INSERT INTO transporteInsumo (idInsumoEnSucursal, idInsumo, fechaSolicitud, cantidadPedida) VALUES ($idInsumoEnSucursal[$elementoActual], $idInsumo, current_timestamp, $cantidadPedida[$elementoActual])";
				ejecutarConsulta($sql) or $sinErrores = false;	
			} else {
				$sinErrores = false;
			}
			$elementoActual++;
		}
		return $sinErrores;
	}

	public function enviar($idTransporteInsumo, $idInsumoEnSucursal, $cantidadEnviada){
		$sinErrores = true;
		$elementoActual = 0;

		while($elementoActual < count($cantidadPedida)){
			$idInsumo = 0;
			$temp = "SELECT idInsumo FROM insumoEnSucursal WHERE idInsumoEnSucursal=$idInsumoEnSucursal[$elementoActual]";
			$idInsumo = consultarFila($temp)['idInsumo'];
			if($idTransporteInsumo[$elementoActual] == 0){	
				if($idInsumo != 0){
					$sql = "INSERT INTO transporteInsumo (idInsumoEnSucursal, idInsumo, fechaEnvio, cantidadEnviada) VALUES ($idInsumoEnSucursal[$elementoActual], $idInsumo, current_timestamp, $cantidadEnviada[$elementoActual])";
					ejecutarConsulta($sql) or $sinErrores = false;	
				} else {
					$sinErrores = false;
				}
			} else {
				$sql = "UPDATE transporteInsumo SET fechaEnvio=current_timestamp, cantidadEnviada='$cantidadEnviada[$elementoActual]' WHERE idTransporteInsumo='$idTransporteInsumo[$elementoActual]'";
				ejecutarConsulta($sql) or $sinErrores = false;
			}
			$elementoActual++;
		}
		return $sinErrores;
	}
	
	public function recibir($idTransporteInsumo, $cantidadRecibida, $idEmpleadoRecibe, $observaciones){
		$sql = "UPDATE transporteInsumo SET cantidadRecibida='$cantidadRecibida', fechaRecepcion=current_timestamp, idEmpleadoRecibe='$idEmpleadoRecibe', observaciones='$observaciones' WHERE idTransporteInsumo='$idTransporteInsumo'";
		return ejecutarConsulta($sql);
	}

	public function paraPedir($idSucursal){
		$sql = "SELECT IES.idInsumoEnSucursal, IES.idInsumo, insumo.nombre FROM (SELECT idInsumoEnSucursal, idInsumo FROM insumoEnSucursal WHERE idSucursal='$idSucursal') IES JOIN insumo ON IES.idInsumo = insumo.idInsumo";
		return ejecutarConsulta($sql);
	}

	public function sucursalesNecesitadas(){
		$sql = "SELECT IES.idSucursal, sucursal.nombre, count(IES.idSucursal) as contador FROM (SELECT idInsumoEnSucursal FROM transporteInsumo WHERE cantidadEnviada IS NULL) T join insumoEnSucursal IES join sucursal on IES.idInsumoEnSucursal=T.idInsumoEnSucursal and IES.idSucursal=sucursal.idSucursal";
		return ejecutarConsulta($sql);
	}

	public function mostrarSolicitudes($idSucursal){
		$sql = "SELECT TI.idTransporteInsumo, TI.idInsumoEnSucursal, TI.cantidadPedida, T.nombre FROM (SELECT idTransporteInsumo, idInsumoEnSucursal, cantidadPedida FROM transporteInsumo WHERE fechaEnvío IS NULL) TI JOIN (SELECT IES.idInsumoEnSucursal, I.nombre FROM insumoEnSucursal IES JOIN insumo I ON IES.idInsumo=I.idInsumo WHERE IES.idSucursal='$idSucursal') T on TI.idInsumoEnSucursal=T.idInsumoEnSucursal";
		return ejecutarConsulta($sql);
	}

	public function confirmarRecepcion($idSucursal){
		$sql = "SELECT TI.idTransporteInsumo, TI.idInsumoEnSucursal, T.nombre, TI.cantidadEnviada FROM (SELECT idTransporteInsumo, idInsumoEnSucursal, cantidadEnviada FROM transporteInsumo WHERE (fechaEnvío IS NOT NULL) and (cantidadRecibida IS NULL)) TI JOIN (SELECT IES.idInsumoEnSucursal, I.nombre FROM insumoEnSucursal IES JOIN insumo I ON IES.idInsumo=I.idInsumo WHERE IES.idSucursal='$idSucursal') T on TI.idInsumoEnSucursal=T.idInsumoEnSucursal";
		return ejecutarConsulta($sql);
	}

}

?>