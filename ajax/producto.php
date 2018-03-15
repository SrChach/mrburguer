<?php 
require_once "../modelos/Producto.php";

$producto = new Producto();

$idproducto = isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$precioActual = isset($_POST["precioActual"])? limpiarCadena($_POST["precioActual"]) : "";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$imagen = $_POST["imagenactual"];
		} else {
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if(($_FILES['imagen']['type'] == "image/jpg") || ($_FILES['imagen']['type'] == "image/jpeg") || ($_FILES['imagen']['type'] == "image/png")){
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/productos/" . $imagen);
			}
		}


		if(empty($idproducto)){
			$rspta = $producto->insertar($nombre, $precioActual, $imagen);
			echo $rspta ? "Producto guardado" : "Producto no se pudo guardar";
		} else {
			$rspta = $producto->editar($idproducto, $nombre, $precioActual, $imagen);
			echo $rspta ? "Producto editado" : "Producto no se pudo editar";
		}
		break;
	case 'unactivate':
		$rspta = $producto->desactivar($idproducto);
		echo $rspta ? "Producto desactivado" : "Producto no se pudo desactivar";
		break;
	case 'activate':
		$rspta = $producto->activar($idproducto);
		echo $rspta ? "Producto activado" : "Producto no se pudo activar";
		break;
	case 'show':
		$rspta = $producto->mostrar($idproducto);
		echo json_encode($rspta);
		break;
	case 'list':
		$rspta = $producto->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				/* $reg->idproducto */
				"0" => ($reg->isActive)?'<button class="btn btn-primary" onclick="showOne('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="unactivate('.$reg->idproducto.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="activate('.$reg->idproducto.')"><i class="fa fa-check"></i></button>',
				"1" => $reg->nombre,
				"2" => $reg->precioActual,
				"3" => "<img src='../files/productos/".$reg->imagen."' height='65px' width='65px'/>",
				"4" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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
	case'consultaProducto' :
		$rspta = $producto->listar();
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => $reg->nombre,
				"1" => $reg->precioActual,
				"2" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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