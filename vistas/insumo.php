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
													<th>idinsumo</th>
													<th>Nombre</th>
													<th>Marca del producto</th>
													<th>Paquetes existentes</th>
													<th>Piezas por paquete</th>
													<th>Precio promedio</th>
													<th>Status</th>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
													<th>idinsumo</th>
													<th>Nombre</th>
													<th>Marca del producto</th>
													<th>Paquetes existentes</th>
													<th>Piezas por paquete</th>
													<th>Precio promedio</th>
													<th>Status</th>
												</tfoot>
											</table>
									</div>

									<div class="panel-body" style="height: 400px;" id="formularioregistros">
											<form name="formulario" id="formulario" method="POST">
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Nombre</label>
													<input type="hidden" name="idinsumo" id="idinsumo"/>
													<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre del insumo" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Marca</label>
													<input class="form-control" type="text" name="marca" id="marca" maxlength="45" placeholder="Inserte marca"/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Paquetes existentes</label>
													<input class="form-control" type="number" name="existencias" id="existencias" min="0" max="999999999.99" value="0" step=".01" required/>
												</div>
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Piezas por paquete</label>
													<input class="form-control" type="number" name="piezasContiene" id="piezasContiene" required/>
												</div> 
												<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<label>Precio promedio</label>
													<input class="form-control" type="number" name="precioPromedio" id="precioPromedio" min="0" max="999999999.99" value="0" step=".01"/>
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
				</section>
			</div>

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="scripts/insumo.js"></script>

<?php 
	}
	ob_end_flush();
?>