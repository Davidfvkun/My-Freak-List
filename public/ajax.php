<?php

include "../vendor/autoload.php";
require_once "../config.php";
include "funciones.php";

switch ($_REQUEST['peticion']) {
    case 1: // El caso de las peticiones de busqueda de usuarios
        switch ($_GET['val2']) {
            case 1:
                $busqueda = buscar_usuarios($_GET['val1'], $_GET['val2']);
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
    case 2:
        break;
}
?>
