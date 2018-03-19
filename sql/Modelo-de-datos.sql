create database mrburguer;
use mrburguer;

create table Franquicia(
	idFranquicia int not null primary key auto_increment,
	nombre varchar(45) not null,
	isActive boolean not null
);

create table Sucursal(
	idSucursal int not null primary key auto_increment,
	nombre varchar(45) not null,
	isMobile boolean not null,
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
	precio decimal(11,2) not null,
	imagen varchar(50),
	isActive boolean not null
);

create table ProductoSucursal(
	idSucursal int not null,
	idProducto int not null,
	cantidad int not null,
	primary key(idSucursal, idProducto),
	foreign key(idSucursal) references Sucursal(idSucursal) on update cascade on delete cascade,
	foreign key(idProducto) references Producto(idProducto) on update cascade on delete cascade
);

create table Venta(
	idVenta int not null primary key auto_increment,
	fecha date not null,
	montoTotal decimal(11,2) not null,
	status varchar(25) not null,
	pagoTarjeta boolean not null,
	idEmpleado int not null,
	foreign key(idEmpleado) references Empleado(idEmpleado) on update cascade on delete cascade
);

create table ProductoVendido(
	idSucursal int not null,
	idVenta int not null,
	idProducto int not null,
	cantidad int not null,
	primary key(idSucursal, idVenta, idProducto),
	foreign key(idSucursal) references Sucursal(idSucursal) on update cascade on delete cascade,
	foreign key(idVenta) references Venta(idVenta) on update cascade on delete cascade,
	foreign key(idProducto) references Producto(idProducto) on update cascade on delete cascade
);


insert into franquicia(idFranquicia, nombre, isActive) VALUES("1","Control", "1");
insert into sucursal (idSucursal, nombre, isMobile, idFranquicia) VALUES(1, "Control", 0, 1);
insert into empleado (idEmpleado, userName, password, nomPila, apPaterno, apMaterno, fechaIngreso, imagen, isActive, idSucursal)
values (1, "administrador", "98b29fd504669eae1fa7028de99d7d34a1dca7ac8ff6b46d87641203ca7cde3a", "César", "Quintero", "García", current_date, "", 1, 1);


INSERT INTO permiso (idpermiso, nombre) VALUES 
  ('1', 'main'),
  ('2', 'Inventario Central'), 
  ('3', 'Sucursales'), 
  ('4', 'Control de Empleados'), 
  ('5', 'Empleado'), 
  ('6', 'Productos'), 
  ('7', 'Social Media');
  
  
INSERT INTO empleadoPermiso (idEmpleado, idPermiso) VALUES
  (1, "1"),
  (1, "2"),
  (1, "3"),
  (1, "4"),
  (1, "5"),
  (1, "6"),
  (1, "7");