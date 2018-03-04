<?php 
require_once "../modelos/PES.php";

$pes = new PES();

$idproductoEnSucursal = isset($_POST["idproductoEnSucursal"])? limpiarCadena($_POST["idproductoEnSucursal"]) : "";
$idSucursal = isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]) : "";
$idProducto = isset($_POST["idProducto"])? limpiarCadena($_POST["idProducto"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		$rspta =  $pes->insertar($idProducto, $idSucursal);
		echo $rspta ? "Registrado en el menú" : "No se pudo registrar en el menú";
		break;
	case 'unactivate':
		$rspta = $pes->desactivar($idproductoEnSucursal);
		echo $rspta ? "Retirado del Menú" : "No se pudo retirar del menú";
		break;
	case 'activate':
		$rspta = $pes->activar($idproductoEnSucursal);
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
			while($reg = $rspta->fetch_object()){
				if(is_null($reg->idproductoEnSucursal)){
					$temp = '<button class="btn btn-success" onclick="saveEdit('.$reg->idProducto.','.$reg->idSucursal.')">Añadir al menú</button>';
				} else {
					if($reg->isActive==1){
						$temp = '<button class="btn btn-warning" onclick="unactivate('.$reg->idproductoEnSucursal.')">Quitar del menú</button>';
					} else {
						$temp = '<button class="btn btn-success" onclick="activate('.$reg->idproductoEnSucursal.')">Añadir al menú</button>';
					}
				}
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->precioActual,
					"2" => $temp
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