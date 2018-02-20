<?php 
require_once "../modelos/Franquicia.php";

$franquicia = new Franquicia();

$idFranquicia = isset($_POST["idFranquicia"])? limpiarCadena($_POST["idFranquicia"]) : "";

$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idFranquicia)){
			$rspta = $franquicia->insertar($nombre);
			echo $rspta ? "franquicia guardada" : "franquicia no se pudo guardar";
		} else {
			$rspta = $franquicia->editar($idFranquicia, $nombre);
			echo $rspta ? "franquicia editada" : "franquicia no se pudo editar";
		}
		break;
	case 'unactivate':
		$rspta = $franquicia->desactivar($idFranquicia);
		echo $rspta ? "franquicia desactivada" : "franquicia no se pudo desactivar";
		break;
	case 'activate':
		$rspta = $franquicia->activar($idFranquicia);
		echo $rspta ? "franquicia activada" : "franquicia no se pudo activar";
		break;
	case 'show':
		$rspta = $franquicia->mostrar($idFranquicia);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $franquicia->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				/* $reg->idFranquicia */
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idFranquicia.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idFranquicia.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idFranquicia.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idFranquicia.')"><i class="fa fa-check"></i></button>',
				"1" => $reg->nombre,
				"2" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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