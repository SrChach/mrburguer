<?php 

require "../config/Conexion.php";

Class Compra{

	public function __construct(){

	}

	public function insertar($idProveedor, $nombre, $apellidoPaterno, $apellidoMaterno, $monto, $iva, $idInsumo, $precioUnitarioActual, $cantidad){
		$sql = "INSERT INTO compra (idProveedor, fecha, nombre, apellidoPaterno, apellidoMaterno, monto, iva, status) VALUES 
		('$idProveedor', current_timestamp, '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$monto', '$iva', 'Aceptado')";
		
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
		$sql = "SELECT C.idCompra, P.nombreEmpresa, C.fecha, C.nombre, C.apellidoPaterno, C.apellidoMaterno, C.monto, C.iva, C.status FROM compra C join proveedor P on proveedor.idproveedor=compra.idProveedor";
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