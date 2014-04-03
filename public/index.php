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

session_start();

$app->map('/MyFreakZone/principal', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    /* Este caso se dará si el usuario estaba logeado y ha entrado poniendo la URL */
                    /* Por tanto aquí irá un "if logeado { accede } else { vete pa afuera } */
                    //$app->render('MyFreakZone.html.twig');
                    $app->render('inicio.html.twig', array(
                        'generos' => $GLOBALS['generos'],
                        'N' => count($GLOBALS['generos'])));
                    break;
            }
        })->name('myfreakzone')->via('GET', 'POST');

/* Cerrar sesión y sacar al usuario de la aplicacion */
$app->get('/salir', function() use ($app) {
            unset($_SESSION['logeo']); //Revisar esto: http://www.grabthiscode.com/programacion/como-hacer-un-registro-y-login-php-con-sesiones-y-cookies/
            session_destroy();
            $app->render('myfreakzone.html.twig', array('titulo' => 'Login'));
        })->name('salir');

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
                        $busqueda = $busqueda->find_many();
                    } else if (isset($_POST['buscarma'])) {
                        if (isset($_POST['incluir'])) 
                        {
                            $busqueda = buscar_material($_POST['buscaanime'], $V);
                            if(isset($_POST['geneross']) && $_POST['geneross'] != "No filtrar")
                            {
                                //echo "Hola";
                                $busqueda = $busqueda->where_like('genero', '%'.$_POST['geneross'].'%');
                            }
                            if(isset($_POST['fech']) && $_POST['fech'] != "")
                            {
                               // echo "Holi";
                                $busqueda = $busqueda->where('anio', $_POST['fech']);
                            }
                            
                            $busqueda = $busqueda->find_many();
                            
                        } else {
                            $busqueda = ORM::for_table('material');
                            if(isset($_POST['geneross']) && $_POST['geneross'] != "No filtrar")
                            {
                                $busqueda = $busqueda->where_like('genero', '%'.$_POST['geneross'].'%');
                            }
                            if(isset($_POST['fech']) && $_POST['fech'] != "")
                            {
                                $busqueda = $busqueda->where('anio', $_POST['fech']);
                            }
                            
                            $busqueda = $busqueda->find_many();
                        }
                    }
                    $app->render('busquedamaterial.html.twig', array('datos' => $busqueda));
                    break;
            }
        })->name('busquedam')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////

/* Llamadas al listado */
$app->get('/listado/:idt/:ide/:nicku', function($idt, $ide, $nicku) use ($app) {
            $GLOBALS['mensaje'] = "";
            $listad = listados($idt, $ide, $nicku);
            $mensajeListado = $GLOBALS['mensaje'];

            $app->render('listado.html.twig', array(
                'datos' => $listad,
                'cosas' => $mensajeListado));
        });

/* IMPORTANTE: FALTA COMPROBACIONES DE SI HAY DATOS NULOS */

$app->get('/datosmaterial/:idt/', function($idt) use ($app) {

            $datosMaterial = ORM::for_table('material')->find_one($idt);
            
            if(empty($datosMaterial))
            {
                echo "No existe ese anime/serie/película";
            }
            else
            {
                $capitulosMaterial = ORM::for_table('capitulo')->
                                where('material_id', $idt)->find_many();

                $app->render('datosmaterial.html.twig', array(
                    'datos' => $datosMaterial,
                    'datos2' => $capitulosMaterial
                ));
            }
        });

$app->map('/datosusuario/:nicku/:modo', function($nicku, $modo) use ($app) {
            
            switch ($app->request()->getMethod()) {
                case "GET":
                    if($modo == 'e' && usuario_logeado($nicku))
                    {
                        $caso = 'editar';
                    }
                    else 
                    {
                        $caso = 'mostrar';
                    }
                    break;
                case "POST":
                    if(isset($_POST['guardar']))
                    {
                        $caso = 'mostrar';
                        editar_usuario($_POST['cnombre'], $_POST['capellido'], $_POST['cdescripcion']);
                    }
                    break;
            }
            $datosUsuario = ORM::for_table('usuario')->where('nick',$nicku)->find_one();
            $favs = ORM::for_table('material')->select_many('material.nombre','material.img_material','material.id')->
                    join('material_usuario', array('material.id','=','material_usuario.material_id'))->
                    where('material_usuario.usuario_id',$datosUsuario->id)->
                    where('material_usuario.favorito',1)->find_many();
            
            // Tendría que hacer algo para que si el usuario coincide con la variable de session 
            //  pueda editar y si no no. Pendiente para mas adelante
            
            if(usuario_logeado($nicku))
                $soyyo = 'si';
            else
                $soyyo = 'no';
                
            if(empty($datosUsuario))
            {
                echo "Ese usuario no existe"; // Esto está cutrisimo, pero por ahora se queda así
            }
            else
            {
                $app->render('datosusuario.html.twig', array(
                    'datos' => $datosUsuario,
                    'favs' => $favs,
                    'caso' => $caso,
                    'soyyo' => $soyyo
                ));
            }
        })->name('datosusuario')->via('GET', 'POST');


$app->run();
?>
