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
    case 2: // Caso de busqueda de animes 
        if($_GET['val2'] == 0 && $_GET['val3'] == 0 && $_GET['val4'] == 0)
            $arri = array(1,1,1);
        else
            $arri = array($_GET['val2'], $_GET['val3'], $_GET['val4']);
        $busqueda = buscar_material($_GET['val1'], $arri);
        $busqueda = $busqueda->find_many();
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
