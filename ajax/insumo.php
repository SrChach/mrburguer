<?php 
require_once "../modelos/Insumo.php";

$insumo = new Insumo();

$idinsumo = isset($_POST["idinsumo"])? limpiarCadena($_POST["idinsumo"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$existencias = isset($_POST["existencias"])? limpiarCadena($_POST["existencias"]) : "";
$precioPromedio = isset($_POST["precioPromedio"])? limpiarCadena($_POST["precioPromedio"]) : "";

if(session_id() == '') {
	session_start();
}
if(!isset($_SESSION["username"])){
	echo "No has iniciado sesión";
	return;
}

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idinsumo)){
			$rspta = $insumo->insertar($nombre, $existencias, $precioPromedio);
			echo $rspta ? "Insumo guardado" : "Insumo no se pudo guardar";
		} else {
			$rspta = $insumo->editar($idinsumo, $nombre, $existencias, $precioPromedio);
			echo $rspta ? "Insumo editado" : "Insumo no se pudo editar";
		}
		break;
	case 'unactivate':
		$rspta = $insumo->desactivar($idinsumo);
		echo $rspta ? "Insumo desactivado" : "Insumo no se pudo desactivar";
		break;
	case 'activate':
		$rspta = $insumo->activar($idinsumo);
		echo $rspta ? "Insumo activado" : "Insumo no se pudo activar";
		break;
	case 'show':
		$rspta = $insumo->mostrar($idinsumo);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $insumo->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idinsumo.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idinsumo.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idinsumo.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idinsumo.')"><i class="fa fa-check"></i></button>',
				"1" => $reg->nombre,
				"2" => $reg->existencias,
				"3" => $reg->precioPromedio,
				"4" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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