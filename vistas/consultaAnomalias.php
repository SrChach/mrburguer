<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['main']==1){
?>

			<div class="content-wrapper">				
				<section class="content">
					<div class="row">
						<div class="col-md-12">
								<div class="box">
									<div class="box-header with-border">
										<h1 class="box-title">Incidentes en el transporte de insumos</h1><br><br>
										<form class="row" id="formulario">
											<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
												<label for="fechaIni">Ventas desde esta fecha(a las 00:00 hrs)</label>
												<input class="form-control" type="date" id="fechaIni" name="fechaIni" required/>
											</div>
											<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
												<label for="fechaFin">Hasta esta fecha(a las 12:59 hrs)</label>
												<input class="form-control" type="date" id="fechaFin" name="fechaFin" required/>
											</div>
											<div class="form-group selectpicker col-lg-4 col-md-7 col-sm-7 col-xs-12">
												<label for="b">Obtener por</label>
												<select class="form-control" id="b" name="b" required>
													<option value="0" selected>Cantidades enviadas &ne; Cantidades recibidas</option>
													<option value="1">Con observaciones sobre el Insumo</option>
												</select>
											</div>
											<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
												<br>
												<button class="btn btn-success" type="submit">Ver</button>
											</div>
										</form>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>Pidió</th>
														<th>Recibió</th>
														<th>Sucursal</th>
														<th>Enviado el</th>
														<th>Recibido el</th>
														<th>Insumo</th>
														<th>Cantidad Enviada</th>
														<th>Cantidad Recibida</th>
														<th>Observaciones</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Pidió</th>
														<th>Recibió</th>
														<th>Sucursal</th>
														<th>Enviado el</th>
														<th>Recibido el</th>
														<th>Insumo</th>
														<th>Cantidad Enviada</th>
														<th>Cantidad Recibida</th>
														<th>Observaciones</th>
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
