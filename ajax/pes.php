<?php 
require_once "../modelos/PES.php";

$pes = new PES();

$idSucursal = isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]) : "";
$idProducto = isset($_POST["idProducto"])? limpiarCadena($_POST["idProducto"]) : "";

if(session_id() == '') {
	session_start();
}
if(!isset($_SESSION["username"])){
	echo "No has iniciado sesión";
	return;
}

switch ($_GET["op"]){
	case 'saveEdit':
		$rspta =  $pes->insertar($idProducto, $idSucursal);
		echo $rspta ? "Registrado en el menú" : "No se pudo registrar en el menú";
		break;
	case 'unactivate':
		$rspta = $pes->desactivar($idProducto, $idSucursal);
		echo $rspta ? "Retirado del Menú" : "No se pudo retirar del menú";
		break;
	case 'activate':
		$rspta = $pes->activar($idProducto, $idSucursal);
		echo $rspta ? "Añadido al Menú" : "No se pudo añadir al menú";
		break;
	case 'list':
		if(isset($_GET["SUC"])){
			$xst = ($pes->check($_GET["SUC"]))->fetch_object();
			if($xst->exist==0){
				echo "Sucursal inválida";
				break;
			}
			$rspta = $pes->listar($_GET["SUC"]);
			$data = Array();
			if($rspta != false)
				while($reg = $rspta->fetch_object()){
					if(is_null($reg->idProductoEnSucursal)){
						$temp = '<button class="btn btn-success" onclick="saveEdit('.$reg->idProducto.','.$reg->idSucursal.')">Añadir al menú</button>';
					} else {
						if($reg->isActive==1){
							$temp = '<button class="btn btn-warning" onclick="unactivate('.$reg->idProducto.', '.$reg->idSucursal.')">Quitar del menú</button>';
						} else {
							$temp = '<button class="btn btn-success" onclick="activate('.$reg->idProducto.', '.$reg->idSucursal.')">Añadir al menú</button>';
						}
					}
					$data[] = array(
						"0" => $reg->nombre,
						"1" => $reg->precioActual,
						"2" => "<img src='../files/productos/".$reg->imagen."' height='65px' width='65px'/>",
						"3" => $temp
					);
				}
			$results = array(
				"sEcho" => 1,
				"iTotalRecords" => count($data),
				"iTotalDisplayRecords" => count($data),
				"aaData" => $data
			);
			
			echo json_encode($results);
		} else {
			echo "No es posible listar, faltan parámetros";
		}
		break;
	case 'gname':
		if(isset($_GET["SUC"])){
			$rspta = $pes->gname($_GET["SUC"]);
			echo json_encode($rspta);
		}
		break;

}


?>