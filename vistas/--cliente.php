<?php 
	require "header.php";
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
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>idcliente</th>
														<th>Nombre</th>
														<th>Apellido Paterno</th>
														<th>Apellido Materno</th>
														<th>Feha Nacimiento</th>
														<th>Fecha Registro</th>
														<th>Nivel</th>
														<th>Cuenta Facebook</th>
														<th>Cuenta Instagram</th>
														<th>Cuenta Twitter</th>
														<th>Correo Electronico</th>
														<th>Telefono</th>
														<th>isActive</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>idcliente</th>
														<th>Nombre</th>
														<th>Apellido Paterno</th>
														<th>Apellido Materno</th>
														<th>Feha Nacimiento</th>
														<th>Fecha Registro</th>
														<th>Nivel</th>
														<th>Cuenta Facebook</th>
														<th>Cuenta Instagram</th>
														<th>Cuenta Twitter</th>
														<th>Correo Electronico</th>
														<th>Telefono</th>
														<th>isActive</th>
													</tfoot>
												</table>
										</div>

										<div class="panel-body" style="height: 400px;" id="formularioregistros">
												<form name="formulario" id="formulario" method="POST">
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Nombre:</label>
														<input type="hidden" name="idcliente" id="idcliente"/>
														<input class="form-control" type="text" name="nombre" id="nombre" maxlength="20" placeholder="Nombre" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Apellido Paterno:</label>
														<input class="form-control" type="text" name="apellidoPaterno" id="apellidoPaterno" maxlength="20" placeholder="Inserte Apellido Paterno" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Apellido Materno:</label>
														<input class="form-control" type="text" name="apellidoMaterno" id="apellidoMaterno" maxlength="20" placeholder="Inserte Apellido Materno" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Fecha de Nacimiento:</label>
														<input class="form-control" type="date" name="fechaNacimiento" id="fechaNacimiento" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Cuenta de Facebook:</label>
														<input class="form-control" type="text" name="cuentaFB" id="cuentaFB" maxlength="45" placeholder="Inserte cuenta de Facebook" />
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Cuenta de Instagram:</label>
														<input class="form-control" type="text" name="cuentaInstagram" id="cuentaInstagram" maxlength="45" placeholder="Inserte cuenta de Instagram" />
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Cuenta de Twitter:</label>
														<input class="form-control" type="text" name="cuentaTwitter" id="cuentaTwitter" maxlength="45" placeholder="Inserte cuenta de Twitter" />
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Correo Electrónico:</label>
														<input class="form-control" type="email" name="correoElectronico" id="correoElectronico" maxlength="45" placeholder="Inserte correo Electrónico"/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Telefono:</label>
														<input class="form-control" type="number" name="telefono" id="telefono" maxlength="45" placeholder="Inserte telefono" required/>
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

<script type="text/javascript" src="scripts/cliente.js"></script>
