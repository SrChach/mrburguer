<?php
	require 'header.php';
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
																	<th>Nombre</th>
																	<th>Cantidad Pedida</th>
																	<th>Cantidad a enviar</th>
																	<th>Acción</th>
																</thead>
																<tbody>
																</tbody>
																<tfoot>
																	<th>Nombre</th>
																	<th>Cantidad Pedida</th>
																	<th>Cantidad a enviar</th>
																	<th>Acción</th>
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
	require 'footer.php';
?>

<script type="text/javascript" src="../public/js/enviaInsumo.js"></script>
