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
												<h1 class="box-title"><span id="titulo"></span> <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
									<div class="panel-body table-responsive" id="listadoregistros">
											<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
												<thead>
													<th>idproveedor</th>
													<th>Nombre de la empresa</th>
													<th>Correo Electronico</th>
													<th>Telefono</th>
													<th>Estado</th>
													<th>Delegacion</th>
													<th>Colonia</th>
													<th>Calle</th>
													<th>numExt</th>
													<th>numInt</th>
													<th>IsActive</th>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
													<th>idproveedor</th>
													<th>Nombre de la empresa</th>
													<th>Correo Electronico</th>
													<th>Telefono</th>
													<th>Estado</th>
													<th>Delegacion</th>
													<th>Colonia</th>
													<th>Calle</th>
													<th>numExt</th>
													<th>numInt</th>
													<th>IsActive</th>
												</tfoot>
											</table>
									</div>

									<div class="panel-body" style="height: 400px;" id="formularioregistros">
											<form name="formulario" id="formulario" method="POST">
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Nombre de la empresa:</label>
													<input type="hidden" name="idproveedor" id="idproveedor"/>
													<input class="form-control" type="text" name="nombreEmpresa" id="nombreEmpresa" maxlength="50" placeholder="Nombre de la empresa" required/>
												</div>

												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Telefono de contato:</label>
													<input class="form-control" type="number" name="telefono" id="telefono" maxlength="45" placeholder="Inserte telefono" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Correo Electronico:</label>
													<input class="form-control" type="email" name="correoElectronico" id="correoElectronico" placeholder="Inserte Correo Electronico" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Estado:</label>
													<input class="form-control" type="text" name="estado" id="estado" maxlength="45" placeholder="Inserte Estado" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Delegación:</label>
													<input class="form-control" type="text" name="delegacion" id="delegacion" maxlength="45" placeholder="Inserte delegacion"/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Colonia:</label>
													<input class="form-control" type="text" name="colonia" id="colonia" maxlength="45" placeholder="Inserte colonia" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Calle:</label>
													<input class="form-control" type="text" name="calle" id="calle" maxlength="45" placeholder="Inserte calle" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Número Exterior:</label>
													<input class="form-control" type="text" name="numExt" id="numExt" maxlength="15" placeholder="Inserte Número Exterior" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Número Interior:</label>
													<input class="form-control" type="text" name="numInt" id="numInt" maxlength="15" placeholder="Inserte Número Interior"/>
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

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="../public/js/proveedor.js"></script>
		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>

<?php 
	}
	ob_end_flush();
?>
