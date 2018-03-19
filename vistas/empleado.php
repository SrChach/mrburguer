<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['control']==1){
?>

			<div class="content-wrapper">
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box">
								<div class="box-header with-border">
									<h1 class="box-title"><span id="titulo"></span> <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
									<div class="panel-body table-responsive" id="listadoregistros">
										<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
											<thead>
												<th>Acciones</th>
												<th>Usuario</th>
												<th>Nombre</th>
												<th>Apellido Paterno</th>
												<th>Apellido Materno</th>
												<th>Fecha de ingreso</th>
												<th>Imagen</th>
												<th>Estado</th>
												<th>Sucursal</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
												<th>Acciones</th>
												<th>Usuario</th>
												<th>Nombre</th>
												<th>Apellido Paterno</th>
												<th>Apellido Materno</th>
												<th>Fecha de ingreso</th>
												<th>Imagen</th>
												<th>Estado</th>
												<th>Sucursal</th>
											</tfoot>
										</table>
									</div>
									<div class="panel-body" id="formularioregistros">
											<form name="formulario" id="formulario" method="POST">
												<div class="row">
													<div class="col-xs-12 col-sm-6">
														<h4 class="text-center">Información personal</h4>
														<input type="hidden" name="idEmpleado" id="idEmpleado" readonly/>
														<div class="form-group">
															<label for="nomPila">Nombre</label>
															<input class="form-control" type="text" name="nomPila" id="nomPila" maxlength="45" required/>
														</div>
														<div class="form-group">
															<label for="apPaterno">Apellido paterno</label>
															<input class="form-control" type="text" name="apPaterno" id="apPaterno" maxlength="20" required/>
														</div>
														<div class="form-group">
															<label for="apMaterno">Apellido materno</label>
															<input class="form-control" type="text" name="apMaterno" id="apMaterno" maxlength="20" required/>
														</div>
														<div class="form-group">
															<label for="userName">Nombre de usuario</label>
															<input class="form-control" type="text" name="userName" id="userName" maxlength="25" required/>
														</div>
														<div class="form-group">
															<label for="password">Contraseña</label>
															<input class="form-control" type="text" name="password" id="password" maxlength="25" required/>
														</div>
													</div>
													<div class="col-xs-12 col-sm-6">
														<h4 class="text-center">Información de la empresa</h4>
														<div class="form-group">
															<label for="imagenactual">Imagen:</label>
															<input class="form-control" type="file" name="imagen" id="imagen"/>
															<input type="hidden" name="imagenactual" id="imagenactual"/>
															<img src="" width="150px" id="mostrarimagen"/>
														</div>
														<div class="form-group">
															<label for="fechaIngreso">Fecha de ingreso(*)</label>
															<input class="form-control" type="date" name="fechaIngreso" id="fechaIngreso" required/>
														</div>
														<div class="form-group">
															<label for="idSucursal">Sucursal a la que pertenece(*)</label>
															<select name="idSucursal" id="idSucursal" class="form-control selectpicker" data-live-search="true" required></select>
														</div>
														<div class="form-group">
															<label for="permisos">Permisos</label>
															<ul style="list-style: none;" id="permisos"></ul>
														</div>
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
			</div>
<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		
		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>		
		<script type="text/javascript" src="../public/js/empleado.js"></script>

<?php 
	}
	ob_end_flush();
?>