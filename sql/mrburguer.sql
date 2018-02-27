SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mrburguer` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mrburguer` ;

-- -----------------------------------------------------
-- Table `mrburguer`.`proveedor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`proveedor` (
  `idproveedor` INT NOT NULL AUTO_INCREMENT ,
  `nombreEmpresa` VARCHAR(45) NOT NULL ,
  `correoElectronico` VARCHAR(45) NULL ,
  `telefono` VARCHAR(20) NOT NULL ,
  `estado` VARCHAR(45) NOT NULL ,
  `delegacion` VARCHAR(45) NOT NULL ,
  `colonia` VARCHAR(45) NULL ,
  `calle` VARCHAR(45) NOT NULL ,
  `numExt` VARCHAR(15) NOT NULL ,
  `numInt` VARCHAR(15) NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`idproveedor`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`compra`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`compra` (
  `idcompra` INT NOT NULL AUTO_INCREMENT ,
  `idProveedor` INT NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellidoPaterno` VARCHAR(20) NOT NULL ,
  `apellidoMaterno` VARCHAR(20) NULL ,
  `monto` DECIMAL(11,2) NULL ,
  `iva` DECIMAL(4,2) NULL ,
  PRIMARY KEY (`idcompra`) ,
  INDEX `fk_compra_proveedor_idx` (`idProveedor` ASC) ,
  CONSTRAINT `fk_compra_proveedor`
    FOREIGN KEY (`idProveedor` )
    REFERENCES `mrburguer`.`proveedor` (`idproveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`insumo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`insumo` (
  `idinsumo` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `marca` VARCHAR(45) NULL ,
  `existencias` DECIMAL(11,2) NOT NULL ,
  `piezasContiene` INT NOT NULL DEFAULT 1 ,
  `precioPromedio` DECIMAL(11,2) NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idinsumo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`insumoComprado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`insumoComprado` (
  `idinsumoComprado` INT NOT NULL AUTO_INCREMENT ,
  `idCompra` INT NOT NULL ,
  `idInsumo` INT NOT NULL ,
  `precioUnitarioActual` DECIMAL(11,2) NOT NULL ,
  `cantidad` INT NOT NULL ,
  PRIMARY KEY (`idinsumoComprado`) ,
  INDEX `fk_insumoComprado_insumo_idx` (`idInsumo` ASC) ,
  INDEX `fk_insumoComprado_compra_idx` (`idCompra` ASC) ,
  CONSTRAINT `fk_insumoComprado_insumo`
    FOREIGN KEY (`idInsumo` )
    REFERENCES `mrburguer`.`insumo` (`idinsumo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_insumoComprado_compra`
    FOREIGN KEY (`idCompra` )
    REFERENCES `mrburguer`.`compra` (`idcompra` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
  `nombre` VARCHAR(45) NOT NULL ,
  `movil` TINYINT(1) NOT NULL DEFAULT 0 ,
  `estado` VARCHAR(45) NOT NULL ,
  `delegacion` VARCHAR(45) NULL ,
  `colonia` VARCHAR(45) NOT NULL ,
  `calle` VARCHAR(45) NOT NULL ,
  `numExt` VARCHAR(15) NOT NULL ,
  `numInt` VARCHAR(15) NULL ,
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
  `idinsumoEnSucursal` INT NOT NULL AUTO_INCREMENT ,
  `idInsumo` INT NOT NULL ,
  `idSucursal` INT NOT NULL ,
  `cantidad` DECIMAL(11,2) NOT NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idinsumoEnSucursal`) ,
  INDEX `fk_insumoEnSucursal_sucursal_idx` (`idSucursal` ASC) ,
  INDEX `fk_insumoEnSucursal_insumo_idx` (`idInsumo` ASC) ,
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
  `idtransporteInsumo` INT NOT NULL AUTO_INCREMENT ,
  `idInsumoEnSucursal` INT NOT NULL ,
  `idInsumo` INT NOT NULL ,
  `cantidadEnviada` INT NOT NULL ,
  `cantidadRecibida` INT NULL ,
  `observaciones` VARCHAR(50) NOT NULL ,
  `fechaSolicitud` DATETIME NOT NULL ,
  `fechaEntrega` DATETIME NULL ,
  `idEmpleadoRecibe` INT NULL ,
  PRIMARY KEY (`idtransporteInsumo`) ,
  INDEX `fk_transporteInsumo_insumo_idx` (`idInsumo` ASC) ,
  INDEX `fk_transporteInsumo_insumoEnSucursal_idx` (`idInsumoEnSucursal` ASC) ,
  CONSTRAINT `fk_transporteInsumo_insumo`
    FOREIGN KEY (`idInsumo` )
    REFERENCES `mrburguer`.`insumo` (`idinsumo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transporteInsumo_insumoEnSucursal`
    FOREIGN KEY (`idInsumoEnSucursal` )
    REFERENCES `mrburguer`.`insumoEnSucursal` (`idinsumoEnSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`empleado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`empleado` (
  `idEmpleado` INT NOT NULL AUTO_INCREMENT ,
  `idSucursal` INT NOT NULL ,
  `username` VARCHAR(25) NOT NULL ,
  `password` VARCHAR(64) NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellidoPaterno` VARCHAR(20) NOT NULL ,
  `apellidoMaterno` VARCHAR(20) NULL ,
  `fechaIngreso` DATE NOT NULL ,
  `imagen` VARCHAR(50) NULL ,
  `telefono` VARCHAR(20) NULL ,
  `correoElectronico` VARCHAR(45) NULL ,
  `puesto` VARCHAR(20) NOT NULL ,
  `estado` VARCHAR(45) NOT NULL ,
  `delegacion` VARCHAR(45) NOT NULL ,
  `colonia` VARCHAR(45) NULL ,
  `calle` VARCHAR(45) NOT NULL ,
  `numExt` VARCHAR(15) NOT NULL ,
  `numInt` VARCHAR(15) NULL ,
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
-- Table `mrburguer`.`venta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`venta` (
  `idventa` INT NOT NULL AUTO_INCREMENT ,
  `idCliente` INT NOT NULL ,
  `idEmpleado` INT NOT NULL ,
  `fecha` DATETIME NOT NULL ,
  `montoTotal` DECIMAL(11,2) NULL ,
  `iva` DECIMAL(4,2) NULL ,
  `descuentoActual` INT NOT NULL DEFAULT 0 ,
  `status` VARCHAR(25) NULL ,
  `pagoTarjeta` TINYINT(1) NULL DEFAULT 0 ,
  PRIMARY KEY (`idventa`) ,
  INDEX `fk_venta_empleado_idx` (`idEmpleado` ASC) ,
  INDEX `fk_venta_cliente_idx` (`idCliente` ASC) ,
  CONSTRAINT `fk_venta_empleado`
    FOREIGN KEY (`idEmpleado` )
    REFERENCES `mrburguer`.`empleado` (`idEmpleado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_cliente`
    FOREIGN KEY (`idCliente` )
    REFERENCES `mrburguer`.`cliente` (`idcliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`producto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`producto` (
  `idproducto` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `precioActual` DECIMAL(11,2) NOT NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idproducto`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`prodConsumeInsumo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`prodConsumeInsumo` (
  `idprodConsumeInsumo` INT NOT NULL AUTO_INCREMENT ,
  `idInsumo` INT NOT NULL ,
  `idProducto` INT NOT NULL ,
  `cantidadConsumida` DECIMAL(11,2) NOT NULL ,
  PRIMARY KEY (`idprodConsumeInsumo`) ,
  INDEX `fk_prodConsumeIES_producto_idx` (`idProducto` ASC) ,
  INDEX `fk_prodConsumeInsumo_Insumo_idx` (`idInsumo` ASC) ,
  CONSTRAINT `fk_prodConsumeInsumo_producto`
    FOREIGN KEY (`idProducto` )
    REFERENCES `mrburguer`.`producto` (`idproducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prodConsumeInsumo_Insumo`
    FOREIGN KEY (`idInsumo` )
    REFERENCES `mrburguer`.`insumo` (`idinsumo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`productoEnSucursal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`productoEnSucursal` (
  `idproductoEnSucursal` INT NOT NULL AUTO_INCREMENT ,
  `idProducto` INT NOT NULL ,
  `idSucursal` INT NOT NULL ,
  `isActive` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idproductoEnSucursal`) ,
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
-- Table `mrburguer`.`productoVendido`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`productoVendido` (
  `idproductoVendido` INT NOT NULL AUTO_INCREMENT ,
  `idVenta` INT NOT NULL ,
  `idProductoEnSucursal` INT NOT NULL ,
  `precioVendido` DECIMAL(11,2) NOT NULL ,
  `cantidad` INT NOT NULL ,
  `status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idproductoVendido`) ,
  INDEX `fk_productoVendido_productoEnSucursal_idx` (`idProductoEnSucursal` ASC) ,
  INDEX `fk_productoVendido_venta_idx` (`idVenta` ASC) ,
  CONSTRAINT `fk_productoVendido_productoEnSucursal`
    FOREIGN KEY (`idProductoEnSucursal` )
    REFERENCES `mrburguer`.`productoEnSucursal` (`idproductoEnSucursal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productoVendido_venta`
    FOREIGN KEY (`idVenta` )
    REFERENCES `mrburguer`.`venta` (`idventa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`evento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`evento` (
  `idevento` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `tipo` VARCHAR(45) NULL ,
  `plataforma` VARCHAR(45) NULL ,
  `recompensa` VARCHAR(45) NULL ,
  `fechaInicio` DATETIME NULL ,
  `fechaFin` DATETIME NULL ,
  PRIMARY KEY (`idevento`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`interaccion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`interaccion` (
  `idinteraccion` INT NOT NULL AUTO_INCREMENT ,
  `idCliente` INT NOT NULL ,
  `idEvento` INT NOT NULL ,
  `accionRealizada` VARCHAR(45) NOT NULL ,
  `fechaHoraInteraccion` DATETIME NOT NULL ,
  PRIMARY KEY (`idinteraccion`) ,
  INDEX `fk_interaccion_cliente_idx` (`idCliente` ASC) ,
  INDEX `fk_interaccion_evento_idx` (`idEvento` ASC) ,
  CONSTRAINT `fk_interaccion_cliente`
    FOREIGN KEY (`idCliente` )
    REFERENCES `mrburguer`.`cliente` (`idcliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_interaccion_evento`
    FOREIGN KEY (`idEvento` )
    REFERENCES `mrburguer`.`evento` (`idevento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mrburguer`.`prodVendConsumeInsumoEnSucursal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mrburguer`.`prodVendConsumeInsumoEnSucursal` (
  `idPVCIES` INT NOT NULL AUTO_INCREMENT ,
  `idProductoVendido` INT NOT NULL ,
  `idInsumoEnSucursal` INT NOT NULL ,
  `gastoVenta` DECIMAL(11,2) NULL COMMENT '(Cantidad de insumos que consume el producto * cantidad de productos vendidos) = insumos totales consumidos\n\ninsumosTotalesConsumidos * precio promedio de compra en los últimos N meses = gasto de Venta\n\nOtro comentario : La fecha se obtiene de Venta' ,
  `insumosTotalesConsumidos` DECIMAL(11,2) NULL ,
  PRIMARY KEY (`idPVCIES`) ,
  INDEX `fk_PVCIES_productoVendido_idx` (`idProductoVendido` ASC) ,
  INDEX `fk_PVCIES_insumoEnSucursal_idx` (`idInsumoEnSucursal` ASC) ,
  CONSTRAINT `fk_PVCIES_productoVendido`
    FOREIGN KEY (`idProductoVendido` )
    REFERENCES `mrburguer`.`productoVendido` (`idproductoVendido` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PVCIES_insumoEnSucursal`
    FOREIGN KEY (`idInsumoEnSucursal` )
    REFERENCES `mrburguer`.`insumoEnSucursal` (`idinsumoEnSucursal` )
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
  `idEmpleadoPermiso` INT NOT NULL AUTO_INCREMENT ,
  `idEmpleado` INT NOT NULL ,
  `idPermiso` INT NOT NULL ,
  PRIMARY KEY (`idEmpleadoPermiso`) ,
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

USE `mrburguer` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
