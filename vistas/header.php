<?php 
	if(strlen(session_id()) < 1){
		session_start();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>MrBurguer Ventas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="../public/lib/css/bootstrap.min.css">
		<link rel="stylesheet" href="../public/lib/css/font-awesome.min.css">
		
		<!-- Theme style -->
		<link rel="stylesheet" href="../public/lib/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="../public/lib/css/_all-skins.min.css">

		<!-- DATATABLES -->
		<link rel="stylesheet" type="text/css" href="../public/lib/datatables/jquery.dataTables.min.css">    
		<link href="../public/lib/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
		<link href="../public/lib/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

		<link rel="stylesheet" type="text/css" href="../public/lib/css/bootstrap-select.min.css">

	</head>
	<body class="hold-transition skin-blue-light sidebar-mini">
		<div class="wrapper">

			<header class="main-header">

				<!-- Logo -->
				<a href="inicio.php" class="logo">
					<span class="logo-mini"><b>A</b>.<b>D</b>.</span>
					<span class="logo-lg"><b>Admon - D'atelier</b></span>
				</a>

				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Navegación</span>
					</a>
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- Messages: style can be found in dropdown.less-->
							
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?php
										if($_SESSION['imagen']=="" || is_null($_SESSION['imagen'])){
											echo '<img src="../files/empleados/standard_user.png" class="user-image" alt="User Image">';
										} else {
											echo '<img src="../files/empleados/'.$_SESSION['imagen'].'" class="user-image" alt="User Image">';
										}
									?>
									<span class="hidden-xs"><?php echo $_SESSION['nomPila'] . ' - ' . $_SESSION['username']; ?></span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<?php
											if($_SESSION['imagen']=="" || is_null($_SESSION['imagen'])){
												echo '<img src="../files/empleados/standard_user.png" class="img-circle" alt="User Image">';
											} else {
												echo '<img src="../files/empleados/'.$_SESSION['imagen'].'" class="img-circle" alt="User Image">';
											}
										?>
										<p>
											<?php echo "Sesión iniciada como: " . $_SESSION['nomPila']; ?>
											<small>D'atelier</small>
										</p>
									</li>
									
									<!-- Menu Footer-->
									<li class="user-footer">
										
										<div class="pull-right">
											<a href="../ajax/empleado.php?op=exit" class="btn btn-default btn-flat">Salir</a>
										</div>
									</li>
								</ul>
							</li>
							
						</ul>
					</div>

				</nav>
			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">       
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						<ul class="sidebar-menu">
						<li class="header"></li>
						
						<li>
							<a href="inicio.php">
								<i class="fa fa-tasks"></i> <span>Escritorio</span>
							</a>
						</li>   

						<?php
							if($_SESSION['inventarioCentral']==1){
								echo '
									<li class="treeview">
										<a href="#">
											<i class="fa fa-truck"></i>
											<span>Inventario Central</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="insumo.php"><i class="fa fa-circle-o"></i>Insumo</a></li>
											<li><a href="envioSuc.php"><i class="fa fa-circle-o"></i>Enviar Insumos</a></li>
										</ul>
									</li>';
							}
						?>

						<?php
							if($_SESSION["sucursales"]==1){
								echo '
									<li class="treeview">
										<a href="#">
											<i class="fa fa-home"></i> <span>Sucursales</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="franquicia.php"><i class="fa fa-circle-o"></i>Control de franquicias</a></li>
											<li><a href="sucursal.php"><i class="fa fa-circle-o"></i>Sucursal</a></li>
										</ul>
									</li>
								';
							}
						?>
						
						<?php
							if($_SESSION["control"]==1){
								echo '
									<li class="treeview">
										<a href="#">
											<i class="fa fa-folder"></i> <span>Control</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="empleado.php"><i class="fa fa-circle-o"></i>Empleados</a></li> 
											<li><a href="permiso.php"><i class="fa fa-circle-o"></i>Permisos</a></li>
											<li><a href="consultaTransporte.php"><i class="fa fa-circle-o"></i>Consultar Transporte</a></li>
										</ul>
									</li>';
							}
						?>

						<?php
							if($_SESSION["empleado"]==1){
								echo '
									<li class="treeview">
										<a href="#">
											<i class="fa fa-male"></i> <span>Empleado</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="venta.php"><i class="fa fa-credit-card"></i>Mis ventas</a></li>
											<li><a href="peticion.php"><i class="fa fa-circle-o"></i>Peticiones a bodega</a></li><li>
											<a href="recepcion.php"><i class="fa fa-circle-o"></i>Confirmar recepcion</a></li>
										</ul>
									</li>';
							}
						?>

						<?php
							if($_SESSION["productos"]==1){
								echo '
									<li class="treeview">
										<a href="#">
											<i class="fa fa-shopping-cart"></i> <span>Productos</span>
											<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li><a href="producto.php"><i class="fa fa-circle-o"></i>Productos</a></li>
										</ul>
									</li>';
							}
						?>
						
						<!--
						<li class="treeview">
							<a href="#">
								<i class="fa fa-cart-arrow-down"></i> <span>Consulta Compras</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultacompras.php"><i class="fa fa-male"></i> Registrar compras</a></li> 
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Modificar </a></li>
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i>Activar/Desactivar o Eliminar</a></li>
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i>Consultar compras</a></li>               
							</ul>
						</li>
						-->
						          
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
