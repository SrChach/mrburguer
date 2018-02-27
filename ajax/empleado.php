<?php 
require_once "../modelos/Empleado.php";

$empleado = new Empleado();

$idEmpleado = isset($_POST["idEmpleado"])? limpiarCadena($_POST["idEmpleado"]) : "";
$idSucursal = isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]) : "";
$username = isset($_POST["username"])? limpiarCadena($_POST["username"]) : "";
$password = isset($_POST["password"])? limpiarCadena($_POST["password"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$apellidoPaterno = isset($_POST["apellidoPaterno"])? limpiarCadena($_POST["apellidoPaterno"]) : "";
$apellidoMaterno = isset($_POST["apellidoMaterno"])? limpiarCadena($_POST["apellidoMaterno"]) : "";
$fechaIngreso = isset($_POST["fechaIngreso"])? limpiarCadena($_POST["fechaIngreso"]) : "";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]) : "";
$correoElectronico = isset($_POST["correoElectronico"])? limpiarCadena($_POST["correoElectronico"]) : "";
$puesto = isset($_POST["puesto"])? limpiarCadena($_POST["puesto"]) : "";
$estado = isset($_POST["estado"])? limpiarCadena($_POST["estado"]) : "";
$delegacion = isset($_POST["delegacion"])? limpiarCadena($_POST["delegacion"]) : "";
$colonia = isset($_POST["colonia"])? limpiarCadena($_POST["colonia"]) : "";
$calle = isset($_POST["calle"])? limpiarCadena($_POST["calle"]) : "";
$numExt = isset($_POST["numExt"])? limpiarCadena($_POST["numExt"]) : "";
$numInt = isset($_POST["numInt"])? limpiarCadena($_POST["numInt"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idEmpleado)){
			$rspta = $empleado->insertar($idSucursal, $username, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaIngreso, $telefono, $correoElectronico, $puesto, $estado, $delegacion, $colonia, $calle, $numExt, $numInt);
			echo $rspta ? "empleado guardado" : "empleado no se pudo guardar";
		} else {
			$rspta = $empleado->editar($idEmpleado, $idSucursal, $username, $password, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaIngreso, $telefono, $correoElectronico, $puesto, $estado, $delegacion, $colonia, $calle, $numExt, $numInt);
			echo $rspta ? "empleado editado" : "empleado no se pudo editar";
		}
		break;
	case 'unactivate':
		$rspta = $empleado->desactivar($idEmpleado);
		echo $rspta ? "empleado desactivado" : "empleado no se pudo desactivar";
		break;
	case 'activate':
		$rspta = $empleado->activar($idEmpleado);
		echo $rspta ? "empleado activado" : "empleado no se pudo activar";
		break;
	case 'delete':
		$rspta = $empleado->eliminar($idEmpleado);
		echo $rspta ? "empleado eliminado" : "empleado no se pudo eliminar";
		break;
	case 'show':
		$rspta = $empleado->mostrar($idEmpleado);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $empleado->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = Array(
				/*$reg->idEmpleado*/
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idEmpleado.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idEmpleado.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idEmpleado.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idEmpleado.')"><i class="fa fa-check"></i></button>',
				"1" => $reg->sucursal,
				"2" => $reg->nombre,
				"3" => $reg->apellidoPaterno,
				"4" => $reg->apellidoMaterno,
				"5" => $reg->username,
				"6" => $reg->password,
				"7" => $reg->fechaIngreso,
				"8" => $reg->telefono,
				"9" => $reg->correoElectronico,
				"10" => $reg->puesto,
				"11" => $reg->estado,
				"12" => $reg->delegacion,
				"13" => $reg->colonia,
				"14" => $reg->calle,
				"15" => $reg->numExt,
				"16" => $reg->numInt,
				"17" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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
	case 'selectSucursal':
		require_once "../modelos/Sucursal.php";
		$sucursal = new Sucursal();
		$rspta = $sucursal->select();
		while($reg = $rspta->fetch_object()){
			echo '<option value='.$reg->idSucursal.'>'. $reg->nombre.' - '. $reg->franquicia .'</option>';
		}
		break;
}

?>