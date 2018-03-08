<?php 

require "../config/Conexion.php";

Class Compra{

	public function __construct(){

	}

	public function insertar($idProveedor, $idEmpleado, $nombre, $apellidoPaterno, $apellidoMaterno, $monto, $iva, $idInsumo, $precioUnitarioActual, $cantidad){
		$sql = "INSERT INTO compra (idProveedor, idEmpleado, fecha, nombre, apellidoPaterno, apellidoMaterno, monto, iva, status) VALUES 
		('$idProveedor', '$idEmpleado', current_timestamp, '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$monto', '$iva', 'Aceptado')";
		
		$idNuevaCompra = ejecutarConsultaRetornarID($sql);

		$elementoActual = 0;
		$sinErrores = true;

		while($elementoActual < count($idInsumo)){
			$subconsulta = "INSERT INTO insumoComprado (idCompra, idInsumo, precioUnitarioActual, cantidad) VALUES ('$idNuevaCompra', '$idInsumo[$elementoActual]', '$precioUnitarioActual[$elementoActual]', '$cantidad[$elementoActual]')";
			ejecutarConsulta($subconsulta) or $sinErrores = false;
			$elementoActual++;
		}

		return $sinErrores;
	}

	public function devolver($idCompra){
		$sql = "UPDATE compra SET status='Devuelto' where idCompra='$idCompra'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idCompra){
		$sql = "SELECT C.idCompra, concat(E.nombre, ' ', E.apellidoPaterno, ' ', E.apellidoMaterno) as 'nombreEmpleado', C.fecha, P.nombreEmpresa, concat(C.nombre, ' ', C.apellidoPaterno, ' ', C.apellidoMaterno) as 'nombreProveedor', C.monto, C.iva, C.status FROM compra C join proveedor P on P.idproveedor=C.idProveedor join empleado E on E.idEmpleado=C.idEmpleado WHERE C.idCompra='$idCompra'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT C.idCompra, concat(E.nombre, ' ', E.apellidoPaterno, ' ', E.apellidoMaterno) as 'nombreEmpleado', C.fecha, P.nombreEmpresa, concat(C.nombre, ' ', C.apellidoPaterno, ' ', C.apellidoMaterno) as 'nombreProveedor', C.monto, C.iva, C.status FROM compra C join proveedor P on P.idproveedor=C.idProveedor join empleado E on E.idEmpleado=C.idEmpleado";
		return ejecutarConsulta($sql);
	}

}

?>