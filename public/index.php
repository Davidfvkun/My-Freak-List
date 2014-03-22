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
                    $registra = registrarse($_POST['nick'], $_POST['clave'], $_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['descripcion']);
                    if ($registra == true) {
                        $mensaje = "Se ha registrado correctamente";
                        $clase = "info";
                    } else if($registra == false) {
                        $mensaje = "Ha ocurrido un fallo inesperado";
                        $clase = "info error";
                    }
                    else
                    {
                        $mensaje = $registra;
                        $clase = "info error";
                    }
                    $app->render('myfreakzone.html.twig', array(
                        'clase' => $clase,
                        'mensaje' => $mensaje
                    ));
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
                    login($_POST['nick'],$_POST['clave'], $app);
                    break;
            }
        })->name('login')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////
        
/* Buscar usuarios */
        
$app->map('/busqueda', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
                case "POST":
                    $busqueda = buscar_usuarios($_POST['busquedausuario'], $_POST['filtrado']);
                    echo "Crear otra plantilla para mostrar los resultados de la consulta";
                    break;
            }
        })->name('busqueda')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////
        
/* Buscar animes-series-peliculas */
        
/*$app->map('/busqueda', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
                case "POST":
                    $busqueda = buscar_material($_POST['busquedausuario'], $_POST['cbmaterial']);
                    echo "Crear otra plantilla para mostrar los resultados de la consulta";
                    break;
            }
        })->name('busqueda')->via('GET', 'POST');*/
//////////////////////////////////////////////////////////////////////

$app->run();
?>
