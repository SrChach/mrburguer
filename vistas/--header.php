<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Mr.Burguer | www.misterburguer.com</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="../public/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="../public/css/font-awesome.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="../public/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the ../public/css/skins
				 folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="../public/css/_all-skins.min.css">
		<link rel="shortcut icon" href="../public/img/bic.png">

	</head>
	<body class="hold-transition skin-blue-light sidebar-mini">
		<div class="wrapper">

			<header class="main-header">

				<!-- Logo -->
				<a href="index2.html" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>M</b>B</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>Mr.Burguer</b></span>
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
									<img src="dist/img/icu.png" class="user-image" alt="User Image">
									<span class="hidden-xs">Mr.Burguer Master User</span>
								</a>
								<ul class="dropdown-menu">
									<!-- User image -->
									<li class="user-header">
										<img src="dist/img/icu.png" class="img-circle" alt="User Image">
										<p>
											 www.misterburguer.com - Master User
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
							 <!-- Botones -->
							 <i class="fa fa-tasks"></i> <span>Escritorio</span>
							</a>
						</li>        
						<!-- Inventario Central -->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-truck"></i>
								<span>Inventario Central</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="proveedor.php"><i class="fa fa-circle-o"></i>Proveedores</a></li>
								<li><a href="insumo.php"><i class="fa fa-circle-o"></i>Insumos</a></li>         
								<li><a href="compra.php"><i class="fa fa-circle-o"></i>Compras</a></li>         
								<li><a href="XXXXXX.php"><i class="fa fa-circle-o"></i>Insumos Comprados</a></li>
								<li><a href="XXXXXX.php"><i class="fa fa-circle-o"></i>Transporte de insumos</a></li>
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
						<li class="treeview">
							<a href="#">
								<i class="fa fa-shopping-cart"></i> <span>Insumos</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Registrar</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Modificar</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Activar/Desactivar o Eliminar</a></li>                                  
							</ul>
						</li>
						<!-- Sucursal -->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-home"></i> <span>Sucursal</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i> Consulta de sucursales</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Registar</a></li>         
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Modificar</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Activar/Desactivar o Eliminar</a></li>                                  
							</ul>
						</li>
						<!-- Empleado -->
						<li class="treeview">
							<a href="#">
								<i class="fa fa-male"></i> <span>Empleados</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i> Consulta de empleados</a></li> 
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Registar</a></li>         
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Modificar</a></li>
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i>Activar/Desactivar o Eliminar</a></li>               
							</ul>
						</li>
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
						<!-- Cliente -->
						<li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-users"></i> <span>Clientes</span>
								<i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="consultaventas.php"><i class="fa fa-circle-o"></i> Consulta de clientes</a></li>
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
		
							<a href="#">
								<i class="fa fa-plus-square"></i> <span>Ayuda</span>
								<small class="label pull-right bg-red">PDF</small>
							</a>
						</li>
						<li>
							
				<!-- /.sidebar -->
			</aside>