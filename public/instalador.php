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

function instalar($root, $claveRoot, $puerto, $esquema, $nickAdmin, $claveAdmin, $nombreAdmin, $emailAdmin) {
    $instalacion = false;
    /*try {
        $dbh = new PDO('mysql:host=' . $puerto . ';charset=utf8', $root, $claveRoot);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $dbh->beginTransaction();
    } catch (PDOException $e) {
        $instalacion = "Error al entrar en Mysql";
        $dbh->rollBack();
        die($e->getMessage());
    }*/
    
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
                    
                    fputs($fp,$cadena);
                    fclose($fp);
}

?>