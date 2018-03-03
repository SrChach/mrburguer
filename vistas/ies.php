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
													<h1 class="box-title">Insumos en sucursal <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>Ver</button></h1>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
																<thead>
																	<th>Nombre</th>
																	<th>Marca</th>
																	<th>Precio Promedio</th>
																	<th>Cantidad</th>
																</thead>
																<tbody>
																</tbody>
																<tfoot>
																	<th>Nombre</th>
																	<th>Marca</th>
																	<th>Precio Promedio</th>
																	<th>Cantidad</th>
																</tfoot>
															</table>
										</div>
										<!-- 
											<div class="panel-body" id="formularioregistros">
													<form name="formulario" id="formulario" method="POST">
														<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<label>Insumo en Sucursal(*)</label>
															<input type="hidden" name="idInsumoEnSucursal" id="idInsumoEnSucursal"/>
															<input class="form-control" type="text" name="nombre" id="idInsumoEnSucursal" maxlength="45" placeholder="Nombre" required/>
														</div>
														<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<label>Nombre del insumo(*)</label>
															<input type="hidden" name="idInsumo" id="idInsumo"/>
															<input class="form-control" type="text" name="idInsumo" id="idInsumo" maxlength="45" placeholder="Nombre" required/>
														</div>
														<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<label>Precio Promedio(*)</label>
															<input type="hidden" name="idprecioPromedio" id="idprecioPromedio"/>
															<input class="form-control" type="number" name="idprecioPromedio" id="idprecioPromedio" required/>
														</div>
														<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<label>Cantidad(*)</label>
															<input type="hidden" name="idCantidad" id="idCantidad"/>
															<input class="form-control" type="number" name="idCantidad" id="idCantidad" required/>
														</div>
														<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<button type="submit" class="btn btn-primary" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
															<button type="button" class="btn btn-danger" onclick="cancelarform()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
														</div>
													</form>
											</div>
										 -->
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

<script type="text/javascript" src="scripts/ies.js"></script>
