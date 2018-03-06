<?php 
require_once "../modelos/IES.php";

$ies = new IES();

$idinsumoEnSucursal = isset($_POST["idinsumoEnSucursal"])? limpiarCadena($_POST["idinsumoEnSucursal"]) : "";
$idInsumo = isset($_POST["idInsumo"])? limpiarCadena($_POST["idInsumo"]) : "";
$idSucursal = isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]) : "";
$cantidad = isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		$rspta =  $ies->insertar($idInsumo, $idSucursal, $cantidad);
		echo $rspta ? "Insumo registrado" : "No se pudo registrar el insumo";
		break;
	case 'unactivate':
		$rspta = $ies->desactivar($idinsumoEnSucursal);
		echo $rspta ? "Insumo desactivado" : "No se pudo desactivar el insumo";
		break;
	case 'activate':
		$rspta = $ies->activar($idinsumoEnSucursal);
		echo $rspta ? "Insumo activado" : "No se pudo activar";
		break;
	case 'list':
		if(isset($_GET["SUC"])){
			$xst = ($ies->check($_GET["SUC"]))->fetch_object();
			if($xst->exist==0){
				echo "Sucursal inválida";
				break;
			}
			$rspta = $ies->listar($_GET["SUC"]);
			$data = Array();
			$i = 0;
			while($reg = $rspta->fetch_object()){
				$i++;
				if(is_null($reg->idinsumoEnSucursal)){
					$temp = '<button class="btn btn-success" onclick="saveEdit('.$reg->idInsumo.','.$reg->idSucursal.',c'.$i.')">Registrar en Sucursal</button>';
					$campo = '<input type="number" min="0" max="999999999.99" class="form-control" placeholder="Inserte cantidad inicial" id="c'.$i.'" step=".01">';
				} else {
					$campo = '<input type="number" class="form-control" value="'.$reg->cantidad.'" step=".01" disabled>';
					if($reg->isActive==1){
						$temp = '<button class="btn btn-warning" onclick="unactivate('.$reg->idinsumoEnSucursal.')">Desactivar</button>';
					} else {
						$temp = '<button class="btn btn-success" onclick="activate('.$reg->idinsumoEnSucursal.')">Añadir</button>';
					}
				}
				
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->marca,
					"2" => $reg->precioPromedio,
					"3" => $campo,
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
	case 'consultaIES':
		if(isset($_GET["SUC"])){
			$xst = ($ies->check($_GET["SUC"]))->fetch_object();
			if($xst->exist==0){
				echo "Sucursal inválida";
				break;
			}
			$rspta = $ies->listar($_GET["SUC"]);
			$data = Array();
			$i = 0;
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->marca,
					"2" => $reg->precioPromedio,
					"3" => $cantidad ? $cantidad : "no registrado"
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
}
?>