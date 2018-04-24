<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['main']==1){

		//Datos para el gráfico de barras de las franquicias
		require_once "../modelos/Venta.php";
		$consulta = new Venta();
		$consultaPorMes = $consulta->prodUltimosMeses(3);
		$franquiciasPM = '';
		$totalesPM = '';
		$backgroundColorPM =''; 
		$borderColorPM = '';
		$cBase = Array(
			'0' =>	'rgba(255, 99, 132,',
			'1' =>	'rgba(54, 162, 235,',
			'2' =>	'rgba(255, 206, 86,',
			'3' =>	'rgba(75, 192, 192,',
			'4' =>	'rgba(153, 102, 255,',
			'5' =>	'rgba(255, 159, 64,'
		);
		$cont = 0;
		if($consultaPorMes != false)
			while($actual = $consultaPorMes->fetch_object()){
				if($cont != 0){
					$franquiciasPM = $franquiciasPM . ',';
					$totalesPM = $totalesPM . ',';
					$backgroundColorPM = $backgroundColorPM . ',';
					$borderColorPM = $borderColorPM . ',';
				}
				$totalesPM = $totalesPM . '"' . $actual->totalVendido . '"';
				$franquiciasPM = $franquiciasPM . '"' . $actual->franquicia . '"';
				$backgroundColorPM = $backgroundColorPM . '"' . $cBase[$cont%6] . '0.8)"';
				$borderColorPM = $borderColorPM . '"' . $cBase[$cont] . '0.8)"';
				$cont++;
			}
		
		$consultaPorDia = $consulta->prodUltimosDias(3);
		$franquiciasPD = '';
		$totalesPD = '';
		$backgroundColorPD =''; 
		$borderColorPD = '';
		$cont = 0;
		if($consultaPorDia != false)
			while($reg = $consultaPorDia->fetch_object()){
				if($cont != 0){
					$franquiciasPD = $franquiciasPD . ',';
					$totalesPD = $totalesPD . ',';
					$backgroundColorPD = $backgroundColorPD . ',';
					$borderColorPD = $borderColorPD . ',';
				}
				$totalesPD = $totalesPD . '"' . $reg->totalVendido . '"';
				$franquiciasPD = $franquiciasPD . '"' . $reg->franquicia . '"';
				$backgroundColorPD = $backgroundColorPD . '"' . $cBase[$cont%6] . '0.8)"';
				$borderColorPD = $borderColorPD . '"' . $cBase[$cont] . '0.8)"';
				$cont++;
			}										
?>

			<div class="content-wrapper">				
				<section class="content">
					<div class="row">
						<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										
										<div class="box-tools pull-right">
										</div>
										<h1 class="box-title">Rendimiento :</h1><br><br>
										<div class="panel-body">
												<div class="row">
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="box box-primary">
														<div class="box-header with-border">
															Ventas por franquicia de los últimos 3 meses(en pesos)
														</div>
														<div class="box-body">
															<canvas id="fUltimoMes" width="400" height="300"></canvas>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="box box-primary">
														<div class="box-header with-border">
															Ventas por franquicia en la última semana(en pesos)
														</div>
														<div class="box-body">
															<canvas id="fUltimaSemana" width="400" height="300"></canvas>
														</div>
													</div>
												</div>
												</div>
										</div>
											
										<hr/>
										<h1 class="box-title">Todas las Franquicias - Estadísticas de Venta :</h1><p>(tabla de abajo)</p>
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

			var ctx = document.getElementById("fUltimoMes").getContext('2d');
			var fUltimoMes = new Chart(ctx, {
			    type: 'doughnut',
			    data: {
			        labels: [ <?php echo $franquiciasPM; ?> ],
			        datasets: [{
			            label: 'Cantidad vendida $',
			            data: [ <?php echo $totalesPM; ?> ],
			            backgroundColor: [
			                <?php echo $backgroundColorPM; ?>
			            ],
			            borderColor: [
			                <?php echo $borderColorPM; ?>
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            
			        }
			    }
			});

			var graph = document.getElementById("fUltimaSemana").getContext('2d');
			var fUltimaSemana = new Chart(graph, {
			    type: 'pie',
			    data: {
			        labels: [ <?php echo $franquiciasPD; ?> ],
			        datasets: [{
			            label: 'Cantidad vendida $',
			            data: [ <?php echo $totalesPD; ?> ],
			            backgroundColor: [
			                <?php echo $backgroundColorPD; ?>
			            ],
			            borderColor: [
			                <?php echo $borderColorPD; ?>
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {

			        }
			    }
			});
		</script>

<?php 
	}
	ob_end_flush();
?>
