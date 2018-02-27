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
													<h1 class="box-title"><span id="titulo"></span> <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
												<div class="box-tools pull-right">
												</div>
										</div>
										<!-- /.box-header -->
										<!-- centro -->
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>Acciones</th>
														<th>Nombre</th>
														<th>Precio de Venta</th>
														<th>Status</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Acciones</th>
														<th>Nombre</th>
														<th>Precio de Venta</th>
														<th>Status</th>
													</tfoot>
												</table>
										</div>
										<div class="panel-body" id="formularioregistros">
												<form name="formulario" id="formulario" method="POST">
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Nombre(*)</label>
														<input type="hidden" name="idproducto" id="idproducto"/>
														<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Precio Actual(*)</label>
														<input class="form-control" type="number" name="precioActual" id="precioActual" min="0" max="999999999.99" value="0" step=".01" placeholder="inserte precio" required/>
													</div>
													<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
														<button type="button" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
													</div>
												</form>
										</div>
										<!--Fin centro -->
									</div><!-- /.box -->
							</div><!-- /.col -->
					</div><!-- /.row -->
			</section><!-- /.content -->

		</div><!-- /.content-wrapper -->
	<!--Fin-Contenido-->

<?php
	require 'footer.php';
?>

<script type="text/javascript" src="scripts/producto.js"></script>
