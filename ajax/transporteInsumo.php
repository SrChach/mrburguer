<?php 
if(strlen(session_id()) < 1)
	session_start();
require_once "../modelos/TransporteInsumo.php";

$transporte = new TransporteInsumo();

$idTransporteInsumo = isset($_POST["idTransporteInsumo"])? limpiarCadena($_POST["idTransporteInsumo"]) : "";
$idInsumoEnSucursal = isset($_POST["idInsumoEnSucursal"])? limpiarCadena($_POST["idInsumoEnSucursal"]) : "";
$idEmpleadoRecibe = $_SESSION["idEmpleado"];
$miSucursal = $_SESSION["idSucursal"];
$idSucursal = isset($_POST["idSucursal"])? limpiarCadena($_POST["idSucursal"]) : "";
$cantidadPedida = isset($_POST["cantidadPedida"])? limpiarCadena($_POST["cantidadPedida"]) : "";
$cantidadEnviada = isset($_POST["cantidadEnviada"])? limpiarCadena($_POST["cantidadEnviada"]) : "";
$cantidadRecibida = isset($_POST["cantidadRecibida"])? limpiarCadena($_POST["cantidadRecibida"]) : "";


switch ($_GET["op"]){
	case 'request':
		$rspta = $transporte->pedir($_POST["idInsumoEnSucursal"], $_POST["cantidadPedida"]);
		echo $rspta ? "Petición realizada" : "No se pudo hacer la petición";
		break;
	case 'send':
		$rspta = $transporte->enviar($_POST['idTransporteInsumo'], $_POST['idInsumoEnSucursal'], $_POST['cantidadEnviada']);
		echo $rspta ? "Elementos enviados" : "No se pudo enviar";
		break;
	case 'receive':
		$rspta = $transporte->recibir($_POST['idTransporteInsumo'], $_POST['cantidadRecibida'], $idEmpleadoRecibe, $_POST['observaciones']);
		echo $rspta ? "Recepción confirmada" : "No se pudieron registrar los cambios";
		break;

	/*Hasta aqui Me quedé
	case 'listOptions':
		$rspta = $transporte->paraPedir($idSucursal);
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$temp = '<button class="btn btn-success" onclick="saveEdit('.$reg->idInsumoEnSucursal.','.$reg->idSucursal.',c'.$i.')">Registrar en Sucursal</button>';
				$campo = '<input type="number" min="0" max="999999999.99" class="form-control" placeholder="Inserte cantidad inicial" id="c'.$i.'" step=".01">';
				$data[] = array(
					"0" => ($reg->status=='Entregado') ? '<button class="btn btn-primary" onclick="showOne('.$reg->idVenta.')"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="giveBack('.$reg->idVenta.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idVenta.')"><i class="fa fa-eye"></i></button>' ,
					"1" => $reg->fecha,
					"2" => $reg->nombreEmpleado,
					"3" => $reg->montoTotal,
					"4" => $reg->descuentoActual,
					"5" => ($reg->pagoTarjeta=='0') ? "Efectivo" : "Tarjeta",
					"6" => ($reg->status=='Entregado') ? '<span class="label bg-green">Entregado<span>':'<span class="label bg-red">Devuelto<span>' 
				);
			}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;*/
	case 'listPES':
		require_once "../modelos/PES.php";
		$pes = new PES();
		$xst = ($pes->check($idSucursal))->fetch_object();
		if($xst->exist==0){
			echo "Sucursal inválida";
			break;
		}
		$rspta = $pes->listarPES($idSucursal);
		$data = Array();
		while($reg = $rspta->fetch_object()){
			$data[] = array(
				"0" => '<button class="btn btn-warning" onclick="agregarProducto('.$reg->idProducto.', \''.$reg->nombre.'\', precio'.$reg->idProducto.')"><span class="fa fa-plus"></span></button>',
				"1" => $reg->nombre,
				"2" => "<img src='../files/productos/".$reg->imagen."' height='70px' width='70px'/>",
				"3" => '<span id="precio'.$reg->idProducto.'">'.$reg->precioActual.'</span>'
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