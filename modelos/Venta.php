<?php 

require "../config/Conexion.php";

Class Venta{

	public function __construct(){

	}

	public function insertar($idCliente, $idEmpleado, $montoTotal, $iva, $pagoTarjeta, $idProductoEnSucursal, $cantidad){
		$sql = "INSERT INTO venta (idCliente, idEmpleado, fecha, montoTotal, iva, descuentoActual, status, pagoTarjeta) VALUES 
		('$idCliente', '$idEmpleado', current_timestamp, '$montoTotal', '$iva', '0', 'Entregado', '$pagoTarjeta')";
		
		$idNuevaVenta = ejecutarConsultaRetornarID($sql);

		$elementoActual = 0;
		$sinErrores = true;

		while($elementoActual < count($idProductoEnSucursal)){
			$subconsulta = "INSERT INTO productoVendido (idventa, idProductoEnSucursal, precioVendido, cantidad) VALUES ('$idNuevaVenta', '$idProductoEnSucursal[$elementoActual]', '$precioVendido[$elementoActual]', '$cantidad[$elementoActual]', 'Entregado')";
			ejecutarConsulta($subconsulta) or $sinErrores = false;
			$elementoActual++;
		}

		return $sinErrores;
	}

	public function devolver($idventa){
		$sql = "UPDATE venta SET status='Devuelto' where idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idventa){
		$sql = "SELECT V.idventa, concat(E.nombre, ' ', E.apellidoPaterno, ' ', E.apellidoMaterno) as 'nombreEmpleado', concat(C.nombre, ' ', C.apellidoPaterno, ' ', C.apellidoMaterno) as 'nombreCliente', V.fecha, V.montoTotal, V.iva, V.descuentoActual, V.status, V.pagoTarjeta FROM (venta V join empleado E on E.idEmpleado=V.idEmpleado) left join cliente C on C.idCliente=V.idCliente WHERE V.idventa='$idventa'";
		return consultarFila($sql);

	}

	public function listar(){
		$sql = "SELECT V.idventa, concat(E.nombre, ' ', E.apellidoPaterno, ' ', E.apellidoMaterno) as 'nombreEmpleado', concat(C.nombre, ' ', C.apellidoPaterno, ' ', C.apellidoMaterno) as 'nombreCliente', V.fecha, V.montoTotal, V.iva, V.descuentoActual, V.status, V.pagoTarjeta FROM (venta V join empleado E on E.idEmpleado=V.idEmpleado) left join cliente C on C.idCliente=V.idCliente";
		return ejecutarConsulta($sql);
	}

}

?>