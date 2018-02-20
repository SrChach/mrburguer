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
													<h1 class="box-title">Sucursales <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
										<div class="panel-body table-responsive" id="listadoregistros">
												<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
													<thead>
														<th>Acciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
														<th>Menú</th>
														<th>Nombre</th>
														<th>Franquicia</th>
														<th>Tipo</th>
														<th>Estado</th>
														<th>Delegacion</th>
														<th>Colonia</th>
														<th>Calle</th>
														<th>numExt</th>
														<th>numInt</th>
														<th>Status</th>
													</thead>
													<tbody>
													</tbody>
													<tfoot>
														<th>Acciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
														<th>Menú</th>
														<th>Nombre</th>
														<th>Franquicia</th>
														<th>Tipo</th>
														<th>Estado</th>
														<th>Delegacion</th>
														<th>Colonia</th>
														<th>Calle</th>
														<th>numExt</th>
														<th>numInt</th>
														<th>Status</th>
													</tfoot>
												</table>
										</div>
										<div class="panel-body" style="height: 400px;" id="formularioregistros">
												<form name="formulario" id="formulario" method="POST">
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Nombre(*)</label>
														<input type="hidden" name="idsucursal" id="idsucursal"/>
														<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Franquicia a la que pertenece(*)</label>
														<input class="form-control" type="text" name="idFranquicia" id="idFranquicia" maxlength="45" placeholder="Inserte idFranquicia" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Tipo de sucursal[1=Movil|0=Fija](*)</label>
														<input class="form-control" type="number" name="movil" id="movil" min="0" max="1" value="0" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Estado donde se ubica(*)</label>
														<input class="form-control" type="text" name="estado" id="estado" maxlength="45" placeholder="Inserte Estado" required/>
													</div>
													<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
														<label>Delegación:</label>
														<input class="form-control" type="text" name="delegacion" id="delegacion" maxlength="45" placeholder="Inserte delegacion"/>
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
														<label>Número Exterior(*)</label>
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
	<!--Fin-Contenido-->

<?php
	require 'footer.php';
?>

<script type="text/javascript" src="scripts/sucursal.js"></script>
