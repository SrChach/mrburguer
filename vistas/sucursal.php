<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['sucursales']==1){
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
												<th>Menú</th>
												<th>Inventario</th>
												<th>Nombre</th>
												<th>Franquicia</th>
												<th>Tipo</th>
												<th>Teléfono</th>
												<th>Status</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
												<th>Acciones</th>
												<th>Menú</th>
												<th>Inventario</th>
												<th>Nombre</th>
												<th>Franquicia</th>
												<th>Tipo</th>
												<th>Teléfono</th>
												<th>Status</th>
											</tfoot>
										</table>
								</div>
								<div class="panel-body" id="formularioregistros">
										<form name="formulario" id="formulario" method="POST" class="row">
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
												<label>Nombre(*)</label>
												<input type="hidden" name="idsucursal" id="idsucursal"/>
												<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required/>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Franquicia a la que pertenece(*)</label>
												<select name="idFranquicia" id="idFranquicia" class="form-control selectpicker" data-live-search="true" required></select>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Tipo de sucursal(*)</label>
												<select class="form-control selectpicker" name="isMobile" id="isMobile" required>
													<option value="0">Fija</option>
													<option value="1">Móvil</option>
												</select>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Teléfono(*)</label>
												<input class="form-control" type="text" name="telefono" id="telefono" maxlength="45" placeholder="Inserte telefono"/>
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

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>
		<script type="text/javascript" src="../public/js/sucursal.js"></script>
		

<?php 
	}
	ob_end_flush();
?>