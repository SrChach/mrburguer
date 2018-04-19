<?php 
	ob_start();
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: index.html");
	} else {
		require 'header.php';
		if(isset($_SESSION['idEmpleado'])){
?>
	<link rel="stylesheet" type="text/css" href="../public/css/inicio.css">
	<div class="content-wrapper">
		<h1 class="text-center">Bienvenido <?php echo $_SESSION["nomPila"]; ?></h1>
		<div class="row">
			<div class="col-12 col-sm-6">
				<h3 class="text-center borde" >Solicitudes de insumos</h3>
				<?php 
					if($_SESSION['inventarioCentral']==1){
						echo '<div id="necesidades"></div>';
					}

				?>
			</div>
			<div class="col-12 col-sm-6">
				<h3 class="text-center borde">Insumos  a recibir</h3>
				<?php 
					if($_SESSION['empleado']==1){
						echo '<div id="notif"></div>';	
					}
				?>
			</div>
		</div>
	</div>

<?php
		} else {
			require 'acceso_denegado.php';
		}
		require 'footer.php';
?>

		<script type="text/javascript" src="../public/js/funcionesGlobales.js"></script>
		<script type="text/javascript" src="../public/js/cliente.js"></script>

<?php 
	}
	ob_end_flush();
?>