<?php 
require_once "../modelos/Producto.php";

$producto = new Producto();

$idproducto = isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]) : "";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]) : "";
$precioActual = isset($_POST["precioActual"])? limpiarCadena($_POST["precioActual"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idproducto)){
			$rspta = $producto->insertar($nombre, $precioActual);
			echo $rspta ? "Producto guardado" : "Producto no se pudo guardar";
		} else {
			$rspta = $producto->editar($idproducto, $nombre, $precioActual);
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
				/* $reg->isActive */
				"3" => ($reg->isActive)?'<span class="label bg-green">Activo<span>':'<span class="label bg-red">Desactivado<span>'
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