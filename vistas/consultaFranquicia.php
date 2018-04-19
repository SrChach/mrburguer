<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['main']==1){

		//Datos para el gráficod e barras de las franquicias
		require_once "../modelos/venta.php";
		$consulta = new Venta();
		$consultaUnMes = $consulta->prodUltimoMes();
		$franquicias = '';
		$totales = '';
		$backgroundColor =''; 
		$borderColor = '';
		$cBase = Array(
			'0' =>	'rgba(255, 99, 132,',
			'1' =>	'rgba(54, 162, 235,',
			'2' =>	'rgba(255, 206, 86,',
			'3' =>	'rgba(75, 192, 192,',
			'4' =>	'rgba(153, 102, 255,',
			'5' =>	'rgba(255, 159, 64,'
		);
		$cont = 0;
		if($consultaUnMes != false)
			while($actual = $consultaUnMes->fetch_object()){
				if($cont != 0){
					$franquicias = $franquicias . ',';
					$totales = $totales . ',';
					$backgroundColor = $backgroundColor . ',';
					$borderColor = $borderColor . ',';
				}
				$totales = $totales . '"' . $actual->totalVendido . '"';
				$franquicias = $franquicias . '"' . $actual->franquicia . '"';
				$backgroundColor = $backgroundColor . '"' . $cBase[$cont] . '0.2)"';
				$borderColor = $borderColor . '"' . $cBase[$cont] . '1)"';
				$cont++;
			}
			//echo $totales;
			//echo $franquicias;
													
?>

			<div class="content-wrapper">				
				<section class="content">
					<div class="row">
						<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h1 class="box-title">Todas las Franquicias - Estadísticas de Venta</h1><br><br>
										<div class="box-tools pull-right">
										</div>
									
										<form class="row" id="formulario">
											<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
												<label for="fechaIni">Desde esta fecha(a las 00:00 hrs)</label>
												<input class="form-control" type="date" id="fechaIni" name="fechaIni" required/>
											</div>
											<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
												<label for="fechaFin">Hasta esta fecha(a las 12:59 hrs)</label>
												<input class="form-control" type="date" id="fechaFin" name="fechaFin" required/>
											</div>
											<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
												<br>
												<button class="btn btn-success" type="submit">Ver</button>
											</div>
										</form>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>Franquicia</th>
														<th>Ventas Realizadas</th>
														<th>Total Vendido</th>
														<th>Productos</th>
														<th>Empleados de la Franquicia</th>
														<th>Sucursales de la Franquicia</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Franquicia</th>
														<th>Ventas Realizadas</th>
														<th>Total Vendido</th>
														<th>Productos</th>
														<th>Empleados de la Franquicia</th>
														<th>Sucursales de la Franquicia</th>
													</tfoot>
												</table>
										</div>
									</div>
									<div class="panel-body">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="box box-primary">
												<div class="box-header with-border">
													Ventas por franquicia del último mes
												</div>
												<div class="box-body">
													<?php 
														echo $totales; 
														echo $franquicias;
														echo $backgroundColor;
														echo $borderColor;
													?>
													<canvas id="compras" width="400" height="300"></canvas>
												</div>
											</div>
										</div>
									</div>
									<!--Fin centro -->
								</div><!-- /.box -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>
		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>
		<script type="text/javascript" src="../public/lib/js/Chart.min.js"></script>
		<script type="text/javascript" src="../public/lib/js/Chart.bundle.min.js"></script>
		<script type="text/javascript">
			inicializarEstadisticas();
			$("#formulario").on("submit",function(e){
				e.preventDefault();
				listar();
			});

			
		</script>

<?php 
	}
	ob_end_flush();
?>
