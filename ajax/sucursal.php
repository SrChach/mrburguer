<?php 
require_once "../modelos/Sucursal.php";

$sucursal = new Sucursal();

$idsucursal = isset($_POST["idsucursal"])? limpiarcadena($_POST["idsucursal"]) : "";
$idFranquicia = isset($_POST["idFranquicia"])? limpiarcadena($_POST["idFranquicia"]) : "";
$nombre = isset($_POST["nombre"])? limpiarcadena($_POST["nombre"]) : "";
$isMobile = isset($_POST["isMobile"])? limpiarcadena($_POST["isMobile"]) : "";
$telefono = isset($_POST["telefono"])? limpiarcadena($_POST["telefono"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idsucursal)){
			$rspta = $sucursal->insertar($idFranquicia, $nombre, $isMobile, $telefono);
			echo $rspta ? "Sucursal guardada" : "Sucursal no se pudo guardar";
		} else {
			$rspta = $sucursal->editar($idsucursal, $idFranquicia, $nombre, $isMobile, $telefono);
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
		if($rspta != false)
		while($reg = $rspta->fetch_object()){
			$data[] = Array(
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idsucursal.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idsucursal.')"><i class="fa fa-check"></i></button>',
				"1" => '<a href="menu.php?op=list&SUC='.$reg->idsucursal.'"><button class="btn btn-primary">Menú</button></a>',
				"2" => '<a href="ies.php?op=list&SUC='.$reg->idsucursal.'"><button class="btn btn-primary">Inventario</button></a>',
				"3" => $reg->nombre,
				"4" => $reg->franquicia,
				"5" => ($reg->isMobile == 0)? 'Fija' : 'Móvil',
				"6" => $reg->telefono,
				"7" => ($reg->isActive)?'<span class="label bg-green">Activa<span>':'<span class="label bg-red">Desactivada<span>'
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
	case 'selectFranquicia':
		require_once "../modelos/Franquicia.php";
		$franquicia = new Franquicia();
		$rspta = $franquicia->select();
		while($reg = $rspta->fetch_object()){
			echo '<option value='.$reg->idFranquicia.'>'. $reg->nombre.'</option>';
		}
		break;
	case 'listActives':
		$rspta = $sucursal->listarActivas();
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = Array(
					"0" => $reg->nombre,
					"1" => $reg->franquicia,
					"2" => '<a href="enviar_sp.php?SUC='.$reg->idsucursal.'"><button class="btn btn-primary">Enviar nuevo cargamento</button></a>'
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