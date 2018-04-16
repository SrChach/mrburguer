<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['sucursales']==1){
?>

			<div class="content-wrapper">				
				<section class="content">
					<div class="row">
						<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h1 class="box-title">Franquicias - Estadísticas</h1>
										<div class="box-tools pull-right">
										</div>
									
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
														<th>Franquicia</th>
														<th>Ventas Realizadas</th>
														<th>Total Vendido</th>
														<th>Empleados de la Franquicia</th>
														<th>Sucursales de la Franquicia</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Franquicia</th>
														<th>Ventas Realizadas</th>
														<th>Total Vendido</th>
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
		<script type="text/javascript">
			$("#tbllistado").hide();
			$("#formulario").on("submit",function(e){
				e.preventDefault();
				$("#tbllistado").show();
				listar();
			});
		</script>

<?php 
	}
	ob_end_flush();
?>
