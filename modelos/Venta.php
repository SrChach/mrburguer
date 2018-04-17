<?php 

require "../config/Conexion.php";

Class Venta{

	public function __construct(){

	}

	public function insertar($idEmpleado, $pagoTarjeta, $idSucursal, $idProducto, $cantidad){
		$sql = "INSERT INTO venta (idEmpleado, fecha, montoTotal, descuentoActual, status, pagoTarjeta) VALUES 
			('$idEmpleado', current_timestamp, '0', '0', 'Entregado', '$pagoTarjeta')";
		
		$idNuevaVenta = ejecutarConsultaRetornarID($sql);
		$elementoActual = 0;
		$sinErrores = true;
		$montoTotal = 0;

		
		while($elementoActual < count($idProducto)){
			$obtenPrecioActual = "SELECT nombre, precioActual FROM producto WHERE idproducto='$idProducto[$elementoActual]'";
			($naw = consultarFila($obtenPrecioActual)['precioActual']) or $sinErrores = false;

			$subconsulta = "INSERT INTO productoVendido (idSucursal, idVenta, idProducto, precioVendido, cantidad, status) VALUES ('$idSucursal','$idNuevaVenta', '$idProducto[$elementoActual]', '$naw', '$cantidad[$elementoActual]', 'Entregado')";
			ejecutarConsulta($subconsulta) or $sinErrores = false;
			$pa = $naw * $cantidad[$elementoActual];
			$montoTotal+=$pa;
			$elementoActual++;
		}

		$actualizarMonto = "UPDATE venta SET montoTotal='$montoTotal' WHERE idVenta='$idNuevaVenta'";
		ejecutarConsulta($actualizarMonto) or $sinErrores = false;

		return $sinErrores;
	}

	public function devolver($idVenta){
		$sql = "UPDATE venta SET status='Devuelto' where idVenta='$idVenta'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idVenta){
		$sql = "SELECT pagoTarjeta FROM venta WHERE idVenta='$idVenta'";
		return consultarFila($sql);
	}

	public function listarProductos($idVenta){
		$sql = "SELECT DV.idVenta, DV.precioVendido, DV.cantidad, DV.status, producto.nombre FROM (SELECT * FROM productoVendido WHERE idVenta='$idVenta') DV join producto on DV.idProducto=producto.idProducto";
		return ejecutarConsulta($sql);
	}

	public function listar($idEmpleado){
		$sql = "SELECT V.idVenta, concat(E.nomPila, ' ', E.apPaterno, ' ', E.apMaterno) as 'nombreEmpleado', V.fecha, V.montoTotal, V.descuentoActual, V.status, V.pagoTarjeta FROM venta V join empleado E on E.idEmpleado=V.idEmpleado WHERE V.idEmpleado='$idEmpleado' and ( DATE_FORMAT(current_timestamp, '%m %d %Y') = DATE_FORMAT(V.fecha, '%m %d %Y')  ) ORDER BY V.idVenta desc";
		return ejecutarConsulta($sql);
	}

	/*PRODUCTIVIDAD*/

	/*Empleados más productivos en una sucursal*/
	public function prodEmpleadoEnSucursal($idSucursal, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT count(V.idVenta) AS ventasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) as nombre, sum(V.montoTotal) as totalVendido FROM venta V JOIN empleado E ON V.idEmpleado = E.idEmpleado WHERE (E.idSucursal = '$idSucursal') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY V.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Empleados más productivos en una franquicia*/
	public function prodEmpleadoEnFranquicia($idFranquicia, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT count(V.idVenta) AS ventasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) as nombre, sum(V.montoTotal) as totalVendido, S.nombre as sucursal FROM venta V JOIN empleado E JOIN sucursal S ON (V.idEmpleado = E.idEmpleado) and (E.idSucursal = S.idSucursal) WHERE (S.idFranquicia = '$idFranquicia') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY V.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Empleados más productivos globalmente*/
	public function prodEmpleadoGeneral($fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT count(V.idVenta) AS ventasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) as nombre, sum(V.montoTotal) as totalVendido FROM venta V JOIN empleado E ON V.idEmpleado = E.idEmpleado WHERE V.fecha BETWEEN '$fechaIni' AND '$fechaFin' GROUP BY E.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Sucursal más productiva por franquicia*/
	public function prodSucursalEnFranquicia($idFranquicia, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT S.idSucursal, S.nombre as nombreSucursal, count(V.idVenta) AS ventasRealizadas, sum(V.montoTotal) as totalVendido FROM venta V JOIN empleado E RIGHT JOIN sucursal S ON (S.idSucursal=E.idSucursal) AND (V.idEmpleado = E.idEmpleado) WHERE (S.idFranquicia = '$idFranquicia') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY S.idSucursal ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Franquicia más productiva*/
	public function prodFranquiciaGeneral($fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT F.idFranquicia, F.nombre as nombreFranquicia, count(V.idVenta) AS ventasRealizadas, sum(V.montoTotal) as totalVendido FROM (venta V JOIN empleado E JOIN sucursal S) RIGHT JOIN franquicia F ON (S.idFranquicia = F.idFranquicia) AND (S.idSucursal=E.idSucursal) AND (V.idEmpleado = E.idEmpleado) AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY F.idFranquicia ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	public function productosMasVendidos($idFranquicia, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT P.nombre, LP.totalVendido FROM (SELECT PV.idProducto, SUM(PV.cantidad) as totalVendido FROM productoVendido PV JOIN sucursal S JOIN venta V ON (PV.idSucursal = S.idSucursal) AND (PV.idVenta = V.idVenta)  WHERE (S.idFranquicia = '$idFranquicia') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY PV.idProducto) LP JOIN producto P ON LP.idProducto = P.idProducto ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

}

?>