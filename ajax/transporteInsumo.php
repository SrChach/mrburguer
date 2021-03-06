<?php 
if(strlen(session_id()) < 1)
	session_start();
require_once "../modelos/TransporteInsumo.php";

$transporte = new TransporteInsumo();

$idEmpleadoRecibe = $_SESSION["idEmpleado"];
$miSucursal = $_SESSION["idSucursal"];
$idSucursal = isset($_GET["SUC"])? limpiarCadena($_GET["SUC"]) : "";
$idTransporteInsumo = isset($_POST["idTransporteInsumo"])? limpiarCadena($_POST["idTransporteInsumo"]) : "";
$idInsumoEnSucursal = isset($_POST["idInsumoEnSucursal"])? limpiarCadena($_POST["idInsumoEnSucursal"]) : "";
$cantidadEnviada = isset($_POST["cantidadEnviada"])? limpiarCadena($_POST["cantidadEnviada"]) : "";
$cantidadRecibida = isset($_POST["cantidadRecibida"])? limpiarCadena($_POST["cantidadRecibida"]) : "";
$observaciones = isset($_POST["observaciones"])? limpiarCadena($_POST["observaciones"]) : "";

if(session_id() == '') {
	session_start();
}
if(!isset($_SESSION["username"])){
	echo "No has iniciado sesión";
	return;
}

switch ($_GET["op"]){
	case 'request':
		$rspta = $transporte->pedir($_POST["idIES"], $_POST["cantidadPedida"], $idEmpleadoRecibe);
		echo $rspta ? "Petición realizada" : "No se pudo hacer la petición";
		break;
	case 'send':
		$rspta = $transporte->enviar($idTransporteInsumo, $idInsumoEnSucursal, $cantidadEnviada);
		echo $rspta ? "Elementos enviados" : "No se pudo enviar";
		break;
	case 'receive':
		$rspta = $transporte->recibir($idTransporteInsumo, $cantidadRecibida, $idEmpleadoRecibe, $observaciones);
		echo $rspta ? "Recepción confirmada" : "No se pudieron registrar los cambios";
		break;
	case 'sendWithoutRequest':
		$rspta = $transporte->enviarSinPeticion($_POST["idIES"], $_POST["CE"]);
		echo $rspta ? "Enviado" : "No se pudo enviar";
		break;
	case 'listOptions':
		$i = 0;
		$rspta = $transporte->paraPedir($miSucursal);
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => '<button class="btn btn-warning" onclick="agregarInsumo('.$reg->idInsumoEnSucursal.', \''.$reg->nombre.'\')"><span class="fa fa-plus"></span></button>',
					"1" => $reg->nombre
				);
				$i++;
			}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;
	case 'optionsToSend':
		$i = 0;
		$rspta = $transporte->paraPedir($idSucursal);
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => '<button class="btn btn-warning" onclick="agregarInsumo('.$reg->idInsumoEnSucursal.', \''.$reg->nombre.'\')"><span class="fa fa-plus"></span></button>',
					"1" => $reg->nombre
				);
				$i++;
			}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;
	case 'listToSend':
		$i = 0;
		$rspta = $transporte->paraPedir($idSucursal);
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => '<button class="btn btn-warning" onclick="agregarInsumo('.$reg->idInsumoEnSucursal.', \''.$reg->nombre.'\')"><span class="fa fa-plus"></span></button>',
					"1" => $reg->nombre
				);
				$i++;
			}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;
	case 'listRequests':
		$i = 0;
		$rspta = $transporte->mostrarSolicitudes($idSucursal);
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->cantidadPedida,
					"2" => '<input type="number" min="0" max="999999999" class="form-control" placeholder="Inserte cantidad a enviar" id="i'.$i.'">',
					"3" => '<button class="btn btn-success" onclick="enviarInsumo('.$reg->idTransporteInsumo.', '.$reg->idInsumoEnSucursal.', i'.$i.')">Enviar Insumo</button>'
				);
				$i++;
			}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;
	case 'listSent':
		$i = 0;
		$rspta = $transporte->confirmarRecepcion($idSucursal);
		$data = Array();
		if($rspta != false){
			$i = 0;
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->cantidadEnviada
				);
				$i++;
			}
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;
	case 'myPetitions':
		$rspta = $transporte->mostrarSolicitudes($miSucursal);
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->cantidadPedida
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
	case 'listReceived':
		$i = 0;
		$rspta = $transporte->confirmarRecepcion($miSucursal);
		$data = Array();
		if($rspta != false){
			$i = 0;
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->cantidadEnviada,
					"2" => '<input type="number" min="0" max="999999999" class="form-control" placeholder="Inserte cantidad recibida" id="i'.$i.'">',
					"3" => '<input type="text" maxlength="50" class="form-control" placeholder="Observaciones" id="o'.$i.'">',
					"4" => '<button class="btn btn-success" onclick="recibirInsumo('.$reg->idTransporteInsumo.', '.$reg->idInsumoEnSucursal.', i'.$i.', o'.$i.')">Confirmar Recibido</button>'
				);
				$i++;
			}
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;
	case 'listNeeds':
		$rspta = $transporte->sucursalesNecesitadas();
		$cadena = '';
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				if($reg->idSucursal != ""){
					$cadena = $cadena.'<div class="col-sm-12 col-md-12 notificacion"></div>';
					$cadena = $cadena.'<h5><a href="../vistas/enviar.php?SUC='.$reg->idSucursal.'">La sucursal '.$reg->nombre.' solicita insumos</a></h5>';	
				}
			}
		}
		echo $cadena;
		break;
	case 'toConfirm':
		$rspta = $transporte->porConfirmar($idEmpleadoRecibe);
		if($rspta["bandera"] != 0){
			echo '<div class="col-sm-12 col-md-12 notificacion advertencia"><a href="../vistas/recepcion.php">Han enviado insumos a tu sucursal. Confirma de recibido en cuanto lleguen</a></div>';
		}
		break;
	case 'listTransactions':
		$fechaIni = $_GET["fechaIni"];
		$fechaFin = $_GET["fechaFin"];
		$rspta = $transporte->listar($fechaIni, $fechaFin);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				if($reg->fechaEnvio && !$reg->fechaRecepcion){
					$cadena = '<span class="label bg-yellow">En_Camino<span>';
				} else if($reg->fechaRecepcion){
					$cadena = '<span class="label bg-green">Confirmado<span>';
				} else {
					$cadena = '<span class="label bg-red">Pedido<span>';
				}
				$data[] = array(
					"0" => $cadena,
					"1" => $reg->sucursal,
					"2" => $reg->insumo,
					"3" => $reg->cantidadPedida ? $reg->cantidadPedida : "n/a",
					"4" => $reg->fechaSolicitud ? $reg->fechaSolicitud : "n/a",
					"5" => $reg->cantidadEnviada,
					"6" => $reg->fechaEnvio,
					"7" => $reg->nomPila,
					"8" => $reg->cantidadRecibida,
					"9" => $reg->fechaRecepcion,
					"10" => $reg->observaciones
				);
			}
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData" => $data
		);
		echo json_encode($results);
		break;
	case 'outliers':
		if (!isset($_GET["b"]))
			break;
		$rspta = $transporte->mostrarAnomalias($_GET["fechaIni"], $_GET["fechaFin"], $_GET["b"]);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->empleadoPide ? $reg->empleadoPide : "n/a",
					"1" => $reg->empleadoRecibe,
					"2" => $reg->sucursal,
					"3" => $reg->fechaEnvio,
					"4" => $reg->fechaRecepcion,
					"5" => $reg->insumo,
					"6" => $reg->cantidadEnviada,
					"7" => $reg->cantidadRecibida,
					"8" => $reg->observaciones
				);
			}
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