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
		$sql = "SELECT V.idVenta, concat(E.nomPila, ' ', E.apPaterno, ' ', E.apMaterno) AS 'nombreEmpleado', V.fecha, V.montoTotal, V.descuentoActual, V.status, V.pagoTarjeta FROM venta V join empleado E on E.idEmpleado=V.idEmpleado WHERE V.idEmpleado='$idEmpleado' and ( DATE_FORMAT(current_timestamp, '%m %d %Y') = DATE_FORMAT(V.fecha, '%m %d %Y')  ) ORDER BY V.idVenta desc";
		return ejecutarConsulta($sql);
	}

	/*PRODUCTIVIDAD*/

	/*Empleados más productivos en una sucursal*/
	public function prodEmpleadoEnSucursal($idSucursal, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT count(V.idVenta) AS ventasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) AS nombre, sum(V.montoTotal) AS totalVendido FROM venta V JOIN empleado E ON V.idEmpleado = E.idEmpleado WHERE (E.idSucursal = '$idSucursal') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY V.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Empleados más productivos en una franquicia*/
	public function prodEmpleadoEnFranquicia($idFranquicia, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT count(V.idVenta) AS ventasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) AS nombre, sum(V.montoTotal) AS totalVendido, S.nombre AS sucursal FROM venta V JOIN empleado E JOIN sucursal S ON (V.idEmpleado = E.idEmpleado) and (E.idSucursal = S.idSucursal) WHERE (S.idFranquicia = '$idFranquicia') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY V.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Empleados más productivos globalmente*/
	public function prodEmpleadoGeneral($fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT count(V.idVenta) AS ventasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) AS nombre, sum(V.montoTotal) AS totalVendido FROM venta V JOIN empleado E ON V.idEmpleado = E.idEmpleado WHERE V.fecha BETWEEN '$fechaIni' AND '$fechaFin' GROUP BY E.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Sucursal más productiva por franquicia*/
	public function prodSucursalEnFranquicia($idFranquicia, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT S.idSucursal, S.nombre AS nombreSucursal, count(V.idVenta) AS ventasRealizadas, sum(V.montoTotal) AS totalVendido FROM venta V JOIN empleado E RIGHT JOIN sucursal S ON (S.idSucursal=E.idSucursal) AND (V.idEmpleado = E.idEmpleado) WHERE (S.idFranquicia = '$idFranquicia') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY S.idSucursal ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	/*Franquicia más productiva*/
	public function prodFranquiciaGeneral($fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT F.idFranquicia, F.nombre AS nombreFranquicia, count(V.idVenta) AS ventasRealizadas, sum(V.montoTotal) AS totalVendido FROM (venta V JOIN empleado E JOIN sucursal S) RIGHT JOIN franquicia F ON (S.idFranquicia = F.idFranquicia) AND (S.idSucursal=E.idSucursal) AND (V.idEmpleado = E.idEmpleado) AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY F.idFranquicia ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	public function productosMasVendidos($idFranquicia, $fechaIni, $fechaFin){
		$fechaIni = $fechaIni . " 00:00:00";
		$fechaFin = $fechaFin . " 23:59:59";
		$sql = "SELECT P.nombre, LP.totalVendido FROM (SELECT PV.idProducto, SUM(PV.cantidad) AS totalVendido FROM productoVendido PV JOIN sucursal S JOIN venta V ON (PV.idSucursal = S.idSucursal) AND (PV.idVenta = V.idVenta)  WHERE (S.idFranquicia = '$idFranquicia') AND (V.fecha BETWEEN '$fechaIni' AND '$fechaFin') GROUP BY PV.idProducto) LP JOIN producto P ON LP.idProducto = P.idProducto ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	public function prodUltimosMeses($cantidadMeses){
		$sql = "SELECT F.nombre AS franquicia, SUM(V.montoTotal) AS totalVendido FROM venta V JOIN empleado E JOIN sucursal S JOIN franquicia F ON (V.idEmpleado = E.idEmpleado) AND (E.idSucursal = S.idSucursal) AND (F.idFranquicia = S.idFranquicia) WHERE V.fecha BETWEEN concat(DATE_SUB(CURDATE(), INTERVAL $cantidadMeses MONTH), ' 00:00:00') AND current_timestamp GROUP BY franquicia ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	public function prodUltimosDias($cantidadDias){
		$sql = "SELECT F.nombre AS franquicia, SUM(V.montoTotal) AS totalVendido FROM venta V JOIN empleado E JOIN sucursal S JOIN franquicia F ON (V.idEmpleado = E.idEmpleado) AND (E.idSucursal = S.idSucursal) AND (F.idFranquicia = S.idFranquicia) WHERE V.fecha BETWEEN concat(DATE_SUB(CURDATE(), INTERVAL $cantidadDias DAY), ' 00:00:00') AND current_timestamp GROUP BY franquicia ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	public function topN($cant){
		$sql = "SELECT concat(E.nomPila, ' ', SUBSTRING(E.apPaterno, 1, 1),'.') AS empleado, SUM(V.montoTotal) AS total FROM empleado E JOIN venta V ON V.idEmpleado=E.idEmpleado WHERE V.fecha BETWEEN concat(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), ' 00:00:00') AND current_timestamp GROUP BY empleado ORDER BY total DESC limit 0,$cant";
		return ejecutarConsulta($sql);
	}

	public function noProductivos($cantidadDias){
		$sql = "SELECT concat(E.nomPila, ' ', E.apPaterno, ' ', E.apMaterno) AS empleado FROM (
			SELECT count(V.idVenta) AS cantidadVentas, E1.idEmpleado FROM empleado E1 JOIN venta V ON V.idEmpleado=E1.idEmpleado WHERE V.fecha BETWEEN concat(DATE_SUB(CURDATE(), INTERVAL $cantidadDias DAY), ' 00:00:00') AND current_timestamp GROUP BY idEmpleado
		) ET RIGHT JOIN 
		(
			SELECT E2.idEmpleado, E2.nomPila, E2.apPaterno, E2.apMaterno FROM empleado E2 JOIN empleadoPermiso EP ON E2.idEmpleado = EP.idEmpleado WHERE (EP.idPermiso = 5) AND (E2.isActive = 1)
		) E 
		ON ET.idEmpleado = E.idEmpleado WHERE ET.idEmpleado IS NULL LIMIT 0,30";
		return ejecutarConsulta($sql);
	}

}

?>