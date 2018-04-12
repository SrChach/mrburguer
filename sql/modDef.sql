SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mrburguer` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mrburguer` ;

-- -----------------------------------------------------
-- Table `mrburguer`.`insumo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`insumo` (
  `idinsumo` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `existencias` DECIMAL(11,2) NOT NULL ,
  `precioPromedio` DECIMAL(11,2) NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idinsumo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`franquicia`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`franquicia` (
  `idFranquicia` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idFranquicia`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`sucursal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`sucursal` (
  `idsucursal` INT NOT NULL AUTO_INCREMENT ,
  `idFranquicia` INT NOT NULL ,
  `idUbicacion` INT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `isMobile` TINYINT(1) NOT NULL DEFAULT 0 ,
  `telefono` VARCHAR(45) NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idsucursal`) ,
  INDEX `fk_sucursal_franquicia_idx` (`idFranquicia` ASC) ,
  CONSTRAINT `fk_sucursal_franquicia`
    FOREIGN KEY (`idFranquicia` )
    REFERENCES `mrburguer`.`franquicia` (`idFranquicia` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`insumoEnSucursal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`insumoEnSucursal` (
  `idInsumoEnSucursal` INT NOT NULL AUTO_INCREMENT ,
  `idInsumo` INT NOT NULL ,
  `idSucursal` INT NOT NULL ,
  `cantidad` DECIMAL(11,2) NOT NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  INDEX `fk_insumoEnSucursal_sucursal_idx` (`idSucursal` ASC) ,
  INDEX `fk_insumoEnSucursal_insumo_idx` (`idInsumo` ASC) ,
  PRIMARY KEY (`idInsumoEnSucursal`) ,
  CONSTRAINT `fk_insumoEnSucursal_sucursal`
    FOREIGN KEY (`idSucursal` )
    REFERENCES `mrburguer`.`sucursal` (`idsucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_insumoEnSucursal_insumo`
    FOREIGN KEY (`idInsumo` )
    REFERENCES `mrburguer`.`insumo` (`idinsumo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`transporteInsumo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`transporteInsumo` (
	idTransporteInsumo int not null primary key auto_increment,
	idInsumoEnSucursal int not null,
	idInsumo int not null,
	fechaSolicitud datetime,
	cantidadPedida int,
	fechaEnvio datetime,
	cantidadEnviada int,
	fechaRecepcion datetime,
	cantidadRecibida int,
	observaciones varchar(50),
	idEmpleadoRecibe int,
	idEmpleadoPide int,
	foreign key(idInsumoEnSucursal) references InsumoEnSucursal(idInsumoEnSucursal) on update cascade on delete cascade,
	foreign key(idInsumo) references Insumo(idInsumo) on update cascade on delete cascade
);


-- -----------------------------------------------------
-- Table `mrburguer`.`empleado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`empleado` (
  `idEmpleado` INT NOT NULL AUTO_INCREMENT ,
  `idSucursal` INT NOT NULL ,
  `username` VARCHAR(25) NOT NULL ,
  `password` VARCHAR(64) NOT NULL ,
  `nomPila` VARCHAR(45) NOT NULL ,
  `apPaterno` VARCHAR(20) NOT NULL ,
  `apMaterno` VARCHAR(20) NULL ,
  `fechaIngreso` DATE NOT NULL ,
  `imagen` VARCHAR(50) NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idEmpleado`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  INDEX `fk_empleado_sucursal_idx` (`idSucursal` ASC) ,
  CONSTRAINT `fk_empleado_sucursal`
    FOREIGN KEY (`idSucursal` )
    REFERENCES `mrburguer`.`sucursal` (`idsucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`venta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`venta` (
  `idventa` INT NOT NULL AUTO_INCREMENT ,
  `idEmpleado` INT NOT NULL ,
  `idCliente` INT NULL ,
  `idUbicacion` INT NULL ,
  `fecha` DATETIME NOT NULL ,
  `montoTotal` DECIMAL(11,2) NULL ,
  `descuentoActual` INT NOT NULL DEFAULT 0 ,
  `pagoTarjeta` TINYINT(1) NULL DEFAULT 0 ,
  `status` VARCHAR(25) NULL ,
  PRIMARY KEY (`idventa`) ,
  INDEX `fk_venta_empleado_idx` (`idEmpleado` ASC) ,
  CONSTRAINT `fk_venta_empleado`
    FOREIGN KEY (`idEmpleado` )
    REFERENCES `mrburguer`.`empleado` (`idEmpleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellidoPaterno` VARCHAR(20) NOT NULL ,
  `apellidoMaterno` VARCHAR(20) NULL ,
  `fechaNacimiento` DATE NOT NULL ,
  `fechaRegistro` DATE NOT NULL ,
  `nivel` INT NOT NULL DEFAULT 1 ,
  `cuentaFB` VARCHAR(45) NULL ,
  `cuentaInstagram` VARCHAR(45) NULL ,
  `cuentaTwitter` VARCHAR(45) NULL ,
  `correoElectronico` VARCHAR(45) NULL ,
  `telefono` VARCHAR(20) NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idcliente`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`producto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`producto` (
  `idproducto` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `precioActual` DECIMAL(11,2) NOT NULL ,
  `imagen` VARCHAR(50) NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idproducto`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`productoEnSucursal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`productoEnSucursal` (
  `idProducto` INT NOT NULL ,
  `idSucursal` INT NOT NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  INDEX `fk_productoEnSucursal_sucursal_idx` (`idSucursal` ASC) ,
  INDEX `fk_productoEnSucursal_producto_idx` (`idProducto` ASC) ,
  CONSTRAINT `fk_productoEnSucursal_sucursal`
    FOREIGN KEY (`idSucursal` )
    REFERENCES `mrburguer`.`sucursal` (`idsucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productoEnSucursal_producto`
    FOREIGN KEY (`idProducto` )
    REFERENCES `mrburguer`.`producto` (`idproducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`permiso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`permiso` (
  `idPermiso` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`idPermiso`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`empleadoPermiso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`empleadoPermiso` (
  `idEmpleado` INT NOT NULL ,
  `idPermiso` INT NOT NULL ,
  INDEX `fk_empleadoPermiso_empleado_idx` (`idEmpleado` ASC) ,
  INDEX `fk_empleadoPermiso_permiso_idx` (`idPermiso` ASC) ,
  CONSTRAINT `fk_empleadoPermiso_empleado`
    FOREIGN KEY (`idEmpleado` )
    REFERENCES `mrburguer`.`empleado` (`idEmpleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_empleadoPermiso_permiso`
    FOREIGN KEY (`idPermiso` )
    REFERENCES `mrburguer`.`permiso` (`idPermiso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`productoVendido`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`productoVendido` (
  `idSucursal` INT NOT NULL ,
  `idVenta` INT NOT NULL ,
  `idProducto` INT NOT NULL ,
  `precioVendido` DECIMAL(11,2) NOT NULL ,
  `cantidad` INT NOT NULL ,
  `observaciones` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NOT NULL ,
  INDEX `fk_productoVendido_venta_idx` (`idVenta` ASC) ,
  INDEX `fk_productoVendido_sucursal_idx` (`idSucursal` ASC) ,
  INDEX `fk_productoVendido_producto_idx` (`idProducto` ASC) ,
  CONSTRAINT `fk_productoVendido_venta`
    FOREIGN KEY (`idVenta` )
    REFERENCES `mrburguer`.`venta` (`idventa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productoVendido_sucursal`
    FOREIGN KEY (`idSucursal` )
    REFERENCES `mrburguer`.`sucursal` (`idsucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productoVendido_producto`
    FOREIGN KEY (`idProducto` )
    REFERENCES `mrburguer`.`producto` (`idproducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`productoConsumeInsumo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`productoConsumeInsumo` (
  `idProducto` INT NOT NULL ,
  `idInsumo` INT NOT NULL ,
  `cantidad` INT NULL ,
  INDEX `fk_pci_producto_idx` (`idProducto` ASC) ,
  INDEX `fk_pci_insumo_idx` (`idInsumo` ASC) ,
  CONSTRAINT `fk_pci_producto`
    FOREIGN KEY (`idProducto` )
    REFERENCES `mrburguer`.`producto` (`idproducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pci_insumo`
    FOREIGN KEY (`idInsumo` )
    REFERENCES `mrburguer`.`insumo` (`idinsumo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mrburguer` ;

INSERT INTO permiso (idpermiso, nombre) VALUES 
  ('1', 'main'),
  ('2', 'Inventario Central'), 
  ('3', 'Sucursales'), 
  ('4', 'Control de Empleados'), 
  ('5', 'Empleado'), 
  ('6', 'Productos'), 
  ('7', 'Social Media');

INSERT INTO franquicia(idFranquicia, nombre, isActive) VALUES 
  ("1","Control", "1");

INSERT INTO sucursal (idSucursal, idFranquicia, idUbicacion, nombre, isMobile, telefono, isActive) VALUES
  ("1", "1", null, "Control", "0", "12345678", "1");

INSERT INTO empleado (idEmpleado, idSucursal, username, password, nomPila, apPaterno, apMaterno, fechaIngreso, imagen, isActive) VALUES
  ("1", "1", "administrador", "98b29fd504669eae1fa7028de99d7d34a1dca7ac8ff6b46d87641203ca7cde3a", "César", "Quintero", "", current_date, "", "1");

INSERT INTO empleadoPermiso (idEmpleado, idPermiso) VALUES
  ("1", "1"),
  ("1", "2"),
  ("1", "3"),
  ("1", "4"),
  ("1", "5"),
  ("1", "6"),
  ("1", "7");

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
