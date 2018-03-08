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
													<h1 class="box-title">Tabla <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nueva venta</button></h1>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>Venta:</th>
														<th>Cliente:</th>
														<th>Empleado:</th>
														<th>Fecha:</th>
														<th>Monto total:</th>
														<th>IVA:</th>
														<th>Descuento de la venta:</th>
														<th>Status de la venta:</th>
														<th>Pago con tarjeta:</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Venta:</th>
														<th>Cliente:</th>
														<th>Empleado:</th>
														<th>Fecha:</th>
														<th>Monto total:</th>
														<th>IVA:</th>
														<th>Descuento de la venta:</th>
														<th>Status de la venta:</th>
														<th>Pago con:</th>
													</tfoot>
												</table>
										</div>

										<div class="panel-body" style="height: 400px;" id="formularioregistros">
												<form name="formulario" id="formulario" method="POST">
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<input type="hidden" name="idventa" id="idventa"/>
														<label>Cliente:</label>
														<input class="form-control" type="number" name="idCliente" id="idCliente" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Empleado:</label>
														<input class="form-control" type="number" name="idEmpleado" id="idEmpleado" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Status de la venta:</label>
														<select class="form-control selectpicker" name="status" id="status" required>
															<option value="0">Entregado</option>
															<option value="1">Devuelto</option>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Pago con:</label>
														<select class="form-control selectpicker" name="pagoTarjeta" id="pagoTarjeta" required>
															<option value="0">Tarjeta</option>
															<option value="1">Efectivo</option>
													</div>
													<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
														<button type="button" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="../public/js/venta.js"></script>
