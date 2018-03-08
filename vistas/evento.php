<?php
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if($_SESSION['socialMedia']==1){
?>

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
												<th>idevento</th>
												<th>Nombre</th>
												<th>Tipo</th>
												<th>Plataforma</th>
												<th>Recompensa</th>
												<th>Fecha de Inicio</th>
												<th>Fecha de Fin</th>
											</thead>
											<tbody>
											</tbody>
											<tfoot>
												<th>idevento</th>
												<th>Nombre</th>
												<th>Tipo</th>
												<th>Plataforma</th>
												<th>Recompensa</th>
												<th>Fecha de Inicio</th>
												<th>Fecha de Fin</th>
											</tfoot>
										</table>
									</div>
									<div class="panel-body" style="height: 400px;" id="formularioregistros">
										<form name="formulario" id="formulario" method="POST">
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Nombre:</label>
												<input type="hidden" name="idevento" id="idevento"/>
												<input class="form-control" type="text" name="nombre" id="nombre" maxlength="45" placeholder="Nombre" required/>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Tipo de evento:</label>
												<input class="form-control" type="text" name="tipo" id="tipo" maxlength="45" placeholder="Inserte el tipo de evento" required/>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Plataforma en donde se publico el evento:</label>
												<input class="form-control" type="text" name="plataforma" id="plataforma" maxlenght="15" required/>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Recompensa del cliente por el evento:</label>
												<input class="form-control" type="text" name="recompensa" id="recompensa" maxlength="45" placeholder="Inserte Recompensa" required/>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Fecha de Inicio del evento:</label>
												<input class="form-control" type="date" name="fechaInicio" id="fechaInicio"  required/>
											</div>
											<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<label>Fecha de fin del evento:</label>
												<input class="form-control" type="date" name="fechaFin" id="fechaFin" required/>
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
			</div>
	
<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>
		<script type="text/javascript" src="../public/js/evento.js"></script>
		

<?php 
	}
	ob_end_flush();
?>