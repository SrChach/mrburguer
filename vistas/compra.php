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
													<h1 class="box-title">Compras <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>Compra</th>
														<th>Nombre de Empresa</th>
														<th>Fecha</th>
														<th>Nombre</th>
														<th>Apellido Paterno</th>
														<th>Apellido Materno</th>
														<th>Monto de la compra</th>
														<th>IVA de la compra</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Compra</th>
														<th>Nombre de Empresa</th>
														<th>Fecha</th>
														<th>Nombre</th>
														<th>Apellido Paterno</th>
														<th>Apellido Materno</th>
														<th>Monto de la compra</th>
														<th>IVA de la compra</th>
													</tfoot>
												</table>
										</div>
										<div class="panel-body" id="formularioregistros">
												<form name="formulario" id="formulario" method="POST">
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Compra(*)</label>
														<input type="text" name="idcompra" id="idcompra"/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Proveedor(*)</label>
														<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true" required></select>
													</div>
													
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Fecha(*)</label>
														<input class="form-control" type="date" name="fecha" id="fecha" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Nombre de quien entrega(*)</label>
														<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required/>
													</div>													
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Apellido Paterno(*)</label>
														<input class="form-control" type="text" name="apellidoPaterno" id="apellidoPaterno" maxlength="45" placeholder="Apellido Paterno" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Apellido Materno</label>
														<input class="form-control" type="text" name="apellidoMaterno" id="apellidoMaterno" maxlength="45" placeholder="Apellido Materno"/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Monto(*)</label>
														<input class="form-control" type="text" name="monto" id="monto" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>IVA(*)</label>
														<input class="form-control" type="number" name="iva" id="iva" required/>
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
<script type="text/javascript" src="../public/js/compra.js"></script>
