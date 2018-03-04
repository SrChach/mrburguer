<?php 

require "../config/Conexion.php";

Class Compra{

	public function __construct(){

	}

	public function insertar($idProveedor, $fecha, $nombre, $apellidoPaterno, $apellidoMaterno, $monto, $iva){
		$sql = "INSERT INTO compra (idProveedor, fecha, nombre, apellidoPaterno, apellidoMaterno, monto, iva) VALUES 
		('$idProveedor', '$fecha', '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$monto', '$iva')";
		return ejecutarConsulta($sql);
	}

	public function editar($idCompra, $idProveedor, $fecha, $nombre, $apellidoPaterno, $apellidoMaterno, $monto, $iva, $numInt){
		$sql = "UPDATE compra SET nombre='$nombre', idProveedor='$idProveedor', fecha='$fecha', nombre='$nombre', apellidoPaterno='$apellidoPaterno', apellidoMaterno='$apellidoMaterno', monto='$monto', iva='$iva' WHERE idCompra='$idCompra'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idCompra){
		$sql = "SELECT * FROM compra WHERE idCompra='$idCompra'";
		return consultarFila($sql);
	}

	public function listar(){
		$sql = "SELECT compra.idCompra, proveedor.nombreEmpresa as 'empresa', compra.fecha, compra.nombre, compra.apellidoPaterno, compra.apellidoMaterno, compra.monto, compra.iva FROM proveedor JOIN compra ON proveedor.idProveedor=compra.idProveedor";
		return ejecutarConsulta($sql);
	}

	public function select(){
		$sql = "SELECT idProveedor  WHERE (sucursal.isActive=1) and (franquicia.isActive=1)";
		return ejecutarConsulta($sql);
	}

}

?>