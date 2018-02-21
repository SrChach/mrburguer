<?php 
require_once "../modelos/Sucursal.php";

$sucursal = new Sucursal();

$idsucursal = isset($_POST["idsucursal"])? limpiarcadena($_POST["idsucursal"]) : "";
$nombre = isset($_POST["nombre"])? limpiarcadena($_POST["nombre"]) : "";
$idFranquicia = isset($_POST["idFranquicia"])? limpiarcadena($_POST["idFranquicia"]) : "";
$movil = isset($_POST["movil"])? limpiarcadena($_POST["movil"]) : "";
$estado = isset($_POST["estado"])? limpiarcadena($_POST["estado"]) : "";
$delegacion = isset($_POST["delegacion"])? limpiarcadena($_POST["delegacion"]) : "";
$colonia = isset($_POST["colonia"])? limpiarcadena($_POST["colonia"]) : "";
$calle = isset($_POST["calle"])? limpiarcadena($_POST["calle"]) : "";
$numExt = isset($_POST["numExt"])? limpiarcadena($_POST["numExt"]) : "";
$numInt = isset($_POST["numInt"])? limpiarcadena($_POST["numInt"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idsucursal)){
			$rspta = $sucursal->insertar($nombre, $idFranquicia, $movil, $estado, $delegacion, $colonia, $calle, $numExt, $numInt);
			echo $rspta ? "Sucursal guardada" : "Sucursal no se pudo guardar";
		} else {
			$rspta = $sucursal->editar($idsucursal, $nombre, $idFranquicia, $movil, $estado, $delegacion, $colonia, $calle, $numExt, $numInt);
			echo $rspta ? "Sucursal editada" : "Sucursal no se pudo editar";
		}
		break;
	case 'unactivate':
		$rspta = $sucursal->desactivar($idsucursal);
		echo $rspta ? "Sucursal desactivada" : "Sucursal no se pudo desactivar";
		break;
	case 'activate':
		$rspta = $sucursal->activar($idsucursal);
		echo $rspta ? "Sucursal activada" : "Sucursal no se pudo activar";
		break;
	case 'show':
		$rspta = $sucursal->mostrar($idsucursal);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $sucursal->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = Array(
				/*$reg->idsucursal*/
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idsucursal.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idsucursal.')"><i class="fa fa-check"></i></button>',
				"1" => '<a href="menu.php?op=list&SUC='.$reg->idsucursal.'"><button class="btn btn-primary">Modificar Menú</button></a>',
				"2" => $reg->nombre,
				"3" => $reg->franquicia,/*Modify*/
				"4" => ($reg->movil == 0)? 'Fija' : 'Móvil',
				"5" => $reg->estado,
				"6" => $reg->delegacion,
				"7" => $reg->colonia,
				"8" => $reg->calle,
				"9" => $reg->numExt,
				"10" => $reg->numInt,
				"11" => ($reg->isActive)?'<span class="label bg-green">Activa<span>':'<span class="label bg-red">Desactivada<span>'
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
	case 'selectFranquicia':
		require_once "../modelos/Franquicia.php";
		$franquicia = new Franquicia();
		$rspta = $franquicia->select();
		while($reg = $rspta->fetch_object()){
			echo '<option value='.$reg->idFranquicia.'>'. $reg->nombre.'</option>';
		}
		break;

}


?>