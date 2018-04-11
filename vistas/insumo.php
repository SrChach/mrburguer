<?php 
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['inventarioCentral']==1){
?>

			<div class="content-wrapper">
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box">
								<div class="box-header with-border">
									<h1 class="box-title">Inventario Central <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar insumo</button></h1>
									<div class="panel-body table-responsive" id="listadoregistros">
											<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
												<thead>
													<th>Acciones</th>
													<th>Nombre</th>
													<th>Existencias</th>
													<th>Precio promedio</th>
													<th>Status</th>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
													<th>Acciones</th>
													<th>Nombre</th>
													<th>Existencias</th>
													<th>Precio promedio</th>
													<th>Status</th>
												</tfoot>
											</table>
									</div>

									<div class="panel-body" style="height: 400px;" id="formularioregistros">
											<form name="formulario" id="formulario" method="POST" class="row">
												<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
													<label>Nombre</label>
													<input type="hidden" name="idinsumo" id="idinsumo"/>
													<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre del insumo" required/>
												</div>
												<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
													<label>Cantidad existente</label>
													<input class="form-control" type="number" name="existencias" id="existencias" min="0" max="999999999.99" value="0" step=".01" required/>
												</div>
												<div class="form-group col-12 col-sm-6 col-md-6 col-lg-6">
													<label>Precio promedio</label>
													<input class="form-control" type="number" name="precioPromedio" id="precioPromedio" min="0" max="999999999.99" value="0" step=".01"/>
												</div>
												<div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
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
				</section>
			</div>

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>
		<script type="text/javascript" src="../public/js/insumo.js"></script>
		

<?php 
	}
	ob_end_flush();
?>