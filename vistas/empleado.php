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
												<th>idEmpleado</th>
												<th>Sucursal</th>
												<th>Nombre</th>
												<th>Apellido Paterno</th>
												<th>Apellido Materno</th>
												<th>fecha Ingreso</th>
												<th>Telefono</th>
												<th>Correo</th>
												<th>Puesto</th>
												<th>Estado</th>
												<th>Delegación</th>
												<th>Colonia</th>
												<th>Calle</th>
												<th>Num. Exterior</th>
												<th>Num. Interior</th>
												<th>Foto Perfil</th>
												<th>isActive</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
												<th>idEmpleado</th>
												<th>Sucursal</th>
												<th>Nombre</th>
												<th>Apellido Paterno</th>
												<th>Apellido Materno</th>
												<th>fecha Ingreso</th>
												<th>Telefono</th>
												<th>Correo</th>
												<th>Puesto</th>
												<th>Estado</th>
												<th>Delegación</th>
												<th>Colonia</th>
												<th>Calle</th>
												<th>Num. Exterior</th>
												<th>Num. Interior</th>
												<th>Foto Perfil</th>
												<th>isActive</th>
											</tfoot>
										</table>
									</div>
									<div class="panel-body" id="formularioregistros">
											<form name="formulario" id="formulario" method="POST">
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Nombre(*)</label>
													<input type="hidden" name="idEmpleado" id="idEmpleado"/>
													<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Apellido Paterno(*)</label>
													<input class="form-control" type="text" name="apellidoPaterno" id="apellidoPaterno" maxlength="20" placeholder="Primer Apellido" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Apellido Materno</label>
													<input class="form-control" type="text" name="apellidoMaterno" id="apellidoMaterno" maxlength="20" placeholder="Segundo Apellido"/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Sucursal a la que pertenece(*)</label>
													<select name="idSucursal" id="idSucursal" class="form-control selectpicker" data-live-search="true" required></select>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Nombre de Usuario(*)</label>
													<input class="form-control" type="text" name="username" id="username" maxlength="25" placeholder="Username" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Password(*)</label>
													<input class="form-control" type="text" name="password" id="password" maxlength="64" placeholder="Contraseña" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Fecha de ingreso(*)</label>
													<input class="form-control" type="date" name="fechaIngreso" id="fechaIngreso" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Telefono:</label>
													<input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="Inserte teléfono" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Correo(*)</label>
													<input class="form-control" type="email" name="correoElectronico" id="correoElectronico" maxlength="45" placeholder="Correo Electrónico"/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Puesto(*)</label>
													<input class="form-control" type="text" name="puesto" id="puesto" maxlength="20" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Estado(*)</label>
													<input class="form-control" type="text" name="estado" id="estado" maxlength="45" placeholder="Estado donde reside" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Delegación:</label>
													<input class="form-control" type="text" name="delegacion" id="delegacion" maxlength="45" placeholder="Inserte delegación" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Colonia(*)</label>
													<input class="form-control" type="text" name="colonia" id="colonia" maxlength="45" placeholder="Inserte colonia" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Calle(*)</label>
													<input class="form-control" type="text" name="calle" id="calle" maxlength="45" placeholder="Inserte calle" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Numero Exterior:</label>
													<input class="form-control" type="text" name="numExt" id="numExt" maxlength="15" placeholder="Numero Exterior" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Numero Interior:</label>
													<input class="form-control" type="text" name="numInt" id="numInt" maxlength="15" placeholder="Numero Interior"/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Imagen:</label>
													<input class="form-control" type="file" name="imagen" id="imagen"/>
													<input type="hidden" name="imagenactual" id="imagenactual"/>
													<img src="" width="150px" id="mostrarimagen"/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Permisos:</label>
													<ul style="list-style: none;" id="permisos">
														
													</ul>
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

		<script type="text/javascript" src="../public/js/empleado.js"></script>
		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>		

<?php 
	}
	ob_end_flush();
?>