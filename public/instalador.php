<?php

/*  My Freak Zone - My Freak List - Web application for films, series and animes (Japanase Animation)
  Copyright (C) 2014: David Femenía Vázquez

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License
  along with this program.  If not, see [http://www.gnu.org/licenses/]. */


include "../vendor/autoload.php";
require_once "../config.php";

function instalar($root, $claveRoot, $puerto, $esquema, $nickAdmin, $claveAdmin, $nombreAdmin, $emailAdmin) {
    $instalacion = -1;
    try {
        $dbh = new PDO('mysql:host=' . $puerto . ';charset=utf8', $root, $claveRoot);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $dbh->beginTransaction();
    } catch (PDOException $e) {
        $instalacion = "Error al entrar en Mysql";
        $dbh->rollBack();

    }

    try {
        $creabaseSQL = $dbh->prepare("CREATE SCHEMA IF NOT EXISTS `$esquema` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
        $creabaseSQL->execute();
        $entrarSQL = $dbh->prepare("USE `$esquema`");
        $entrarSQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear el esquema";
        $dbh->rollBack();
    }

    try {
        $crea1SQL = $dbh->prepare("CREATE TABLE IF NOT EXISTS `$esquema`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nick` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL,
  `clave` VARCHAR(255) NOT NULL,
  `es_admin` INT NOT NULL,
  `img_perfil` VARCHAR(45) NULL,
  `activo` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;");
        $crea1SQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear la tabla usuario";
        $dbh->rollBack();
    }
    
    try {
        $crea2SQL = $dbh->prepare("CREATE TABLE IF NOT EXISTS `$esquema`.`noticia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `noticia` TEXT NOT NULL,
  `fecha_publicado` DATE NOT NULL,
  `fuente` VARCHAR(200) NULL,
  `usuario_id` INT NOT NULL,
  `etiquetas` VARCHAR(200) NOT NULL,
  `titulo` VARCHAR(200) NOT NULL,
  `publicada` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_noticias_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_noticias_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `$esquema`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;");
        $crea2SQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear la tabla noticia";
        $dbh->rollBack();
    }
    
    try {
        $crea3SQL = $dbh->prepare("CREATE TABLE IF NOT EXISTS `$esquema`.`comentario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comentario` TEXT NOT NULL,
  `fecha_publicad` DATETIME NOT NULL,
  `usuario_id` INT NOT NULL,
  `noticias_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentario_usuario1_idx` (`usuario_id` ASC),
  INDEX `fk_comentario_noticias1_idx` (`noticias_id` ASC),
  CONSTRAINT `fk_comentario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `$esquema`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_noticias1`
    FOREIGN KEY (`noticias_id`)
    REFERENCES `$esquema`.`noticia` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;");
        $crea3SQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear la tabla comentario";
        $dbh->rollBack();
    }
    
    try {
        $crea4SQL = $dbh->prepare("CREATE TABLE IF NOT EXISTS `$esquema`.`material` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `tipo` INT NOT NULL COMMENT 'Tipo. 1 = Serie, 2 = Anime, 3 = Pelicula',
  `sinopsis` TEXT NULL,
  `anio` CHAR(4) NULL,
  `n_capitulos` INT NULL,
  `img_material` VARCHAR(45) NULL,
  `genero` VARCHAR(45) NULL,
  `publicado` INT NOT NULL,
  `fecha_publicado` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;");
        $crea4SQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear la tabla material";
        $dbh->rollBack();
    }
    
    try {
        $crea5SQL = $dbh->prepare("CREATE TABLE IF NOT EXISTS `$esquema`.`capitulo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `material_id` INT NOT NULL,
  `titulo` VARCHAR(45) NULL,
  `fecha_salida` DATE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_capitulos_material1_idx` (`material_id` ASC),
  CONSTRAINT `fk_capitulos_material1`
    FOREIGN KEY (`material_id`)
    REFERENCES `$esquema`.`material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;");
        $crea5SQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear la tabla capitulo";
        $dbh->rollBack();
    }
    
    try {
        $crea6SQL = $dbh->prepare("CREATE TABLE IF NOT EXISTS `$esquema`.`mensaje` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mensaje` TEXT NOT NULL,
  `usuario_r` INT NOT NULL,
  `usuario_e` INT NOT NULL,
  `fecha_enviado` DATETIME NOT NULL,
  `leido` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_mensaje_usuario1_idx` (`usuario_e` ASC),
  CONSTRAINT `fk_mensaje_usuario1`
    FOREIGN KEY (`usuario_e`)
    REFERENCES `$esquema`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
");
        $crea6SQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear la tabla mensaje";
        $dbh->rollBack();
    }
    
    try {
        $crea7SQL = $dbh->prepare("CREATE TABLE IF NOT EXISTS `$esquema`.`material_usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `material_id` INT NOT NULL,
  `estado` INT NOT NULL COMMENT 'Estado: 1 = Visto, 2 = Viendo, 3 = Pendiente, 4 = Borrada',
  `puntuacion` INT NULL,
  `vista_en` VARCHAR(200) NULL,
  `comentario` VARCHAR(200) NULL,
  `capitulo_por_el_que_vas` INT NULL,
  `favorito` INT NULL,
  PRIMARY KEY (`id`, `usuario_id`, `material_id`),
  INDEX `fk_usuario_has_material_material1_idx` (`material_id` ASC),
  INDEX `fk_usuario_has_material_usuario_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_usuario_has_material_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `$esquema`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_material_material1`
    FOREIGN KEY (`material_id`)
    REFERENCES `$esquema`.`material` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;");
        $crea7SQL->execute();
    } catch (PDOException $e) {
        $instalacion = "Error al crear la tabla material_usuario";
        $dbh->rollBack();
    }

    /* Aquí irá todo el proceso de tablas */

    /* Para finalizar creamos el config */
    $fp = fopen("../config2.php", "w+");

    $cadena = <<<cosa
<?php
\ORM::configure('mysql:host=$puerto;dbname=$esquema; charset=utf8');
\ORM::configure('username','$root');
\ORM::configure('password','$claveRoot');
\$GLOBALS['generos'] = array('No filtrar','lucha','accion','misterio','apocaliptico','shonen','shojo','drama','amor','infantil');
                    
cosa;

    fputs($fp, $cadena);
    fclose($fp);
        
    if(registrarse($nickAdmin, $claveAdmin, $claveAdmin, $emailAdmin, $nombreAdmin, "Sin Apellidos", "Sin Descripcion",1))
    { 
    }
    else
    {
        $dbh->rollBack();
        $instalacion = "Error al generar el usuario administrador";
    }
    if(file_exists("../config2.php"))
    {
        
    }
    else
    {
        $dbh->rollBack();
        die($e->getMessage());
        $instalacion = "Error al generar el fichero de configuración";
    }
    
    return $instalacion;
}

?>