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
									<h1 class="box-title">Permisos</h1>
									<div class="panel-body table-responsive" id="listadoregistros">
											<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
												<thead>
													<th>Nombre</th>
												</thead>
												<tbody>
												</tbody>
												<tfoot>
													<th>Nombre</th>
												</tfoot>
											</table>
									</div>
									<div class="box-tools pull-right">
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="scripts/permiso.js"></script>

<?php 
	}
	ob_end_flush();
?>
