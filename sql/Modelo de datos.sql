create database Modelo1;
use Modelo1;

create table Franquicia(
	idFranquicia int not null primary key auto_increment,
	nombre varchar(45) not null,
	isActive boolean not null
);

create table Sucursal(
	idSucursal int not null primary key auto_increment,
	nombre varchar(45) not null,
	telefono varchar(45),
	isMobile boolean not null,
	isActive boolean not null,
	idUbicacion int,
	idFranquicia int,
	foreign key(idFranquicia) references Franquicia(idFranquicia) on update cascade on delete cascade
);

create table Permiso(
	idPermiso int not null primary key auto_increment,
	nombre varchar(30) not null
);

create table Empleado(
	idEmpleado int not null primary key auto_increment,
	userName varchar(25) not null,
	password varchar(64) not null,
	nomPila varchar(45) not null,
	apPaterno varchar(20) not null,
	apMaterno varchar(20),
	fechaIngreso date not null,
	imagen varchar(50),
	isActive boolean not null,
	idSucursal int,
	foreign key(idSucursal) references Sucursal(idSucursal) on update cascade on delete cascade
);

create table EmpleadoPermiso(
	idEmpleado int not null,
	idPermiso int not null,
	primary key(idEmpleado, idPermiso),
	foreign key(idEmpleado) references Empleado(idEmpleado) on update cascade on delete cascade,
	foreign key(idPermiso) references Permiso(idPermiso) on update cascade on delete cascade
);

create table Producto(
	idProducto int not null primary key auto_increment,
	nombre varchar(45) not null,
	precioActual decimal(11,2) not null,
	imagen varchar(50),
	isActive boolean not null
);

create table ProductoEnSucursal(
	idSucursal int not null,
	idProducto int not null,
	isActive boolean not null,
	primary key(idSucursal, idProducto),
	foreign key(idSucursal) references Sucursal(idSucursal) on update cascade on delete cascade,
	foreign key(idProducto) references Producto(idProducto) on update cascade on delete cascade
);

create table Venta(
	idVenta int not null primary key auto_increment,
	fecha datetime not null,
	montoTotal decimal(11,2) not null,
	descuentoActual int not null,
	status varchar(25) not null,
	pagoTarjeta boolean not null,
	idUbicacion int,
	idEmpleado int not null,
	idCliente int,
	foreign key(idEmpleado) references Empleado(idEmpleado) on update cascade on delete cascade
);

create table ProductoVendido(
	idSucursal int not null,
	idVenta int not null,
	idProducto int not null,
	precioVendido decimal(11,2) not null,
	cantidad int not null,
	observaciones varchar(45),
	status varchar(45) not null,
	primary key(idSucursal, idVenta, idProducto),
	foreign key(idSucursal) references Sucursal(idSucursal) on update cascade on delete cascade,
	foreign key(idVenta) references Venta(idVenta) on update cascade on delete cascade,
	foreign key(idProducto) references Producto(idProducto) on update cascade on delete cascade
);

create table Insumo(
	idInsumo int not null primary key auto_increment,
	nombre varchar(45) not null,
	existencia int not null,
	precioPromedio decimal(11,2),
	isActive boolean not null
);

create table ProductoConsumeInsumo(
	idProducto int not null,
	idInsumo int not null,
	cantidad int,
	primary key(idProducto, idInsumo),
	foreign key(idProducto) references Producto(idProducto) on update cascade on delete cascade,
	foreign key(idInsumo) references Insumo(idInsumo) on update cascade on delete cascade
);

create table InsumoEnSucursal(
	idInsumoEnSucursal int not null primary key auto_increment,
	cantidad int not null,
	isActive int not null,
	idInsumo int,
	idSucursal int,
	foreign key(idInsumo) references Insumo(idInsumo) on update cascade on delete cascade,
	foreign key(idSucursal) references Sucursal(idSucursal) on update cascade on delete cascade
);

create table TransporteInsumo(
	idTransporteInsumo int not null primary key,
	idInsumoEnSucursal int not null,
	idInsumo int not null,
	fechaSolicitud datetime,
	cantidadPedida int,
	fechaEnvio datetime,
	cantidadEnviada int,
	fechaRecepcion datetime,
	cantidadRecibida int,
	observaciones varchar(50),
	idEmpleado int not null,
	foreign key(idInsumoEnSucursal) references InsumoEnSucursal(idInsumoEnSucursal) on update cascade on delete cascade,
	foreign key(idInsumo) references Insumo(idInsumo) on update cascade on delete cascade
);
