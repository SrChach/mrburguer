<?php 
session_start();
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
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]) : "";
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
		if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$imagen = $_POST["imagenactual"];
		} else {
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if(($_FILES['imagen']['type'] == "image/jpg") || ($_FILES['imagen']['type'] == "image/jpeg") || ($_FILES['imagen']['type'] == "image/png")){
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/empleados/" . $imagen);
			}
		}
		$hashpass = hash("SHA256", $password);	

		if(empty($idEmpleado)){
			$rspta = $empleado->insertar($idSucursal, $username, $hashpass, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaIngreso, $imagen, $telefono, $correoElectronico, $puesto, $estado, $delegacion, $colonia, $calle, $numExt, $numInt, $_POST["permiso"]);
			echo $rspta ? "empleado guardado" : "no se pudieron registrar todos los datos del empleado";
		} else {
			$rspta = $empleado->editar($idEmpleado, $idSucursal, $username, $hashpass, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaIngreso, $imagen, $telefono, $correoElectronico, $puesto, $estado, $delegacion, $colonia, $calle, $numExt, $numInt, $_POST["permiso"]);
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
		echo $rspta ? "empleado eliminado" : "No se puede eliminar debido a que tiene registros asignados. Pruebe desactivándolo";
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
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idEmpleado.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idEmpleado.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idEmpleado.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idEmpleado.')"><i class="fa fa-check"></i></button>',
				"1" => $reg->sucursal,
				"2" => $reg->nombre,
				"3" => $reg->apellidoPaterno,
				"4" => $reg->apellidoMaterno,
				"5" => $reg->fechaIngreso,
				"6" => $reg->telefono,
				"7" => $reg->correoElectronico,
				"8" => $reg->puesto,
				"9" => $reg->estado,
				"10" => $reg->delegacion,
				"11" => $reg->colonia,
				"12" => $reg->calle,
				"13" => $reg->numExt,
				"14" => $reg->numInt,
				"15" => "<img src='../files/empleados/".$reg->imagen."' height='50px' width='50px'/>",
				"16" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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
	case 'listPermiso':
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtenemos los permisos asignados al usuario
		$id = $_GET["uid"];
		$marcados = $empleado->listarMarcados($id);
		$permisosAsignados = array();

		while($temp = $marcados->fetch_object()){
			array_push($permisosAsignados, $temp->idPermiso);
		}

		while($reg = $rspta->fetch_object()){
			$attr = in_array($reg->idPermiso, $permisosAsignados) ? "checked" : ""; 
			echo '<li><input type="checkbox" '.$attr.' name="permiso[]" value="'.$reg->idPermiso.'"/>'.$reg->nombre.'</li>';
		}
		break;
	case 'access':
		$username = $_POST["username"];
		$password = $_POST["password"];
		$hashpass = hash("SHA256", $password);

		$rspta = $empleado->verificar($username, $hashpass); 
		if($rspta != false){
			$oa = $rspta->fetch_object();
		}
		if(isset($oa)){
			$_SESSION["idEmpleado"]=$oa->idEmpleado;
			$_SESSION["username"] = $oa->username;
			$_SESSION["nombre"]=$oa->nombre;
			$_SESSION["imagen"]=$oa->imagen;

			$ptemp = $empleado->listarMarcados($oa->idEmpleado);
			
			$permisosAsignados = array();

			while($tmp = $ptemp->fetch_object()){
				array_push($permisosAsignados, $tmp->idPermiso);
			}

			in_array(1, $permisosAsignados) ? $_SESSION['main']=1 : $_SESSION['main']=0; 
			in_array(2, $permisosAsignados) ? $_SESSION['inventarioCentral']=1 : $_SESSION['inventarioCentral']=0; 
			in_array(3, $permisosAsignados) ? $_SESSION['sucursales']=1 : $_SESSION['sucursales']=0; 
			in_array(4, $permisosAsignados) ? $_SESSION['control']=1 : $_SESSION['control']=0; 
			in_array(5, $permisosAsignados) ? $_SESSION['empleado']=1 : $_SESSION['empleado']=0; 
			in_array(6, $permisosAsignados) ? $_SESSION['productos']=1 : $_SESSION['productos']=0; 
			in_array(7, $permisosAsignados) ? $_SESSION['socialMedia']=1 : $_SESSION['socialMedia']=0; 

		}

		echo json_encode($oa);
		break;

	case 'exit':
		/*Limpiamos las variables*/
		session_unset();
		session_destroy();
		header("location: ../index.php");
		break;

	case 'consultaEmpleado':
		$rspta = $empleado->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = Array(
				"0" => $reg->sucursal,
				"1" => $reg->nombre,
				"2" => $reg->apellidoPaterno,
				"3" => $reg->apellidoMaterno,
				"4" => $reg->fechaIngreso,
				"5" => $reg->telefono,
				"6" => $reg->correoElectronico,
				"7" => $reg->puesto,
				"8" => $reg->estado,
				"9" => $reg->delegacion,
				"10" => $reg->colonia,
				"11" => $reg->calle,
				"12" => $reg->numExt,
				"13" => $reg->numInt,
				"14" => "<img src='../files/empleados/".$reg->imagen."' height='50px' width='50px'/>",
				"15" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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