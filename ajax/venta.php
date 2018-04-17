<?php 
if(strlen(session_id()) < 1)
	session_start();
require_once "../modelos/Venta.php";

$venta = new Venta();

$idventa = isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]) : "";
$idCliente = isset($_POST["idCliente"])? limpiarCadena($_POST["idCliente"]) : "";
$idEmpleado = $_SESSION["idEmpleado"];
$idSucursal = $_SESSION["idSucursal"];
$fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]) : "";
$montoTotal = isset($_POST["montoTotal"])? limpiarCadena($_POST["montoTotal"]) : "";
$descuentoTotal = isset($_POST["descuentoTotal"])? limpiarCadena($_POST["descuentoTotal"]) : "";
$status = isset($_POST["status"])? limpiarCadena($_POST["status"]) : "";
$pagoTarjeta = isset($_POST["pagoTarjeta"])? limpiarCadena($_POST["pagoTarjeta"]) : "";

switch ($_GET["op"]){
	case 'saveEdit':
		$rspta = $venta->insertar($idEmpleado, $pagoTarjeta, $idSucursal, $_POST["idProducto"], $_POST["cantidad"]);
		echo $rspta ? "Venta guardada" : "No se pudieron registrar todos los datos de la venta";
		break;
	case 'giveBack':
		$rspta = $venta->devolver($idventa);
		echo $rspta ? "Venta anulada" : "Venta no pudo anularse";
		break;
	case 'show':
		$rspta = $venta->mostrar($idventa);
		echo json_encode($rspta);
		break;
	case 'listElement':
		$id = $_GET["vt"];
		$tmp = 0;
		$rspta = $venta->listarProductos($id);
		echo '	<thead style=\'background-color: #A9D0F5\'>
					<th>Opciones</th>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio Unitario</th>
					<th>Subtotal</th>
					<th></th>
				</thead>';
		while($reg = $rspta->fetch_object()){
			echo '<tr class=\'filas\'>
			<td></td>
			<td>'.$reg->nombre.'</td>
			<td>'.$reg->cantidad.'</td>
			<td>'.$reg->precioVendido.'</td>
			<td>'.($reg->cantidad * $reg->precioVendido).'</td>
			<td></td>
			</tr>';
			$tmp += ($reg->cantidad * $reg->precioVendido);
		}
		echo '	<tfoot>
					<th>TOTAL</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th><h4 id=\'total\'>$ '.$tmp.'</h4></th>
				</tfoot>';
		break;
	case 'list':
		$rspta = $venta->listar($idEmpleado);
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
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
		break;
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
	case 'productivityEmployeeInBranch':
		$rspta = $venta->prodEmpleadoEnSucursal($_GET["SUC"], $_GET["fechaIni"], $_GET["fechaFin"]);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->ventasRealizadas,
					"2" => $reg->totalVendido
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
	case 'productivityEmployeeInFranchise':/**/
		$rspta = $venta->prodEmpleadoEnFranquicia($_GET["FR"], $_GET["fechaIni"], $_GET["fechaFin"]);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->sucursal,
					"2" => $reg->ventasRealizadas,
					"3" => $reg->totalVendido
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
	case 'productivityAllEmployees':
		$rspta = $venta->prodEmpleadoGeneral($_GET["fechaIni"], $_GET["fechaFin"]);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->ventasRealizadas,
					"2" => $reg->totalVendido
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
	case 'productivityBranchInFranchise':
		$rspta = $venta->prodSucursalEnFranquicia($_GET["FR"], $_GET["fechaIni"], $_GET["fechaFin"]);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombreSucursal,
					"1" => $reg->ventasRealizadas,
					"2" => $reg->totalVendido,
					"3" => '<a href="productividadEES.php?SUC='.$reg->idSucursal.'&fechaIni='.$_GET["fechaIni"].'&fechaFin='.$_GET["fechaFin"].'"><button class="btn btn-primary">Ventas por Empleado</button></a>'
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
	case 'productivityAllFranchises':
		$rspta = $venta->prodFranquiciaGeneral($_GET["fechaIni"], $_GET["fechaFin"]);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombreFranquicia,
					"1" => $reg->ventasRealizadas,
					"2" => $reg->totalVendido,
					"3" => '<a href="masVendidos.php?FR='.$reg->idFranquicia.'&fechaIni='.$_GET["fechaIni"].'&fechaFin='.$_GET["fechaFin"].'"><button class="btn btn-primary">Más Vendidos</button></a>',
					"4" => '<a href="productividadEEF.php?FR='.$reg->idFranquicia.'&fechaIni='.$_GET["fechaIni"].'&fechaFin='.$_GET["fechaFin"].'"><button class="btn btn-primary">Ver productividad</button></a>',
					"5" => '<a href="productividadSEF.php?FR=' . $reg->idFranquicia . '&fechaIni='.$_GET["fechaIni"].'&fechaFin='.$_GET["fechaFin"].'"><button class="btn btn-primary">Ver productividad</button></a>'
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
	case 'bestSeller':
		$rspta = $venta->productosMasVendidos($_GET["FR"], $_GET["fechaIni"], $_GET["fechaFin"]);
		$data = Array();
		if($rspta != false){
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => $reg->nombre,
					"1" => $reg->totalVendido
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