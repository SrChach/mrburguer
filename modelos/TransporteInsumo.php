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

	public function enviarSinPeticion($idInsumoEnSucursal, $cantidadEnviada){
		$sinErrores = true;
		$elementoActual=0;

		while($elementoActual < count($cantidadEnviada)){
			$idInsumo = 0;
			$temp = "SELECT idInsumo FROM insumoEnSucursal WHERE idInsumoEnSucursal=$idInsumoEnSucursal[$elementoActual]";
			$idInsumo = consultarFila($temp)['idInsumo'];
			if($idInsumo != 0){
				$sql = "INSERT INTO transporteInsumo (idInsumoEnSucursal, idInsumo, fechaEnvío, cantidadEnviada) VALUES ($idInsumoEnSucursal[$elementoActual], $idInsumo, current_timestamp, $cantidadEnviada[$elementoActual])";
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
		$checar = "SELECT I.existencias, I.idInsumo FROM insumoEnSucursal IES JOIN insumo I ON IES.idInsumo=I.idInsumo WHERE IES.idInsumoEnSucursal='$idInsumoEnSucursal'";
		$insumo = consultarFila($checar);
		$xst = $insumo['existencias'];
		$idInsumo = $insumo['idInsumo'];

		if(($xst >= $cantidadEnviada) && ($cantidadEnviada >=0) ){
			$sql = "UPDATE transporteInsumo SET fechaEnvío=current_timestamp, cantidadEnviada='$cantidadEnviada' WHERE idTransporteInsumo='$idTransporteInsumo'";
			ejecutarConsulta($sql) or $sinErrores=false;

			if($sinErrores){
				$cantidad = $xst - $cantidadEnviada;
				$descontar = "UPDATE insumo SET existencias=$cantidad WHERE idInsumo='$idInsumo'";
				ejecutarConsulta($descontar) or $sinErrores = false;
			}
		} else {
			$sinErrores = false;
		}

		return $sinErrores;
	}
	
	public function recibir($idTransporteInsumo, $cantidadRecibida, $idEmpleadoRecibe, $observaciones){
		$sinErrores = true;
		$checar = "SELECT IES.cantidad, IES.idInsumoEnSucursal FROM transporteInsumo T JOIN insumoEnSucursal IES ON T.idInsumoEnSucursal=IES.idInsumoEnSucursal WHERE T.idTransporteInsumo='$idTransporteInsumo'";
		$ies = consultarFila($checar);
		$xst = $ies["cantidad"];
		$idIES = $ies["idInsumoEnSucursal"];

		if($cantidadRecibida >= 0){
			$sql = "UPDATE transporteInsumo SET cantidadRecibida='$cantidadRecibida', fechaRecepcion=current_timestamp, idEmpleadoRecibe='$idEmpleadoRecibe', observaciones='$observaciones' WHERE idTransporteInsumo='$idTransporteInsumo'";
			ejecutarConsulta($sql) or $sinErrores=false;
			if($sinErrores){
				$cantidad = $xst + $cantidadRecibida;
				$agregar = "UPDATE insumoEnSucursal SET cantidad=$cantidad WHERE idInsumoEnSucursal='$idIES'";
				ejecutarConsulta($agregar) or $sinErrores = false;
			}

		} else  {
			$sinErrores = false;
		}

		return $sinErrores;
	}

	public function paraPedir($idSucursal){
		$sql = "SELECT IES.idInsumoEnSucursal, IES.idInsumo, insumo.nombre FROM (SELECT idInsumoEnSucursal, idInsumo FROM insumoEnSucursal WHERE idSucursal='$idSucursal' and isActive='1') IES JOIN insumo ON IES.idInsumo = insumo.idInsumo";
		return ejecutarConsulta($sql);
	}

	public function sucursalesNecesitadas(){
		$sql = "SELECT IES.idSucursal, sucursal.nombre, count(IES.idSucursal) as contador FROM (SELECT idInsumoEnSucursal FROM transporteInsumo WHERE cantidadEnviada IS NULL) T JOIN insumoEnSucursal IES JOIN sucursal on IES.idInsumoEnSucursal=T.idInsumoEnSucursal and IES.idSucursal=sucursal.idSucursal GROUP BY IES.idSucursal";
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

	public function porConfirmar($idSucursal){
		$sql = "SELECT count(T.idTransporteInsumo) as bandera FROM transporteInsumo T JOIN insumoEnSucursal IES ON T.idInsumoEnSucursal=IES.idInsumoEnSucursal WHERE (IES.idSucursal='$idSucursal') and (T.cantidadEnviada IS NOT NULL) and (T.cantidadRecibida IS NULL)";
		return consultarFila($sql);
	}

}

?>