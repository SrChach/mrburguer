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
										<!-- /.box-header -->
										<div class="box-header with-border">
													<h1 class="box-title" id="box-title">Menú - "<span id="nombresucursal"></span>"</h1>
													<div class="panel-body table-responsive" id="listadoregistros">
															<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
																<thead>
																	<th>Producto</th>
																	<th>Precio Actual</th>
																	<th>Accion</th>
																</thead>
																<tbody>
																</tbody>
																<tfoot>
																	<th>Producto</th>
																	<th>Precio Actual</th>
																	<th>Accion</th>
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
	<!--Fin-Contenido-->

<?php
	require 'footer.php';
?>

<script type="text/javascript" src="scripts/menu.js"></script>
