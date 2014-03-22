<?php

include "../vendor/autoload.php";
include "../vendor/password.php";
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

$app->map('/myfreakzone', function() use ($app) {

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
$app->map('/registro', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
            }
        })->name('registro')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////

$app->run();
?>
