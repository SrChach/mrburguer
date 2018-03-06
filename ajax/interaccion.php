<?php 
require_once "../modelos/Interaccion.php";

$interaccion = new Interaccion();

$idinteraccion = isset($_POST["idinteraccion"])? limpiarCadena($_POST["idinteraccion"]) : "";
$idCliente = isset($_POST["idCliente"])? limpiarCadena($_POST["idCliente"]) : "";
$idEvento = isset($_POST["idEvento"])? limpiarCadena($_POST["idEvento"]) : "";
$plataforma = isset($_POST["plataforma"])? limpiarCadena($_POST["plataforma"]) : "";
$accionRealizada = isset($_POST["accionRealizada"])? limpiarCadena($_POST["accionRealizada"]) : "";
$fechaHoraInteraccion = isset($_POST["fechaHoraInteraccion"])? limpiarCadena($_POST["fechaHoraInteraccion"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idinteraccion)){
			$rspta = $interaccion->insertar($idCliente, $idEvento, $accionRealizada, $fechaHoraInteraccion);
			echo $rspta ? "Interaccion guardado" : "Interaccion no se pudo guardar";
		} else {
			$rspta = $interaccion->editar($idinteraccion, $idCliente, $idEvento, $accionRealizada, $fechaHoraInteraccion);
			echo $rspta ? "Interaccion editado" : "Interaccion no se pudo editar";
		}
		break;
	case 'show':
		$rspta = $interaccion->mostrar($idinteraccion);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $interaccion->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => $reg->idinteraccion,
				"1" => $reg->idCliente,
				"2" => $reg->idEvento,
				"3" => $reg->accionRealizada,
				"4" => $reg->fechaHoraInteraccion
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
	case 'consultaInteraccion':
		$rspta = $interaccion->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				
				"0" => $reg->idCliente,
				"1" => $reg->idEvento,
				"2" => $reg->accionRealizada,
				"3" => $reg->fechaHoraInteraccion
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