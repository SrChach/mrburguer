<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['inventarioCentral']==1){
?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">				
			<!-- Main content -->
			<section class="content">
					<div class="row">
						<div class="col-md-12">
								<div class="box">
									<!-- /.box-header -->
									<div class="box-header with-border">
												<h1 class="box-title" id="box-title">Seleccionar sucursal para envio de Insumos</h1>
												<div class="panel-body table-responsive" id="listadoregistros">
														<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
															<thead>
																<th>Sucursal</th>
																<th>Franquicia</th>
																<th>Acción</th>
															</thead>
															<tbody>
															</tbody>
															<tfoot>
																<th>Sucursal</th>
																<th>Franquicia</th>
																<th>Acción</th>
															</tfoot>
														</table>
												</div>
												<!--Fin centro -->
											<div class="box-tools pull-right">
											</div>
									</div>
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

		<script type="text/javascript" src="../public/js/envioSuc.js"></script>

<?php 
	}
	ob_end_flush();
?>