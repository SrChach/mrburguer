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
						<li class="header"></li>
						<li>
							<a href="#">
								<i class="fa fa-tasks"></i> <span>Escritorio</span>
							</a>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-circle-o"></i>
								<span>Almacén</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="articulo.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
								<li><a href="producto.php"><i class="fa fa-circle-o"></i> Productos</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-circle-o"></i>
								<span>Insumo</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="transporteInsumo.php"><i class="fa fa-circle-o"></i> Transporte</a></li>
								<li><a href="insumoComprado.php"><i class="fa fa-circle-o"></i> Insumo Comprado</a></li>
								<li><a href="prodConsumeInsumo.php"><i class="fa fa-circle-o"></i> Insumos consumidos</a></li>
								<li><a href="insumoEnSucursal.php"><i class="fa fa-circle-o"></i> Insumos en la sucursal</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-th"></i>
								<span>Compras</span>
								 <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="insumoComprado.php"><i class="fa fa-beer"></i> Ingresos</a></li>
								<li><a href="proveedor.php"><i class="fa fa-legal"></i> Proveedores</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-circle-o"></i>
								<span>Interaccion</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
								<li><a href="evento.php"><i class="fa fa-circle-o"></i> Eventos</a></li>
							</ul>
						</li>
						<li>
							<a href="sucursal.php">
								<i class="fa fa-building-o"></i> <span>Sucursales</span>
							</a>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-shopping-cart"></i>
								<span>Ventas</span>
								 <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
								<li><a href="cliente.php"/><i class="fa fa-circle-o"></i> Clientes</a></li>
								<li><a href="empleado.php"/><i class="fa fa-circle-o"></i> Empleado</a></li>
							</ul>
						</li>                       
						<li class="treeview">
							<a href="#">
								<i class="fa fa-folder"></i> <span>Acceso</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
								<li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>		
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultacompras.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
							</ul>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-plus-square"></i> <span>Ayuda</span>
								<small class="label pull-right bg-red">PDF</small>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-info-circle"></i> <span>Acerca De...</span>
								<small class="label pull-right bg-yellow">IT</small>
							</a>
						</li>
												
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
