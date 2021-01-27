CREATE SCHEMA IF NOT EXISTS `capacitacion_soft` DEFAULT CHARACTER SET utf8 ;
USE `capacitacion_soft` ;

CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `paterno` VARCHAR(45) NOT NULL,
  `materno` VARCHAR(45) NULL,
  `correo` VARCHAR(80) NOT NULL,
  `nacimiento` DATE NOT NULL,
  PRIMARY KEY (`id_empleado`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `catalogo_telefono` (
  `id_catalogo_telefono` INT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id_catalogo_telefono`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `telefono_empleado` (
  `id_telefono_empleado` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `telefono` VARCHAR(50) NOT NULL,
  `id_catalogo_telefono` INT(2) UNSIGNED NOT NULL,
  `id_empleado` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_telefono_empleado`),
  INDEX `fk_telefono_empleado_catalogo_telefono_idx` (`id_catalogo_telefono` ASC),
  INDEX `fk_telefono_empleado_empleado1_idx` (`id_empleado` ASC),
  CONSTRAINT `fk_telefono_empleado_catalogo_telefono`
    FOREIGN KEY (`id_catalogo_telefono`)
    REFERENCES `catalogo_telefono` (`id_catalogo_telefono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_telefono_empleado_empleado1`
    FOREIGN KEY (`id_empleado`)
    REFERENCES `empleado` (`id_empleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


INSERT INTO `catalogo_telefono` (`id_catalogo_telefono`, `tipo`) VALUES (1, 'Celular');
INSERT INTO `catalogo_telefono` (`id_catalogo_telefono`, `tipo`) VALUES (2, 'Casa grande');
INSERT INTO `catalogo_telefono` (`id_catalogo_telefono`, `tipo`) VALUES (3, 'Oficina');
INSERT INTO `catalogo_telefono` (`id_catalogo_telefono`, `tipo`) VALUES (4, 'Casa chica');
INSERT INTO `catalogo_telefono` (`id_catalogo_telefono`, `tipo`) VALUES (5, 'Capilla');