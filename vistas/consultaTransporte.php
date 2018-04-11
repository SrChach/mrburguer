<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['control']==1){
?>

<!--Contenido-->
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				
				<!-- Main content -->
				<section class="content">
						<div class="row">
							<div class="col-md-12">
									<div class="box">
										<div class="box-header with-border">
													<h1 class="box-title"><span id="nombresucursal"></span></h1>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
																<thead>
																	<th>Status</th>
																	<th>Sucursal</th>
																	<th>Insumo</th>
																	<th>Cantidad Solicitada</th>
																	<th>Fecha Solicitud</th>
																	<th>Cantidad Enviada</th>
																	<th>Fecha Envío</th>
																	<th>Empleado que recibió</th>
																	<th>cantidad Recibida</th>
																	<th>Fecha Recepción</th>
																	<th>Observaciones</th>
																</thead>
																<tbody>
																</tbody>
																<tfoot>
																	<th>Status</th>
																	<th>Sucursal</th>
																	<th>Insumo</th>
																	<th>Cantidad Solicitada</th>
																	<th>Fecha Solicitud</th>
																	<th>Cantidad Enviada</th>
																	<th>Fecha Envío</th>
																	<th>Empleado que recibió</th>
																	<th>cantidad Recibida</th>
																	<th>Fecha Recepción</th>
																	<th>Observaciones</th>
																</tfoot>
															</table>
										</div>
												<div class="box-tools pull-right">
												</div>
										<!-- centro -->
										<!--Fin centro -->
										</div>
										<!-- /.box-header -->
									</div><!-- /.box -->
							</div><!-- /.col -->
					</div><!-- /.row -->
			</section><!-- /.content -->

		</div><!-- /.content-wrapper -->
	<!--Fin-Contenido-->

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>
		<script type="text/javascript">
			listar();
		</script>

<?php 
	}
	ob_end_flush();
?>