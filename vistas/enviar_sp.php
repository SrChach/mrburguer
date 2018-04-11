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
								<div class="box-header with-border">
									<h1 class="box-title"><span id="cabecera"></span>&nbsp; <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nuevo Envio</button></h1>
									<div class="panel-body table-responsive" id="listadoregistros">
										<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
											<thead>
												<th>Nombre Insumo</th>
												<th>Cantidad Enviada</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
												<th>Nombre Insumo</th>
												<th>Cantidad Enviada</th>
											</tfoot>
										</table>
									</div>

									<div class="panel-body" style="height: 400px;" id="formularioregistros">
										<form name="formulario" id="formulario" method="POST">

											<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<a data-toggle="modal" href="#myModal">
													<button id="btnAgregarInsumo" type="button" class="btn btn-primary"><span class="fa fa-plus"> Agregar Insumos</span></button>
												</a>
											</div>

											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
												<table id="insumos" class="table table-stripped table-bordered table-condensed table-hover">
													<thead style="background-color: #A9D0F5;">
														<th>Opciones</th>
														<th>Insumo</th>
														<th>Cantidad</th>
													</thead>
													<tfoot>
														<th>Opciones</th>
														<th>Insumo</th>
														<th>Cantidad</th>
													</tfoot>
													<tbody>
														
													</tbody>
												</table>
											</div>

											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
												<button type="button" class="btn btn-danger" id="btnCancelar" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
											</div>

										</form>
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

			<!-- Ventana Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Seleccione un Insumo</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<table id="tblInsumos" class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Opciones</th>
									<th>Insumo</th>
								</thead>
								<tbody></tbody>
								<tfoot>
									<th>Opciones</th>
									<th>Insumo</th>
								</tfoot>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- fin ventana modal -->
<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="../public/js/enviar_sp.js"></script>

<?php 
	}
	ob_end_flush();
?>

