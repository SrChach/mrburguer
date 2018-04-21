<?php 
require_once "../modelos/Permiso.php";

$permiso = new Permiso();

$idPermiso = isset($_POST["idPermiso"])? limpiarCadena($_POST["idPermiso"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";

if(session_id() == '') {
	session_start();
}
if(!isset($_SESSION["username"])){
	echo "No has iniciado sesión";
	return;
}

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idPermiso)){
			$rspta = $permiso->insertar($nombre);
			echo $rspta ? "Permiso guardado" : "Permiso no se pudo guardar";
		} 
		break;
	case 'list':
		$rspta = $permiso->listar();
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre
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