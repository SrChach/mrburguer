<?php 
if(strlen(session_id()) < 1)
	session_start();
require_once "../modelos/Venta.php";

$venta = new Venta();

$idventa = isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]) : "";
$idCliente = isset($_POST["idCliente"])? limpiarCadena($_POST["idCliente"]) : "";
$idEmpleado = $_SESSION["idEmpleado"];
$fecha = isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]) : "";
$montoTotal = isset($_POST["montoTotal"])? limpiarCadena($_POST["montoTotal"]) : "";
$iva = isset($_POST["iva"])? limpiarCadena($_POST["iva"]) : "";
$descuentoTotal = isset($_POST["descuentoTotal"])? limpiarCadena($_POST["descuentoTotal"]) : "";
$status = isset($_POST["status"])? limpiarCadena($_POST["status"]) : "";
$pagoTarjeta = isset($_POST["pagoTarjeta"])? limpiarCadena($_POST["pagoTarjeta"]) : "";
$idSucursal = $_SESSION["idSucursal"];

switch ($_GET["op"]){
	case 'saveEdit':
		if(empty($idventa)){

			$rspta = $venta->insertar($idCliente, $idEmpleado, $pagoTarjeta, $_POST["idProductoEnSucursal"], $_POST["cantidad"]);
			echo $rspta ? "Venta guardada" : "No se pudieron registrar todos los datos de la venta";
		} 
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
		$rspta = $venta->listar();
		$data = Array();
		if($rspta != false)
			while($reg = $rspta->fetch_object()){
				$data[] = array(
					"0" => ($reg->status=='Entregado') ? '<button class="btn btn-primary" onclick="showOne('.$reg->idventa.')"><i class="fa fa-eye"></i></button>&nbsp;&nbsp;<button class="btn btn-danger" onclick="giveBack('.$reg->idventa.')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-primary" onclick="showOne('.$reg->idventa.')"><i class="fa fa-eye"></i></button>' ,
					"1" => $reg->fecha,
					"2" => $reg->nombreEmpleado,
					"3" => ($reg->nombreCliente)? $reg->nombreCliente : '-',
					"4" => $reg->montoTotal,
					"5" => $reg->descuentoActual,
					"6" => $reg->iva,
					"7" => ($reg->pagoTarjeta=='0') ? "Efectivo" : "Tarjeta",
					"8" => ($reg->status=='Entregado') ? '<span class="label bg-green">Entregado<span>':'<span class="label bg-red">Devuelto<span>' 
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
				"0" => '<button class="btn btn-warning" onclick="agregarProducto('.$reg->idproductoEnSucursal.', \''.$reg->nombre.'\', precio'.$reg->idproductoEnSucursal.')"><span class="fa fa-plus"></span></button>',
				"1" => $reg->nombre,
				"2" => "<img src='../files/productos/".$reg->imagen."' height='70px' width='70px'/>",
				"3" => '<span id="precio'.$reg->idproductoEnSucursal.'">'.$reg->precioActual.'</span>'
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