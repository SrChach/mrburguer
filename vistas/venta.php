<?php 
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['empleado']==1){
?>

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
												<th>Acciones</th>
												<th>Fecha y hora</th>
												<th>nombreEmpleado</th>
												<th>nombreCliente</th>
												<th>Monto total</th>
												<th>Descuento</th>
												<th>IVA</th>
												<th>Forma de pago</th>
												<th>Status</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
												<th>Acciones</th>
												<th>Fecha y hora</th>
												<th>nombreEmpleado</th>
												<th>nombreCliente</th>
												<th>Monto total</th>
												<th>Descuento</th>
												<th>IVA</th>
												<th>Forma de pago</th>
												<th>Status</th>
											</tfoot>
										</table>
									</div>

									<div class="panel-body" style="height: 400px;" id="formularioregistros">
										<form name="formulario" id="formulario" method="POST">

											<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-6">
												<label>id del Cliente:</label>
												<input type="hidden" name="idventa" id="idventa"/>
												<input class="form-control" type="number" name="idCliente" id="idCliente" required/>
											</div>

											<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-6">
												<label>Pago con:</label>
												<select class="form-control selectpicker" name="pagoTarjeta" id="pagoTarjeta" required>
													<option value="1">Tarjeta</option>
													<option value="0">Efectivo</option>
												</select>
											</div>

											<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
												<a data-toggle="modal" href="#myModal">
													<button id="btnAgregarProducto" type="button" class="btn btn-primary"><span class="fa fa-plus">Agregar artículos</span></button>
												</a>
											</div>

											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<table id="productos" class="table table-stripped table-bordered table-condensed table-hover">
													<thead style="background-color: #A9D0F5">
														<th>Opciones</th>
														<th>Producto</th>
														<th>Cantidad</th>
														<th>Precio Unitario</th>
														<th>Subtotal</th>
														<th>refrescar</th>
													</thead>
													<tfoot>
														<th>TOTAL</th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th><h4 id="total">$ 0.00</h4></th>
													</tfoot>
													<tbody>
														
													</tbody>
												</table>
											</div>

											<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar">
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
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Seleccione un Producto</h4>
						</div>
						<div class="modal-body">
							<table id="tblPES" class="table table-striped table-bordered table-condensed table-hover">
								<thead>
									<th>Opciones</th>
									<th>Producto</th>
									<th>Precio</th>
								</thead>
								<tbody></tbody>
								<tfoot>
									<th>Opciones</th>
									<th>Producto</th>
									<th>Precio</th>
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

		<script type="text/javascript" src="scripts/venta.js"></script>

<?php 
	}
	ob_end_flush();
?>