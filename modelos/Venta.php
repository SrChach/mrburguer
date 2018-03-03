<?php

require "../config/Conexion.php";

Class Venta{

	public function __construct(){

	}

	public function insertar($idCliente, $idEmpleado, $fecha, $montoTotal, $iva, $descuentoActual, $status, $pagoTarjeta){
		$sql =  "INSERT INTO venta(idVenta, idCliente, idEmpleado, fecha, montoTotal, iva, descuentoActual, status, pagoTarjeta) VALUES ('$idCliente', '$idEmpleado', '$fecha', '$montoTotal', '$iva', '$descuentoActual', 'Entregado', '0')";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idventa){
		$sql = "SELECT * FROM venta WHERE idventa='$idventa'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT * FROM venta";
		return ejecutarConsulta($sql);
	}
}

?>