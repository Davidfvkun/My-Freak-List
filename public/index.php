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
                    $app->render('inicio.html.twig', array(
                        'generos' => $GLOBALS['generos'],
                        'N' => count($GLOBALS['generos']),
                        'usuario' => $_SESSION['logeo']));
                    break;
            }
        })->name('myfreakzone')->via('GET', 'POST');

/* Cerrar sesión y sacar al usuario de la aplicacion */
$app->get('/salir', function() use ($app) {
            unset($_SESSION['logeo']);
            //session_destroy();
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
                        echo "pr";
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

                        $app->render('busquedausuario.html.twig', array(
                            'datos' => $busqueda, 
                            'usuario' => $_SESSION['logeo']));
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
                        if(strlen($_POST['buscaanime']) > 0)// Comprobación de que introduces al menos una letra
                        {
                            $busqueda = buscar_material($_POST['buscaanime'], $V);
                            $busqueda = $busqueda->find_many();
                        }
                        else
                            $busqueda = null;
                    } else if (isset($_POST['buscarma'])) {
                        if (isset($_POST['incluir'])) 
                        {
                            if(strlen($_POST['buscaanime']) > 0) // Comprobación de que introduces al menos una letra
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
                            }
                            else
                                $busqueda = null;
                            
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
                    $app->render('busquedamaterial.html.twig', array(
                        'datos' => $busqueda,
                        'usuario' => $_SESSION['logeo']));
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
                'cosas' => $mensajeListado,
                'usuario' => $_SESSION['logeo']));
        });

$app->get('/datosmaterial/:idt/', function($idt) use ($app) {

            $datosMaterial = ORM::for_table('material')->find_one($idt);
            $loTengo = ORM::for_table('material_usuario')->where('material_id',$idt)->
                    where('usuario_id',$_SESSION['logeo'])->find_one();
            empty($loTengo) ? $check = 'Agregar' : $check = 'Editar';
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
                    'datos2' => $capitulosMaterial,
                    'lotengo' => $check,
                    'datospropios' => $loTengo,
                    'usuario' => $_SESSION['logeo']
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
                    'soyyo' => $soyyo,
                    'usuario' => $_SESSION['logeo']
                ));
            }
            
        })->name('datosusuario')->via('GET', 'POST');

$app->post('/actualizamaterial', function() use ($app) 
{
    $idt = $_POST['id'];
    $material = ORM::for_table('material_usuario')->where('material_id',$idt)->
            where('usuario_id',$_SESSION['logeo'])->find_one();
    if(isset($_POST['editarmaterial']))
    {
        if(empty($material))
        {
            $mensaje = "Ocurrió algún error inespetado";
            $clase = "info error";
        }
        else
        {
            $material = actualiza_material($material, 
                    $_POST['estado'],$_POST['puntuacion'],
                    $_POST['progreso'],$_POST['vista_en'],$_POST['comentario']);
            $material->save();
            $mensaje = "Se ha agregado correctamente";
            $clase = "info";
        }
    }
    else if(isset($_POST['agregarmaterial']))
    {
        if(!empty($material))
        {
            $mensaje = "Ya está agregado a la lista";
            $clase = "info error";
        }
        else{
            $material = ORM::for_table('material_usuario')->create();
            $material = actualiza_material($material, 
                    $_POST['estado'],$_POST['puntuacion'],
                    $_POST['progreso'],$_POST['vista_en'],$_POST['comentario']);
            $material->material_id = $idt;
            $iden = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
            $material->usuario_id = $iden->id;
            $material->save();
            $mensaje = "Se ha agregado correctamente";
            $clase = "info";
        }
    }
    
            $datosMaterial = ORM::for_table('material')->find_one($idt);
            $loTengo = ORM::for_table('material_usuario')->where('material_id',$idt)->
                    where('usuario_id',$_SESSION['logeo'])->find_one();
            empty($loTengo) ? $check = 'Agregar' : $check = 'Editar';
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
                    'datos2' => $capitulosMaterial,
                    'lotengo' => $check,
                    'datospropios' => $loTengo,
                    'clase' => $clase,
                    'info' => $mensaje,
                    'usuario' => $_SESSION['logeo']
                ));
            }
})->name('actualizamaterial');
$app->run();
?>
