<?php 
require_once "../modelos/Proveedor.php";

$proveedor = new Proveedor();

$idproveedor = isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]) : "";
$nombreEmpresa = isset($_POST["nombreEmpresa"])? limpiarCadena($_POST["nombreEmpresa"]) : "";
$correoElectronico = isset($_POST["correoElectronico"])? limpiarCadena($_POST["correoElectronico"]) : "";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]) : "";
$estado = isset($_POST["estado"])? limpiarCadena($_POST["estado"]) : "";
$delegacion = isset($_POST["delegacion"])? limpiarCadena($_POST["delegacion"]) : "";
$colonia = isset($_POST["colonia"])? limpiarCadena($_POST["colonia"]) : "";
$calle = isset($_POST["calle"])? limpiarCadena($_POST["calle"]) : "";
$numExt = isset($_POST["numExt"])? limpiarCadena($_POST["numExt"]) : "";
$numInt = isset($_POST["numInt"])? limpiarCadena($_POST["numInt"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idproveedor)){
			$rspta = $proveedor->insertar($nombreEmpresa, $correoElectronico, $telefono, $estado, $delegacion, $colonia, $calle, $numExt, $numInt);
			echo $rspta ? "Proveedor guardado" : "Proveedor no se pudo guardar";
		} else {
			$rspta = $proveedor->editar($idproveedor, $nombreEmpresa, $correoElectronico, $telefono, $estado, $delegacion, $colonia, $calle, $numExt, $numInt);
			echo $rspta ? "Proveedor editado" : "Proveedor no se pudo editar";
		}
		break;
	case 'unactivate':
		$rspta = $proveedor->desactivar($idproveedor);
		echo $rspta ? "Proveedor desactivado" : "Proveedor no se pudo desactivar";
		break;
	case 'activate':
		$rspta = $proveedor->activar($idproveedor);
		echo $rspta ? "Proveedor activado" : "Proveedor no se pudo activar";
		break;
	case 'show':
		$rspta = $proveedor->mostrar($idproveedor);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $proveedor->listar();
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idproveedor.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idproveedor.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idproveedor.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idproveedor.')"><i class="fa fa-check"></i></button>',
					"1" => $reg->nombreEmpresa,
					"2" => $reg->correoElectronico,
					"3" => $reg->telefono,
					"4" => $reg->estado,
					"5" => $reg->delegacion,
					"6" => $reg->colonia,
					"7" => $reg->calle,
					"8" => $reg->numExt,
					"9" => $reg->numInt,
					"10" => $reg->isActive?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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
	case 'consultaProveedor' : 
		$rspta = $proveedor->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => $reg->nombreEmpresa,
				"1" => $reg->correoElectronico,
				"2" => $reg->telefono,
				"3" => $reg->estado,
				"4" => $reg->delegacion,
				"5" => $reg->colonia,
				"6" => $reg->calle,
				"7" => $reg->numExt,
				"8" => $reg->numInt,
				"9" => $reg->isActive?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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