<?php 
require_once "../modelos/Compra.php";

$compra = new compra();

$idcompra = isset($_POST["idcompra"])? limpiarcadena($_POST["idcompra"]) : "";
$idProveedor = isset($_POST["idProveedor"])? limpiarcadena($_POST["idProveedor"]) : "";
$idEmpleado = $_SESSION["idEmpleado"];
$fecha = isset($_POST["fecha"])? limpiarcadena($_POST["idfecha"]) : "";
$nombre = isset($_POST["nombre"])? limpiarcadena($_POST["nombre"]) : "";
$apellidoPaterno = isset($_POST["apellidoPaterno"])? limpiarcadena($_POST["apellidoPaterno"]) : "";
$apellidoMaterno = isset($_POST["apellidoMaterno"])? limpiarcadena($_POST["apellidoMaterno"]) : "";
$monto = isset($_POST["monto"])? limpiarcadena($_POST["monto"]) : "";
$iva = isset($_POST["iva"])? limpiarcadena($_POST["iva"]) : "";
$status = isset($_POST["status"])? limpiarcadena($_POST["status"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idcompra)){
			$rspta = $compra->insertar($idProveedor, $idEmpleado, $nombre, $apellidoPaterno, $apellidoMaterno, $monto, $iva, $_POST["idInsumo"], $_POST["precioUnitarioActual"], $_POST["cantidad"] ) ;
			echo $rspta ? "Compra realizada" : "No se pudieron registrar todos los datos";
		}
		break;
	case 'giveBack':
		$rspta = $compra->devolver($idCompra);
		echo $rspta ? "Compra devuelta" : "La compra no se pudo devolver";
		break;
	case 'show':
		$rspta = $compra->mostrar($idcompra);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $compra->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = Array(
				"0" => $reg->idcompra,
				"2" => $reg->empresa,
				"3" => $reg->fecha,
				"4" => $reg->nombre,
				"5" => $reg->apellidoPaterno,
				"6" => $reg->apellidoMaterno,
				"7" => $reg->monto,
				"8" => $reg->iva
			);
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			/*Total de registros a viualizar*/
			"aaData" => $data
		);
		echo json_encode($results);
		break;	
	case 'selectProveedor':
		require_once "../modelos/Proveedor.php";
		$proveedor = new Proveedor();
		$rspta = $proveedor->select();
		while($reg = $rspta->fetch_object()){
			echo '<option value='.$reg->idProveedor.'>'. $reg->nombreEmpresa.'</option>';
		}
		break;
	case 'consultaCompra' : 
		$rspta = $compra->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = Array(
				/*$reg->idcompra*/
				"0" => $reg->idcompra,
				"2" => $reg->empresa,
				"3" => $reg->fecha,
				"4" => $reg->nombre,
				"5" => $reg->apellidoPaterno,
				"6" => $reg->apellidoMaterno,
				"7" => $reg->monto,
				"8" => $reg->iva
			);

		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			/*Total de registros a viualizar*/
			"aaData" => $data
		);
		echo json_encode($results);
		break;	

}


?>