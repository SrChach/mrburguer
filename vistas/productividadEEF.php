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
										<h1 class="box-title">Productividad de los empleados de la fraquicia ""</h1>
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
														<th>Nombre</th>
														<th>Sucursal</th>
														<th>Ventas Realizadas</th>
														<th>totalVendido</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Nombre</th>
														<th>Sucursal</th>
														<th>Ventas Realizadas</th>
														<th>totalVendido</th>
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
			$("#fechaIni").val(getParameterByName("fechaIni"));			
			$("#fechaFin").val(getParameterByName("fechaFin"));			
			listar();
			$("#formulario").on("submit",function(e){
				e.preventDefault();
				listar();
			});
		</script>
<?php 
	}
	ob_end_flush();
?>
