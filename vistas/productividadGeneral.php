<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['main']==1){

		require_once "../modelos/Venta.php";
		$venta = new Venta();
		$top = $venta->topN(10);
		$empleados = '';
		$totales = '';
		$backgroundColor ='';
		$cBase = Array(
			'0' =>	'rgba(255, 99, 132,',
			'1' =>	'rgba(54, 162, 235,',
			'2' =>	'rgba(255, 206, 86,',
			'3' =>	'rgba(75, 192, 192,',
			'4' =>	'rgba(153, 102, 255,',
			'5' =>	'rgba(255, 159, 64,'
		);
		$cont = 0;
		if($top != false)
			while($reg = $top->fetch_object()){
				if($cont != 0){
					$empleados = $empleados . ',';
					$totales = $totales . ',';
					$backgroundColor = $backgroundColor . ',';
				}
				$empleados = $empleados . '"' . $reg->empleado . '"';
				$totales = $totales . '"' . $reg->total . '"';
				$backgroundColor = $backgroundColor . '"' . $cBase[$cont%6] . '0.8)"';
				$cont++;
			}
?>

			<div class="content-wrapper">				
				<section class="content">
					<div class="row">
						<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h1 class="box-title">Status general - Empleados más productivos</h1><br><br>
										<div class="box-tools pull-right">
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="box box-primary">
														<div class="box-header with-border">
															Top 10 empleados con más ventas en este mes
														</div>
														<div class="box-body">
															<canvas id="topN" width="650em" height="200em"></canvas>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="box box-primary">
														<div class="box-header with-border">
															Empleados (activos & con permisos de venta) sin ventas en la última semana
														</div>
														<div class="box-body">
															
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="box box-primary">
													<br>
													<form class="row" id="formulario">
														<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
															<label for="fechaIni">Ventas desde esta fecha(a las 00:00 hrs)</label>
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
																<th>Nombre del empleado</th>
																<th>Ventas Realizadas</th>
																<th>Total Vendido</th>
															</thead>
															<tbody>
															</tbody>
															<tfoot>
																<th>Nombre del empleado</th>
																<th>Ventas Realizadas</th>
																<th>Total Vendido</th>
															</tfoot>
														</table>
													</div>
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

			var graph = document.getElementById("topN").getContext('2d');
			var fUltimaSemana = new Chart(graph, {
			    type: 'bar',
			    data: {
			        labels: [ <?php echo $empleados; ?> ],
			        datasets: [{
			            label: 'Cantidad vendida $',
			            data: [ <?php echo $totales; ?> ],
			            backgroundColor: [
			                <?php echo $backgroundColor; ?>
			            ],
			            borderColor: [
			                <?php echo $backgroundColor; ?>
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
							yAxes: [{
		                ticks: {
		                    beginAtZero:true
		                }
		            }]
			        }
			    }
			});
		</script>

<?php 
	}
	ob_end_flush();
?>
