SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `myfreakzone` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `myfreakzone` ;

-- -----------------------------------------------------
-- Table `myfreakzone`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nick` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `descripcion` TEXT NULL,
  `contraseña` VARCHAR(255) NOT NULL,
  `es_admin` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myfreakzone`.`material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`material` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  `sinopsis` TEXT NULL,
  `año` CHAR(4) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myfreakzone`.`noticias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`noticias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `noticia` TEXT NOT NULL,
  `fecha` DATE NOT NULL,
  `fuente` TEXT NULL,
  `material_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_noticias_material1_idx` (`material_id` ASC),
  INDEX `fk_noticias_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_noticias_material1`
    FOREIGN KEY (`material_id`)
    REFERENCES `myfreakzone`.`material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_noticias_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `myfreakzone`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myfreakzone`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`comentario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comentario` TEXT NOT NULL,
  `fecha` DATETIME NOT NULL,
  `usuario_id` INT NOT NULL,
  `noticias_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentario_usuario1_idx` (`usuario_id` ASC),
  INDEX `fk_comentario_noticias1_idx` (`noticias_id` ASC),
  CONSTRAINT `fk_comentario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `myfreakzone`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_noticias1`
    FOREIGN KEY (`noticias_id`)
    REFERENCES `myfreakzone`.`noticias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myfreakzone`.`capitulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`capitulos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `calidad` VARCHAR(25) NULL,
  `visto_en` VARCHAR(25) NULL,
  `idioma` VARCHAR(15) NULL,
  `fansub` VARCHAR(25) NULL,
  `material_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_capitulos_material1_idx` (`material_id` ASC),
  CONSTRAINT `fk_capitulos_material1`
    FOREIGN KEY (`material_id`)
    REFERENCES `myfreakzone`.`material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myfreakzone`.`mensaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`mensaje` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mensaje` TEXT NOT NULL,
  `usuario_e` VARCHAR(20) NOT NULL,
  `usuario_r` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myfreakzone`.`material_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`material_usuario` (
  `usuario_id` INT NOT NULL,
  `material_id` INT NOT NULL,
  PRIMARY KEY (`usuario_id`, `material_id`),
  INDEX `fk_usuario_has_material_material1_idx` (`material_id` ASC),
  INDEX `fk_usuario_has_material_usuario_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_usuario_has_material_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `myfreakzone`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_material_material1`
    FOREIGN KEY (`material_id`)
    REFERENCES `myfreakzone`.`material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `myfreakzone`.`usuario_mensaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `myfreakzone`.`usuario_mensaje` (
  `usuario_id` INT NOT NULL,
  `mensaje_id` INT NOT NULL,
  PRIMARY KEY (`usuario_id`, `mensaje_id`),
  INDEX `fk_usuario_has_mensaje_mensaje1_idx` (`mensaje_id` ASC),
  INDEX `fk_usuario_has_mensaje_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_usuario_has_mensaje_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `myfreakzone`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_mensaje_mensaje1`
    FOREIGN KEY (`mensaje_id`)
    REFERENCES `myfreakzone`.`mensaje` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
