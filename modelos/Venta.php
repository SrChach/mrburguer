<?php 

require "../config/Conexion.php";

Class Venta{

	public function __construct(){

	}

	public function insertar($idCliente, $idEmpleado, $pagoTarjeta, $idProductoEnSucursal, $cantidad){
		$sql = "INSERT INTO venta (idCliente, idEmpleado, fecha, montoTotal, iva, descuentoActual, status, pagoTarjeta) VALUES 
		('$idCliente', '$idEmpleado', current_timestamp, '0', '0', '0', 'Entregado', '$pagoTarjeta')";
		
		$idNuevaVenta = ejecutarConsultaRetornarID($sql);
		$elementoActual = 0;
		$sinErrores = true;
		$montoTotal = 0;
		$impuesto = 0;

		while($elementoActual < count($idProductoEnSucursal)){
			$obtenPrecioActual = "SELECT P.nombre, P.precioActual FROM (SELECT idProducto FROM productoEnSucursal WHERE idProductoEnSucursal='$idProductoEnSucursal[$elementoActual]') as PES join producto P on PES.idProducto = P.idProducto";
			($naw = consultarFila($obtenPrecioActual)['precioActual']) or $sinErrores = false;

			$subconsulta = "INSERT INTO productoVendido (idventa, idProductoEnSucursal, precioVendido, cantidad, status) VALUES ('$idNuevaVenta', '$idProductoEnSucursal[$elementoActual]', '$naw', '$cantidad[$elementoActual]', 'Entregado')";
			ejecutarConsulta($subconsulta) or $sinErrores = false;
			$pa = $naw * $cantidad[$elementoActual];
			$montoTotal+=$pa;
			$impuesto+=($pa*4)/29;
			$elementoActual++;
		}

		$actualizarMonto = "UPDATE venta SET montoTotal='$montoTotal', iva='$impuesto' where idventa='$idNuevaVenta'";
		ejecutarConsulta($actualizarMonto) or $sinErrores = false;

		return $sinErrores;
		/*
		while($elementoActual < count($idProductoEnSucursal)){
			$subconsulta = "SELECT P.nombre, P.precioActual FROM (SELECT idProducto FROM productoEnSucursal WHERE idProductoEnSucursal='$idProductoEnSucursal[$elementoActual]') as PES join producto P on PES.idProducto = P.idProducto";
			$naw = consultarFila($subconsulta);
			$pdts = $naw['nombre']." ".$naw['precioActual']."<br>".$pdts;
			$elementoActual++;
		}*/
	}


	public function devolver($idventa){
		$sql = "UPDATE venta SET status='Devuelto' where idventa='$idventa'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idventa){
		$sql = "SELECT V.idventa, concat(E.nombre, ' ', E.apellidoPaterno, ' ', E.apellidoMaterno) as 'nombreEmpleado', concat(C.nombre, ' ', C.apellidoPaterno, ' ', C.apellidoMaterno) as 'nombreCliente', V.fecha, V.montoTotal, V.iva, V.descuentoActual, V.status, V.pagoTarjeta FROM (venta V join empleado E on E.idEmpleado=V.idEmpleado) left join cliente C on C.idCliente=V.idCliente WHERE V.idventa='$idventa'";
		return consultarFila($sql);
	}

	public function listarProductos($idventa){
		$sql = "SELECT DV.idventa, DV.precioVendido, DV.cantidad, DV.status, producto.nombre FROM (SELECT PV.idventa, PV.precioVendido, PV.cantidad, PV.status, PES.idProducto FROM productoVendido PV join productoEnSucursal PES on PV.idProductoEnSucursal=PES.idProductoEnSucursal WHERE PV.idventa='$idventa') DV join producto on DV.idProducto=producto.idProducto";
		return ejecutarConsulta($sql);
	}

	public function listar(){
		$sql = "SELECT V.idventa, concat(E.nombre, ' ', E.apellidoPaterno, ' ', E.apellidoMaterno) as 'nombreEmpleado', concat(C.nombre, ' ', C.apellidoPaterno, ' ', C.apellidoMaterno) as 'nombreCliente', V.fecha, V.montoTotal, V.iva, V.descuentoActual, V.status, V.pagoTarjeta FROM (venta V join empleado E on E.idEmpleado=V.idEmpleado) left join cliente C on C.idCliente=V.idCliente";
		return ejecutarConsulta($sql);
	}

}

?>