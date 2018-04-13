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
		/*
		while($elementoActual < count($idProductoEnSucursal)){
			$subconsulta = "SELECT P.nombre, P.precioActual FROM (SELECT idProducto FROM productoEnSucursal WHERE idProductoEnSucursal='$idProductoEnSucursal[$elementoActual]') as PES join producto P on PES.idProducto = P.idProducto";
			$naw = consultarFila($subconsulta);
			$pdts = $naw['nombre']." ".$naw['precioActual']."<br>".$pdts;
			$elementoActual++;
		}*/
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

	public function prodEmpleadoEnSucursal($idSucursal){
		$sql = "SELECT count(V.idVenta) AS VentasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) as nombre, sum(V.montoTotal) as totalVendido FROM venta V JOIN empleado E ON V.idEmpleado = E.idEmpleado WHERE E.idSucursal = '$idSucursal' GROUP BY V.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	public function prodEmpleadoEnFranquicia($idFranquicia){
		$sql = "SELECT count(V.idVenta) AS VentasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) as nombre, sum(V.montoTotal) as totalVendido, S.nombre as sucursal FROM venta V JOIN empleado E JOIN sucursal S ON (V.idEmpleado = E.idEmpleado) and (E.idSucursal = S.idSucursal) WHERE S.idFranquicia = '$idFranquicia' GROUP BY V.idEmpleado ORDER BY totalVendido desc";
		return ejecutarConsulta($sql);
	}

	public function prodEmpleadoGeneral(){
		$sql = "SELECT count(V.idVenta) AS VentasRealizadas, concat(E.nomPila,' ',E.apPaterno,' ',E.apMaterno) as nombre, sum(V.montoTotal) as totalVendido FROM venta V JOIN empleado E ON V.idEmpleado = E.idEmpleado GROUP BY E.idEmpleado ORDER BY totalVendido desc";
	}

	public function prodSucursalEnFranquicia($idFranquicia){

	}

}

?>