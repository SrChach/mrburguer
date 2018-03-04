<?php 
require_once "../modelos/Cliente.php";

$cliente = new Cliente();

$idcliente = isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$apellidoPaterno = isset($_POST["apellidoPaterno"])? limpiarCadena($_POST["apellidoPaterno"]) : "";
$apellidoMaterno = isset($_POST["apellidoMaterno"])? limpiarCadena($_POST["apellidoMaterno"]) : "";
$fechaNacimiento = isset($_POST["fechaNacimiento"])? limpiarCadena($_POST["fechaNacimiento"]) : "";
$cuentaFB = isset($_POST["cuentaFB"])? limpiarCadena($_POST["cuentaFB"]) : "";
$cuentaInstagram = isset($_POST["cuentaInstagram"])? limpiarCadena($_POST["cuentaInstagram"]) : "";
$cuentaTwitter = isset($_POST["cuentaTwitter"])? limpiarCadena($_POST["cuentaTwitter"]) : "";
$correoElectronico = isset($_POST["correoElectronico"])? limpiarCadena($_POST["correoElectronico"]) : "";
$telefono = isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idcliente)){
			$rspta = $cliente->insertar($nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $cuentaFB, $cuentaInstagram, $cuentaTwitter, $correoElectronico, $telefono);
			echo $rspta ? "Cliente guardado" : "Cliente no se pudo guardar";
		} else {
			$rspta = $cliente->editar($idcliente, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $cuentaFB, $cuentaInstagram, $cuentaTwitter, $correoElectronico, $telefono);
			echo $rspta ? "Cliente editado" : "Cliente no se pudo editar";
		}
		break;
	case 'unactivate':
		$rspta = $cliente->desactivar($idcliente);
		echo $rspta ? "Cliente desactivado" : "Cliente no se pudo desactivar";
		break;
	case 'activate':
		$rspta = $cliente->activar($idcliente);
		echo $rspta ? "Cliente activado" : "Cliente no se pudo activar";
		break;
	case 'show':
		$rspta = $cliente->mostrar($idcliente);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $cliente->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idcliente.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idcliente.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idcliente.')"><i class="fa fa-check"></i></button>',
				"1" => $reg->nombre,
				"2" => $reg->apellidoPaterno,
				"3" => $reg->apellidoMaterno,
				"4" => $reg->fechaNacimiento,
				"5" => $reg->fechaRegistro,
				"6" => $reg->nivel,
				"7" => $reg->cuentaFB,
				"8" => $reg->cuentaInstagram,
				"9" => $reg->cuentaTwitter,
				"10" => $reg->correoElectronico,
				"11" => $reg->telefono,
				"12" => $reg->isActive ?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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