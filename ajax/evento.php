<?php 
require_once "../modelos/Evento.php";

$evento = new Evento();

$idevento = isset($_POST["idevento"])? limpiarCadena($_POST["idevento"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$tipo = isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]) : "";
$plataforma = isset($_POST["plataforma"])? limpiarCadena($_POST["plataforma"]) : "";
$recompensa = isset($_POST["recompensa"])? limpiarCadena($_POST["recompensa"]) : "";
$fechaInicio = isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]) : "";
$fechaFin = isset($_POST["fechaFin"])? limpiarCadena($_POST["fechaFin"]) : "";

if(session_id() == '') {
	session_start();
}
if(!isset($_SESSION["username"])){
	echo "No has iniciado sesión";
	return;
}

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idevento)){
			$rspta = $evento->insertar($nombre, $tipo, $plataforma, $recompensa, $fechaInicio, $fechaFin);
			echo $rspta ? "Evento guardado" : "Evento no se pudo guardar";
		} else {
			$rspta = $evento->editar($idevento, $nombre, $tipo, $plataforma, $recompensa, $fechaInicio, $fechaFin);
			echo $rspta ? "Evento editado" : "Evento no se pudo editar";
		}
		break;
	case 'show':
		$rspta = $evento->mostrar($idevento);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $evento->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => $reg->idevento,
				"1" => $reg->nombre,
				"2" => $reg->tipo,
				"3" => $reg->plataforma,
				"4" => $reg->recompensa,
				"5" => $reg->fechaInicio,
				"6" => $reg->fechaFin
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
	case 'consultaEvento' :
		$rspta = $evento->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => $reg->idevento,
				"1" => $reg->nombre,
				"2" => $reg->tipo,
				"3" => $reg->plataforma,
				"4" => $reg->recompensa,
				"5" => $reg->fechaInicio,
				"6" => $reg->fechaFin
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