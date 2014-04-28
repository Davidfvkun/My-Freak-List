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
                        'ultimasNoticias' => ultimas_noticias(),
                        'usuario' => $_SESSION['logeo']));
                    break;
            }
        })->name('myfreakzone')->via('GET', 'POST');

/* Cerrar sesión y sacar al usuario de la aplicacion */
$app->get('/salir', function() use ($app) {
            unset($_SESSION['logeo']);
            //session_destroy();
            $app->redirect($app->urlFor('registro'));
        })->name('salir');

/* De momento dejo esto como forma de acceder al logeo por si quiero probar algo */
$app->map('/MyFreakZone', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('myfreakzone.html.twig');
                    break;
                case "POST":
                    if (isset($_POST['registrarse'])) {
                        if (isset($_POST['nick']) && isset($_POST['clave']) && isset($_POST['clave2']) && isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['descripcion'])) {
                            $registra = registrarse($_POST['nick'], $_POST['clave'], $_POST['clave2'], $_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['descripcion']);
                            if ($registra == true) {
                                $mensaje = "Se ha registrado correctamente";
                                $clase = "info";
                                $datosBorrador = array("", "", "", "", "", "");
                            } else if ($registra == false) {
                                $mensaje = "Algún campo es incorrecto";
                                $clase = "info error";
                                $datosBorrador = array($_POST['nick'], $_POST['clave'], $_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['descripcion']);
                            }
                        } else {
                            $mensaje = "Algún campo es incorrecto";
                            $clase = "info error";
                        }
                        $app->render('myfreakzone.html.twig', array(
                            'clase' => $clase,
                            'mensaje' => $mensaje,
                            'datosBorrador' => $datosBorrador
                        ));
                    }
                    break;
            }
        })->name('registro')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////
$app->map('/login', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->redirect($app->urlFor('registro'));
                    break;
                case "POST":
                    if (isset($_POST['entrar'])) {
                        if (login($_POST['nick'], $_POST['clave']) == false) {
                            $app->render('myfreakzone.html.twig', array(
                                'mensaje' => 'Usuario y/o contraseña incorrectos',
                                'clase' => 'info error'));
                        } else {
                            $app->redirect($app->urlFor('myfreakzone'));
                        }
                    }
                    break;
            }
        })->name('login')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////

/* Buscar usuarios */

$app->map('/busquedausuario', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->redirect($app->urlFor('myfreakzone'));
                    break;
                case "POST":
                    if (isset($_POST['buscaru'])) {
                        if (strlen($_POST['busquedausuario']) > 0) {// Comprobación de que introduces al menos una letra
                            $busqueda = buscar_usuarios($_POST['busquedausuario'], $_POST['filtrado']);
                        }
                        else
                            $busqueda = null;
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
                    /* $app->render('myfreakzone.html.twig', array(
                      'usuario' => $_SESSION['logeo']
                      )); */
                    $app->redirect($app->urlFor('myfreakzone'));
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
                        if (strlen($_POST['buscaanime']) > 0) {// Comprobación de que introduces al menos una letra
                            $busqueda = buscar_material($_POST['buscaanime'], $V);
                            $busqueda = $busqueda->find_many();
                        }
                        else
                            $busqueda = null;
                    } else if (isset($_POST['buscarma'])) {
                        if (isset($_POST['incluir'])) {
                            if (strlen($_POST['buscaanime']) > 0) { // Comprobación de que introduces al menos una letra
                                $busqueda = buscar_material($_POST['buscaanime'], $V);
                                if (isset($_POST['geneross']) && $_POST['geneross'] != "No filtrar") {
                                    //echo "Hola";
                                    $busqueda = $busqueda->where_like('genero', '%' . $_POST['geneross'] . '%');
                                }
                                if (isset($_POST['fech']) && $_POST['fech'] != "") {
                                    // echo "Holi";
                                    $busqueda = $busqueda->where('anio', $_POST['fech']);
                                }

                                $busqueda = $busqueda->find_many();
                            }
                            else
                                $busqueda = null;
                        } else {
                            $busqueda = ORM::for_table('material');
                            if (isset($_POST['geneross']) && $_POST['geneross'] != "No filtrar") {
                                $busqueda = $busqueda->where_like('genero', '%' . $_POST['geneross'] . '%');
                            }
                            if (isset($_POST['fech']) && $_POST['fech'] != "") {
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

            if ($listad != -1) {
                $app->render('listado.html.twig', array(
                    'datos' => $listad,
                    'cosas' => $mensajeListado,
                    'usuario' => $_SESSION['logeo']));
            }
            else
                echo "No existe ese usuario";
        });

$app->map('/datosmaterial/:idt/', function($idt) use ($app) {
            $clase = "";
            $mensaje = "";
            switch ($app->request()->getMethod()) {
                case "GET":
                    break;
                case "POST":
                    $ok = true;
                    $usuario = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();
                    $material = ORM::for_table('material_usuario')->where('material_id', $idt)->
                                    where('usuario_id', $usuario->id)->find_one();
                    if (isset($_POST['editarmaterial'])) {
                        if (empty($material)) {
                            $mensaje = "Ocurrió algún error inespetado";
                            $clase = "info error";
                            $ok = false;
                        } else {
                            if (isset($_POST['estado']) && isset($_POST['puntuacion']) && isset($_POST['progreso']) && isset($_POST['vista_en']) && isset($_POST['comentario'])) {
                                if (isset($_POST['fav']))
                                    $fav = 1;
                                else
                                    $fav = 0;
                                $material = actualiza_material($material, $_POST['estado'], $_POST['puntuacion'], $_POST['progreso'], $_POST['vista_en'], $_POST['comentario'], $fav);
                                if ($material == false)
                                    $ok = false;
                            }
                            else {
                                $ok = false;
                            }
                            if ($ok == true) {
                                $mensaje = "Se ha actualizado correctamente";
                                $clase = "info";
                            } else {
                                $mensaje = "Ha ocurrido algún error";
                                $clase = "info error";
                            }
                        }
                    } else if (isset($_POST['agregarmaterial'])) {
                        if (!empty($material)) {
                            $mensaje = "Ya está agregado a la lista";
                            $clase = "info error";
                        } else {
                            $material = ORM::for_table('material_usuario')->create();

                            if (isset($_POST['estado']) && isset($_POST['puntuacion']) && isset($_POST['progreso']) && isset($_POST['vista_en']) && isset($_POST['comentario'])) {
                                if (isset($_POST['fav'])) {
                                    $fav = 1;
                                }
                                else
                                    $fav = 0;

                                $material = agrega_material($material, $_POST['estado'], $_POST['puntuacion'], $_POST['progreso'], $_POST['vista_en'], $_POST['comentario'], $idt, $fav);
                            }
                            else {
                                $material = false;
                            }
                            if ($material == true) {
                                $mensaje = "Se ha actualizado correctamente";
                                $clase = "info";
                            } else {
                                $mensaje = "Algún campo no es correcto o ha ocurrido algún error";
                                $clase = "info error";
                            }
                        }
                    }
            }
            $datosMaterial = ORM::for_table('material')->find_one($idt);
            $idUsuario = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();
            $loTengo = ORM::for_table('material_usuario')->where('material_id', $idt)->
                            where('usuario_id', $idUsuario->id)->find_one();

            empty($loTengo) ? $check = 'Agregar' : $check = 'Editar';
            if (empty($datosMaterial)) {
                echo "No existe ese anime/serie/película";
            } else {
                $capitulosMaterial = ORM::for_table('capitulo')->
                                where('material_id', $idt)->find_many();

                $app->render('datosmaterial.html.twig', array(
                    'datos' => $datosMaterial,
                    'datos2' => $capitulosMaterial,
                    'lotengo' => $check,
                    'info' => $mensaje,
                    'clase' => $clase,
                    'datospropios' => $loTengo,
                    'usuario' => $_SESSION['logeo']
                ));
            }
        })->name('material')->via('GET', 'POST');

$app->map('/datosusuario/:nicku/:modo', function($nicku, $modo) use ($app) {

            switch ($app->request()->getMethod()) {
                case "GET":
                    if ($modo == 'e' && usuario_logeado($nicku)) {
                        $caso = 'editar';
                    } else {
                        $caso = 'mostrar';
                    }
                    break;
                case "POST":
                    if (isset($_POST['guardar'])) {
                        $caso = 'mostrar';
                        if (isset($_POST['cnombre']) && isset($_POST['capellido']) && isset($_POST['cdescripcion']))
                            $edit = editar_usuario($_POST['cnombre'], $_POST['capellido'], $_POST['cdescripcion']);
                        else
                            $edit = false;
                    }
                    break;
            }
            $datosUsuario = ORM::for_table('usuario')->where('nick', $nicku)->find_one();


            if (empty($datosUsuario)) {
                echo "Ese usuario no existe"; // Esto está cutrisimo, pero por ahora se queda así
            } else if (isset($edit) && $edit == false)
                echo "Ha ocurrido algún error al editar los datos";
            else {
                if (usuario_logeado($nicku)) {
                    $soyyo = 'si';
                    $clase = array('col-md-9', 'col-md-3');
                    $mensajes = mensajes_privados($datosUsuario->id);
                    echo "<br/><br/><br/><br/><br/>";

                    $numeroUsuarios = num_mensajes($datosUsuario->id);
                    echo count($numeroUsuarios);
                    echo "<br/>";
                    foreach ($mensajes as $mensaje) {

                        $aux = ORM::for_table("usuario")->find_one($mensaje->usuario_e);
                        $aux2 = ORM::for_table("usuario")->find_one($mensaje->usuario_r);
                        $mensaje->usuario_e = $aux->nick;
                        $mensaje->usuario_r = $aux2->nick;
                        echo "<br/>El usuario " . $mensaje->usuario_e .
                        " ha enviado el mensaje '" . $mensaje->mensaje . "' al usuario " . $mensaje->usuario_r;
                    }
                } else {
                    $soyyo = 'no';
                    $clase = array('col-md-12', 'col-md-4');
                }
                $favs = favoritos($datosUsuario->id);



                $app->render('datosusuario.html.twig', array(
                    'datos' => $datosUsuario,
                    'favs' => $favs,
                    'caso' => $caso,
                    'soyyo' => $soyyo,
                    'clase' => $clase,
                    'usuario' => $_SESSION['logeo']
                ));
            }
        })->name('datosusuario')->via('GET', 'POST');

$app->map('/publicabuscanoticias', function() use ($app) {
            $mensaje = "";
            $clase = "";
            $datosBorrador = "";
            switch ($app->request()->getMethod()) {
                case "GET":
                    break;
                case "POST":
                    if (isset($_POST['publicar'])) {
                        if (isset($_POST['titulonoticia']) && isset($_POST['noticia']) && isset($_POST['fuentenoticia']) && isset($_POST['tags'])) {
                            $titulo = $_POST['titulonoticia'];
                            $noticia = $_POST['noticia'];
                            $fuente = $_POST['fuentenoticia'];
                            $tags = $_POST['tags'];
                            $publicarNoticia = publicar_noticia($titulo, $noticia, $fuente, $tags);
                        } else {
                            $titulo = "";
                            $noticia = "";
                            $fuente = "";
                            $tags = "";
                            $publicarNoticia = false;
                        }

                        if ($publicarNoticia) {
                            $datosBorrador = array("", "", "", "");
                            $mensaje = "Noticia publicada correctamente.";
                            $clase = "info";
                            $enlace = "InsertarAquiEnlaceDeLaNoticia";
                        } else {
                            $clase = "info error";
                            $mensaje = "Alguno de los campos es incorrecto";
                            $datosBorrador = array($titulo, $noticia, $fuente, $tags);
                        }
                    }
                    break;
            }
            $app->render('publicanoticia.html.twig', array(
                'mensaje' => $mensaje,
                'clase' => $clase,
                'usuario' => $_SESSION['logeo'],
                'datosBorrador' => $datosBorrador,
            ));
        })->name('publicabuscanoticias')->via('GET', 'POST');

$app->post('/buscarnoticia', function() use ($app) {
            if (isset($_POST['buscarnoticia'])) {
                $datosNoticias = buscar_noticia($_POST['inputbuscarnoticias'], $_POST['filtradonoticia']);
            }
            $app->render('busquedanoticias.html.twig', array(
                'datos' => $datosNoticias,
                'usuario' => $_SESSION['logeo']
            ));
        })->name('buscarnoticia');

$app->post('/publicacomentario', function() use ($app) {
            $mensajeError = null;
            if (isset($_POST['comentar'])) {
                $existeNoticia = ORM::for_table('noticia')->where('id', $_POST['id'])->find_one();
                if (!empty($existeNoticia)) {
                    if (isset($_POST['comentario']) && isset($_POST['id']))
                        $mensaje = publica_comentario($_POST['comentario'], $_POST['id']);

                    if ($mensaje == false) {
                        $mensaje = "Ha ocurrido algún error al enviar el comentario";
                        echo $mensaje;
                        $clase = "info error";
                    } else {
                        $mensaje = null;
                        $clase = null;
                        $app->redirect($app->urlFor('noticia', array('idt' => $_POST['id'])));
                    }
                } else {
                    echo "Ha ocurrido algún error al enviar el comentario";
                }
            }
        })->name('publicacomentario');

$app->get('/noticia/:idt', function($idt) use ($app) {
            $datosNoticia = ORM::for_table('noticia')->where('id', $idt)->find_one();

            if (empty($datosNoticia)) {
                echo "No existe esa noticia";
            } else {
                $comentarios = ORM::for_table('comentario')->
                                select_many('comentario.id', 'comentario.comentario', 'comentario.fecha_publicad', 'usuario.nick')->
                                join('usuario', array('comentario.usuario_id', '=', 'usuario.id'))->
                                where('noticias_id', $datosNoticia->id)->order_by_asc('fecha_publicad')->find_many();
                $nombreUsuario = ORM::for_table("usuario")->where('id', $datosNoticia->usuario_id)->find_one();
                $app->render('noticia.html.twig', array(
                    'datos' => $datosNoticia,
                    'autor' => $nombreUsuario->nick,
                    'coments' => $comentarios,
                    'usuario' => $_SESSION['logeo']
                ));
            }
        })->name('noticia');

$app->get('/borrar/:idc/:idt', function($idc, $idt) use ($app) {
            $datosNoticia = ORM::for_table('noticia')->where('id', $idt)->find_one();

            if (empty($datosNoticia)) {
                echo "<br/><br/><br/><br/><br/>No existe esa noticia";
            } else {
                $comentarioBorrar = ORM::for_table('comentario')->where('id', $idc)->find_one();
                if (!empty($comentarioBorrar)) {
                    $user = ORM::for_table('usuario')->where('id', $comentarioBorrar->usuario_id)->find_one();
                    if ($user->nick != $_SESSION['logeo']) {
                        $mensaje = "No puedes borrar un comentario que no es tuyo";
                        $clase = "info error";
                    } else {
                        $comentarioBorrar->delete();
                        $mensaje = "";
                        $clase = "";
                    }
                } else {
                    $mensaje = "No puedes borrar un comentario que no es tuyo";
                    $clase = "info error";
                }
                $app->redirect($app->urlFor('noticia', array('idt' => $idt)));
            }
        })->name('borrar');

$app->run();
?>
