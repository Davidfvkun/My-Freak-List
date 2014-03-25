<?php

include "../vendor/autoload.php";
include "../vendor/password.php";
include "funciones.php";
require_once "../config.php";
$app = new \Slim\Slim(
        array(
    'view' => new \Slim\Views\Twig(),
    'templates.path' => '../plantillas'
        )
);

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => '../cache'
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

$app->map('/MyFreakZone/principal', function() use ($app) {

            switch ($app->request()->getMethod()) {
                case "GET":
                    /* Este caso se dará si el usuario estaba logeado y ha entrado poniendo la URL */
                    /* Por tanto aquí irá un "if logeado { accede } else { vete pa afuera } */
                    //$app->render('MyFreakZone.html.twig');
                    $app->render('inicio.html.twig');
                    break;
            }
        })->name('myfreakzone')->via('GET', 'POST');

/* De momento dejo esto como forma de acceder al logeo por si quiero probar algo */
$app->map('/MyFreakZone', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
                case "POST":
                    if (isset($_POST['registrarse'])) {
                        $registra = registrarse($_POST['nick'], $_POST['clave'], $_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['descripcion']);
                        if ($registra == true) {
                            $mensaje = "Se ha registrado correctamente";
                            $clase = "info";
                        } else if ($registra == false) {
                            $mensaje = "Ha ocurrido un fallo inesperado";
                            $clase = "info error";
                        } else {
                            $mensaje = $registra;
                            $clase = "info error";
                        }
                        $app->render('myfreakzone.html.twig', array(
                            'clase' => $clase,
                            'mensaje' => $mensaje
                        ));
                    }
                    break;
            }
        })->name('registro')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////

/* De momento dejo esto como forma de acceder al logeo por si quiero probar algo */
$app->map('/login', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
                case "POST":
                    if (isset($_POST['entrar'])) {
                        login($_POST['nick'], $_POST['clave'], $app);
                    }
                    break;
            }
        })->name('login')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////

/* Buscar usuarios */

$app->map('/busquedausuario', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
                case "POST":
                    if (isset($_POST['buscaru'])) {
                        $busqueda = buscar_usuarios($_POST['busquedausuario'], $_POST['filtrado']);
                        foreach($busqueda as $i)
                        {
                            echo $i->nick;
                            echo $i->nombre;
                            echo $i->apellido;
                        }
                        $app->render('busquedausuario.html.twig', array('datos' => $busqueda));
                    }
                    break;
            }
        })->name('busquedausuario')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////

/* Buscar animes-series-peliculas */

$app->map('/busquedam', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
                case "POST":
                    $V = array(0, 0, 0);
                    if (isset($_POST['cbmaterial'])) {
                        foreach ($_POST['cbmaterial'] as $i) {
                            $V[$i] = 1;
                        }
                    } else {
                        $V = array(1, 1, 1);
                    }
                    if (isset($_POST['buscarm'])) {

                        $busqueda = buscar_material($_POST['buscaanime'], $V);

                        $app->render('busquedamaterial.html.twig', array('datos' => $busqueda));
                    } else if (isset($_POST['buscarma'])) {
                        if (isset($_POST['incluir'])) {
                            //$busqueda = funcionbusquedaavanzadaaunsinhacer($_POST['buscaanime'], $V);
                        } else {
                            //$busqueda = funcionbusquedaavanzadaaunsinhacer($_POST['buscaanime'], $V);
                        }
                        /* foreach ($busqueda as $i) {
                          echo $i->nombre;
                          } */
                        echo "Nada";
                    }
                    break;
            }
        })->name('busquedam')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////
        
        
/* Llamadas al listado */
        $app->get('/listado/:idt/:ide', function($idt, $ide) use ($app) {
            $GLOBALS['mensaje'] = "";
            $listad = listados($idt,$ide);
            $mensajeListado = $GLOBALS['mensaje'];
            
            $app->render('listado.html.twig', array(
                'datos' => $listad,
                'cosas' => $mensajeListado));
        });
        
        $app->get('/datosmaterial/:idt/', function($idt) use ($app) {
            
            $datosMaterial = ORM::for_table('material')->
                    select_many('material.*','capitulo.*')->
                    join('capitulo', array('material.id','=','capitulo.material_id'))->find_one($idt);
                    
            echo $datosMaterial->nombre;      
                    
            //$app->render('datosmaterial.html.twig', array());
        });

$app->run();
?>
