<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MrBurguer Ventas</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="../public/css/bootstrap.min.css">
		<link rel="stylesheet" href="../public/css/font-awesome.css">
		
		<!-- Theme style -->
		<link rel="stylesheet" href="../public/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="../public/css/_all-skins.min.css">
		<!-- quitar --><link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
		<!-- quitar --><link rel="shortcut icon" href="../public/img/favicon.ico">

		<!-- DATATABLES -->
		<link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
		<link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
		<link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

		<link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

	</head>
	<body class="hold-transition skin-blue-light sidebar-mini">
		<div class="wrapper">

			<header class="main-header">

				<!-- Logo -->
				<a href="index2.html" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>Mr</b>Burguer</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>MrBurguer</b></span>
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
									<!-- quitar --><img src="../public/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
									<!-- quitar --><span class="hidden-xs">Joaquin el Albañil :v</span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<!-- quitar --><img src="../public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
										<p>
											MisterBurguer
											<small>https://www.github.com/srchach</small>
										</p>
									</li>
									
									<!-- Menu Footer-->
									<li class="user-footer">
										
										<div class="pull-right">
											<a href="#" class="btn btn-default btn-flat">Cerrar</a>
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
							<a href="#">
							 <!-- Botones -->
							 <i class="fa fa-tasks"></i> <span>Escritorio</span>
							</a>
						</li>        
						<li class="treeview">
							<a href="#">
								<i class="fa fa-truck"></i>
								<span>Inventario Central</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="proveedor.php"><i class="fa fa-circle-o"></i>Proveedores</a></li>
								<li><a href="compra.php"><i class="fa fa-circle-o"></i>*Compras</a></li>
								<li><a href="insumo.php"><i class="fa fa-circle-o"></i>Insumo</a></li>
								<li><a href="enviaInsumo.php"><i class="fa fa-circle-o"></i>*Enviar Insumos a Sucursal</a></li>
							</ul>
						</li>
						<!-- Sucursal -->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-home"></i> <span>Sucursales</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="franquicia.php"><i class="fa fa-circle-o"></i>Control de franquicias</a></li>
								<li><a href="sucursal.php"><i class="fa fa-circle-o"></i>Sucursal</a></li>
								<li><a href="sucursal.php"><i class="fa fa-circle-o"></i>*Recibir insumos</a></li>
							</ul>
						</li>

						<!-- Empleado -->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-folder"></i> <span>Control de Empleados</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="empleado.php"><i class="fa fa-circle-o"></i>Empleados</a></li> 
								<li><a href="permiso.php"><i class="fa fa-circle-o"></i>Permisos</a></li>
							</ul>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-male"></i> <span>Empleado</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="venta.php"><i class="fa fa-circle-o"></i>*Ventas</a></li>
								<li><a href="cliente.php"><i class="fa fa-circle-o"></i>Cliente</a></li>
								
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-shopping-cart"></i> <span>Productos</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="producto.php"><i class="fa fa-circle-o"></i>Productos</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Insumos Consumidos</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-users"></i> <span>Social Media</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="cliente.php"><i class="fa fa-circle-o"></i>*Consulta de clientes</a></li>
								<li><a href="interaccion.php"><i class="fa fa-circle-o"></i>Interacciones</a></li>
								<li><a href="evento.php"><i class="fa fa-circle-o"></i>Eventos</a></li>
							</ul>
						</li>
							 <!-- Compras -->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-cart-arrow-down"></i> <span>Consulta Compras</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Registrar compras</a></li> 
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Modificar </a></li>
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i>Activar/Desactivar o Eliminar</a></li>
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i>Consultar compras</a></li>               
							</ul>
						</li>
						<!-- Insumo -->
						
						<!-- Venta -->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-credit-card"></i>
								<span>Ventas</span>
								 <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="venta.php"><i class="fa fa-circle-o"></i>Consultar Ventas</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Registar</a></li>         
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Modificar</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Activar/Desactivar o Eliminar</a></li>
							</ul>
						</li>
						
						<!-- Evento -->
							<li class="treeview">
							<a href="#">
								<i class="fa fa-group"></i> <span>Evento</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Consulta de eventos</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Registar</a></li>         
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Modificar</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Activar/Desactivar o Eliminar</a></li>                
							</ul>
						</li>           
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
