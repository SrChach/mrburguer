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
											<h1 class="box-title"><span id="titulo"></span> <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
										<div class="panel-body" id="formularioregistros">
											<form name="formulario" id="formulario" method="POST">
												<div class="row">
													<div class="form-group col-sm-6">
														<label for="idTransporteInsumo">ID del Transporte de Insumo</label>
														<input class="form-control" type="number" name="idTransporteInsumo" id="idTransporteInsumo" maxlength="45" required/>
													</div>
													<div class="form-group col-sm-6">
														<label for="idInsumoEnSucursal">ID del insumo en sucursal</label>
														<input class="form-control" type="text" name="idInsumoEnSucursal" id="idInsumoEnSucursal" maxlength="20" required/>
													</div>
													<div class="form-group col-sm-6">
														<label for="cantidadEnviada">Cantidad enviada</label>
														<input class="form-control" type="number" name="cantidadEnviada" id="cantidadEnviada" maxlength="25" required/>
													</div>
												</div>
												<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
													<button type="button" class="btn btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
	<!--Fin-Contenido-->

<?php
	require 'footer.php';
?>

<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>
<script type="text/javascript" src="../public/js/enviar.js"></script>
