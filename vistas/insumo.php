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
													<h1 class="box-title">Tabla <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>idinsumo</th>
														<th>Nombre</th>
														<th>Marca del producto</th>
														<th>Existencias</th>
														<th>Piezas que contiene</th>
														<th>Precio promedio</th>
														<th>isActive</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>idinsumo</th>
														<th>Nombre</th>
														<th>Marca del producto</th>
														<th>Existencias</th>
														<th>Piezas que contiene</th>
														<th>Precio promedio</th>
														<th>isActive</th>
													</tfoot>
												</table>
										</div>

										<div class="panel-body" style="height: 400px;" id="formularioregistros">
												<form name="formulario" id="formulario" method="POST">
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Nombre</label>
														<input type="hidden" name="idinsumo" id="idinsumo"/>
														<input class="form-control" type="text" name="nombre" id="nombre" maxlength="50" placeholder="Nombre del insumo" required/>
													</div>

													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Marca</label>
														<input class="form-control" type="text" name="marca" id="marca" maxlength="45" placeholder="Inserte marca" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Existencias</label>
														<input class="form-control" type="number" name="Existencias" id="Existencias" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Piezas que contiene</label>
														<input class="form-control" type="number" name="piezasContiene" id="piezasContiene" required/>
													</div><!-- 
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Precio promedio</label>
														<input class="form-control" type="number" name="precioPromedio" id="precioPromedio" required/>
													</div> -->
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

<script type="text/javascript" src="scripts/insumo.js"></script>
