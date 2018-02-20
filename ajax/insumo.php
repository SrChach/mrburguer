<?php 
require_once "../modelos/Insumo.php";

$insumo = new Insumo();

$idinsumo = isset($_POST["idinsumo"])? limpiarCadena($_POST["idinsumo"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$marca = isset($_POST["marca"])? limpiarCadena($_POST["marca"]) : "";
$existencias = isset($_POST["existencias"])? limpiarCadena($_POST["existencias"]) : "";
$piezasContiene = isset($_POST["piezasContiene"])? limpiarCadena($_POST["piezasContiene"]) : "";
$precioPromedio = isset($_POST["precioPromedio"])? limpiarCadena($_POST["precioPromedio"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idinsumo)){
			$rspta = $insumo->insertar($nombre, $marca, $existencias, $piezasContiene, $precioPromedio);
			echo $rspta ? "Insumo guardado" : "Insumo no se pudo guardar";
		} else {
			$rspta = $insumo->editar($idinsumo, $nombre, $marca, $existencias, $piezasContiene, $precioPromedio);
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
				"0" => $reg->idinsumo,
				"1" => $reg->nombre,
				"2" => $reg->marca,
				"3" => $reg->existencias,
				"4" => $reg->piezasContiene,
				"5" => $reg->precioPromedio,
				"6" => $reg->isActive
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