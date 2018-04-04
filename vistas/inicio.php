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
	<div class="col-xs-12 col-sm-6">
		<h3 class="text-center borde" >Ventas recientes</h3><br/>
		<?php 
			if($_SESSION['inventarioCentral']==1){
				echo '<div id="necesidades"></div>';
			}

		?>
	</div>
	<div class="col-xs-12 col-sm-6">
		<h3 class="text-center borde">Últimos movimientos</h3><br/>
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