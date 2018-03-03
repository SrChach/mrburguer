<?php 
require_once "../modelos/Venta.php";

$venta = new Venta();

$idventa = isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]) : "";
$idCliente = isset($_POST["idCliente"])? limpiarCadena($_POST["idCliente"]) : "";
$idEmpleado = isset($_POST["idEmpleado"])? limpiarCadena($_POST["idEmpleado"]) : "";
$fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]) : "";
$montoTotal = isset($_POST["montoTotal"])? limpiarCadena($_POST["montoTotal"]) : "";
$iva = isset($_POST["iva"])? limpiarCadena($_POST["iva"]) : "";
$descuentoTotal = isset($_POST["descuentoTotal"])? limpiarCadena($_POST["descuentoTotal"]) : "";
$status = isset($_POST["status"])? limpiarCadena($_POST["status"]) : "";
$pagoTarjeta = isset($_POST["pagoTarjeta"])? limpiarCadena($_POST["pagoTarjeta"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idventa)){
			$rspta = $venta->insertar($idventa, $idCliente, $idEmpleado, $fecha, $montoTotal, $iva, $descuentoActual, $status, $pagoTarjeta);
			echo $rspta ? "Venta guardada" : "Venta no se pudo guardar";
		} 
		break;
	case 'show':
		$rspta = $venta->mostrar($idventa);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $venta->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => $reg->idventa,
				"1" => $reg->idCliente,
				"2" => $reg->idEmpleado,
				"3" => $reg->fecha,
				"4" => $reg->montoTotal,
				"5" => $reg->iva,
				"5" => $reg->descuentoTotal,
				"5" => $reg->status,
				"6" => $reg->pagoTarjeta
			);
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;


}

?>