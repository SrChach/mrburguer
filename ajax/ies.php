<?php 
require_once "../modelos/IES.php";

$ies = new IES();

$idinsumoEnSucursal = isset($_POST["idinsumoEnSucursal"])? limpiarCadena($_POST["idinsumoEnSucursal"]) : "";
$idSucursal = isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]) : "";
$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		$rspta =  $ies->insertar($idInsumo, $idSucursal);
		echo $rspta ? "Insumo registrado" : "No se pudo registrar el insumo";
		break;
	case 'unactivate':
		$rspta = $ies->desactivar($idinsumoEnSucursal);
		echo $rspta ? "Insumo desactivado" : "No se pudo desactivar el insumo";
		break;
	case 'activate':
		$rspta = $ies->activar($idinsumoEnSucursal);
		echo $rspta ? "Insumo activado" : "Insumo desactivado";
		break;
	case 'list':
		if(isset($_GET["SUC"])){
			$xst = ($ies->check($_GET["SUC"]))->fetch_object();/*Comprueba si la sucursal es válida*/
			if($xst->exist==0){
				echo "Sucursal inválida";
				break;
			}
			$rspta = $ies->listar($_GET["SUC"]);
			$data = Array();
			while($reg = $rspta->fetch_object()){
				if(is_null($reg->idinsumoEnSucursal)){
					$temp = '<button class="btn btn-success" onclick="saveEdit('.$reg->idInsumo.','.$reg->idSucursal.')">Añadir insumo</button>';
				} else {
					if($reg->isActive==1){
						$temp = '<button class="btn btn-warning" onclick="unactivate('.$reg->idinsumoEnSucursal.')">Quitar insumo</button>';
					} else {
						$temp = '<button class="btn btn-success" onclick="activate('.$reg->idinsumoEnSucursal.')">Añadir insumo</button>';
					}
				}
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->marca,
					"2" => $reg->precioPromedio,
					"3" => $reg->cantidad,
					"4" => $temp
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
			$rspta = $ies->gname($_GET["SUC"]);
			echo json_encode($rspta);
		}
		break;

}
?>