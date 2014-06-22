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
include "funciones.php";

switch ($_REQUEST['peticion']) {
    case 1: // El caso de las peticiones de busqueda de usuarios
        switch ($_GET['val2']) {
            case 1:
                $busqueda = buscar_usuarios($_GET['val1'], $_GET['val2']);
                $busqueda = $busqueda->limit(5)->find_many();
                $i = 0;
                $arr = array();
                foreach ($busqueda as $j) {
                    $arr[$i] = $j->nombre;
                    $i = $i + 1;
                }
                print_r(json_encode($arr));
                break;
            case 2:
                $busqueda = buscar_usuarios($_GET['val1'], $_GET['val2']);
                $i = 0;
                $arr = array();
                foreach ($busqueda as $j) {
                    $arr[$i] = $j->nick;
                    $i = $i + 1;
                }
                print_r(json_encode($arr));
                break;
        }
        break;
    // FIN DEL CASO DE LAS BUSQUEDAS DE USUARIOS
    case 2: // Caso de busqueda de animes 
        if($_GET['val2'] == 0 && $_GET['val3'] == 0 && $_GET['val4'] == 0)
            $arri = array(1,1,1);
        else
            $arri = array($_GET['val2'], $_GET['val3'], $_GET['val4']);
        $busqueda = buscar_material($_GET['val1'], $arri, $_GET['val5']);
        $busqueda = $busqueda->limit(5)->find_many();
        $i = 0;
        $arr = array();
        foreach ($busqueda as $j) {
            $arr[$i] = $j->nombre;
            $i = $i + 1;
        }
        print_r(json_encode($arr));
        break;
    case 3: // Caso de comprobación de que ese nick no esté ocupado
        $ocupado = comprueba_nick_existente($_GET['val1']);
        if($ocupado)
            echo "error";
        else
            echo "ok";
        break;
}
?>
