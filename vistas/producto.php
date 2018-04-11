<?php
	//Activamos el almacenamiento en buffer
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['productos']==1){
?>

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
									<div class="panel-body table-responsive" id="listadoregistros">
										<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
											<thead>
												<th>Acciones</th>
												<th>Nombre</th>
												<th>Precio de Venta</th>
												<th>Imagen</th>
												<th>Status</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
												<th>Acciones</th>
												<th>Nombre</th>
												<th>Precio de Venta</th>
												<th>Imagen</th>
												<th>Status</th>
											</tfoot>
										</table>
									</div>
									<div class="panel-body" id="formularioregistros">
										<form name="formulario" id="formulario" method="POST" class="row">
											<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
												<label>Nombre(*)</label>
												<input type="hidden" name="idproducto" id="idproducto"/>
												<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required/>
											</div>
											<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
												<label>Precio Actual(*)</label>
												<input class="form-control" type="number" name="precioActual" id="precioActual" min="0" max="999999999.99" value="0" step=".01" placeholder="inserte precio" required/>
											</div>
											<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
												<label>Imagen:</label>
												<input class="form-control" type="file" name="imagen" id="imagen"/>
												<input type="hidden" name="imagenactual" id="imagenactual"/>
												<img src="" width="150px" id="mostrarimagen"/>
											</div>
											<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
												<button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
												<button type="button" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
											</div>
										</form>
									</div>
								</div>
								<!--Fin centro -->
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
		<script type="text/javascript" src="../public/js/producto.js"></script>
		

<?php 
	}
	ob_end_flush();
?>