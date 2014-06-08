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

$app->map('/error/:fail', function($fail) use ($app) {
    if(usuario_logeado())
    {
            switch($fail)
            {
                case 1: // El usuario no existe
                    $info = "El usuario no existe o se ha dado de baja";
                    break;
                case 2: // Error al editar datos
                    $info = "Ha ocurrido algún error al editar los datos";
                    break;
                case 3: // No existe ese anime/serie/película
                    $info = "No existe ese anime/serie/película";
                    break;
                case 4:
                    $info = "Ha ocurrido algún error al enviar el mensaje";
                    break;
                case 5:
                    $info = "No existe esa noticia";
                    break;
                case 6:
                    $info = "Error al aceptar el material";
                        break;
                case 7:
                    $info = "Error al cambiar la contraseña";
                        break;
                default: 
                    $info = "Error desconocido";
                    break;
            }
            $app->render('error.html.twig', array(
                            'info' => $info,
                            'usuario' => $_SESSION['logeo']
                        ));
    }
    else
          $app->redirect($app->urlFor('myfreakzone'));
        })->name('error')->via('GET', 'POST');

$app->map('/panelAdmin', function() use ($app) {
    if(usuario_logeado()){
        $dato = 10;
        $datos = null;
        $fecha1 = null;
        $fecha2 = null;
            switch ($app->request()->getMethod()) {
                case "GET":
                    
                    break;
                case "POST":
                    if(isset($_POST['muestranoticias']))
                    {
                        if(isset($_POST['fecha_1']) && isset($_POST['fecha_2']))
                        {
                            $fecha1 = $_POST['fecha_1'];
                            $fecha2 = $_POST['fecha_2'];
                            $datos = dame_no_publicados('noticia', $fecha1, $fecha2);
                            $dato = 0;
                        }
                    }
                    else if(isset($_POST['aceptarnoticia']))
                    {
                        if(isset($_POST['id']))
                        {
                            $aceptarNoticia = ORM::for_table('noticia')->find_one($_POST['id']);
                            $aceptarNoticia->publicada = 1;
                            $aceptarNoticia->save();
                        }
                        if(isset($_POST['fecha_1']) && isset($_POST['fecha_2']))
                        {
                            $fecha1 = $_POST['fecha_1'];
                            $fecha2 = $_POST['fecha_2'];
                            $datos = dame_no_publicados('noticia', $fecha1, $fecha2);
                            $dato = 0;
                        }
                    }
                    else if(isset($_POST['borrarnoticia']))
                    {
                        if(isset($_POST['id']))
                        {
                            $aceptarNoticia = ORM::for_table('noticia')->find_one($_POST['id']);
                            $aceptarNoticia->delete();
                        }
                        if(isset($_POST['fecha_1']) && isset($_POST['fecha_2']))
                        {
                            $fecha1 = $_POST['fecha_1'];
                            $fecha2 = $_POST['fecha_2'];
                            $datos = dame_no_publicados('noticia', $fecha1, $fecha2);
                            $dato = 1;
                        }
                    }
                    else if(isset($_POST['muestramateriales']))
                    {
                        if(isset($_POST['fecha_1']) && isset($_POST['fecha_2']))
                        {
                            $fecha1 = $_POST['fecha_1'];
                            $fecha2 = $_POST['fecha_2'];
                            $datos = dame_no_publicados('material', $fecha1, $fecha2);
                            $dato = 1;
                        }
                    }
                    else if(isset($_POST['aceptarmaterial']))
                    {
                        if(isset($_POST['nombrematerial']) && isset($_POST['sinopsismaterial']) && 
                                isset($_POST['aniomaterial']) && isset($_POST['tipomaterial'])&& 
                                isset($_POST['generomaterial']) && isset($_POST['id']))
                        {
                            $correcto = aceptar_material($_POST['nombrematerial'],
                                    $_POST['sinopsismaterial'], $_POST['aniomaterial'],
                                    $_POST['tipomaterial'], $_POST['generomaterial'], $_POST['id']);
                        }
                        if($correcto == false)
                            $app->redirect($app->urlFor('error',array('fail' => 6))); 
                        
                        if(isset($_POST['fecha_1']) && isset($_POST['fecha_2']))
                        {
                            $fecha1 = $_POST['fecha_1'];
                            $fecha2 = $_POST['fecha_2'];
                            $datos = dame_no_publicados('material', $fecha1, $fecha2);
                            $dato = 1;
                        }
                        
                    }
                    else if(isset($_POST['borrarmaterial']))
                    {
                        if(isset($_POST['id']))
                        {
                            $material = ORM::for_table('material')->find_one($_POST['id']);
                            $material->delete();
                        }
                        if(isset($_POST['fecha_1']) && isset($_POST['fecha_2']))
                        {
                            $fecha1 = $_POST['fecha_1'];
                            $fecha2 = $_POST['fecha_2'];
                            $datos = dame_no_publicados('material', $fecha1, $fecha2);
                            $dato = 1;
                        }
                    }
                    break;
            }
            $app->render('panelAdmin.html.twig', array(
                            'usuario' => $_SESSION['logeo'],
                            'N' => $datos,
                            'dato' => $dato,
                            'fecha1' => $fecha1,
                            'fecha2' => $fecha2
                        ));
    }
    //else
          //$app->redirect($app->urlFor('myfreakzone'));
        })->name('panelAdmin')->via('GET', 'POST');

$app->map('/MyFreakZone/principal', function() use ($app) {
            switch ($app->request()->getMethod()) {
                case "GET":
                    if (usuario_logeado()) {
                        $tienesMensajes = mensajes_no_leidos();
                        $yo = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();
                        
                        $app->render('inicio.html.twig', array(
                            'generos' => $GLOBALS['generos'],
                            'tienesMensajes' => $tienesMensajes,
                            'nMensajes' => count($tienesMensajes),
                            'N' => count($GLOBALS['generos']),
                            'soyAdmin' => $yo->es_admin,
                            'ultimasNoticias' => ultimas_noticias(),
                            'usuario' => $_SESSION['logeo']));
                    }
                    else
                        $app->redirect($app->urlFor('registro'));
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
    if(!usuario_logeado())
    {
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
    }
    else
          $app->redirect($app->urlFor('myfreakzone'));
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
                            $dioBaja = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
                            if($dioBaja->activo == 0){
                                $dioBaja->activo = 1;
                                $dioBaja->save();
                            }
                            $app->redirect($app->urlFor('myfreakzone'));
                        }
                    }
                    break;
            }
        })->name('login')->via('GET', 'POST');
//////////////////////////////////////////////////////////////////////

/* Buscar usuarios */

$app->post('/busquedausuario/:num', function($num) use ($app) {
    if(usuario_logeado()){
                    $datosPorPagina = 5;
                    $numPaginas = 1;
                    $busqueda = null;
                    $datosQueGuardar = array();
                    if (isset($_POST['busquedausuario']) && strlen($_POST['busquedausuario']) > 0 && isset($_POST['filtrado'])) {
                    
                            $busqueda = buscar_usuarios($_POST['busquedausuario'], $_POST['filtrado']);
                            $datosQueGuardar[0] = $_POST['busquedausuario'];  $datosQueGuardar[1] = $_POST['filtrado'];  
                            $totalDatos = count($busqueda->find_many());
                            $numPaginas = ceil($totalDatos/$datosPorPagina);
                            $busqueda = $busqueda->limit($datosPorPagina)->offset(($num-1)*$datosPorPagina)->find_many();
                            
                    }
                    $app->render('busquedausuario.html.twig', array(
                            'datos' => $busqueda,
                            'N' => $numPaginas,
                            'datosBusqueda' => $datosQueGuardar,
                            'usuario' => $_SESSION['logeo']));
              
        }else
              $app->redirect($app->urlFor('registro'));
        })->name('busquedausuario');
//////////////////////////////////////////////////////////////////////

/* Buscar animes-series-peliculas */

$app->post('/busquedam/:num', function($num) use ($app) {
    if(usuario_logeado()){
                   $datosPorPagina = 5;
                    $datosQueGuardar = array();
                    $V = array(0, 0, 0);
                    $busqueda = null;
                    $numPaginas = 1;
                    if(is_numeric($num)){
                        if (isset($_REQUEST['cbmaterial'])) {
                            foreach ($_REQUEST['cbmaterial'] as $i) {
                                $V[$i] = 1;
                            }
                        } else {
                            $V = array(1, 1, 1);
                        }
                            if (isset($_REQUEST['buscaanime'])) {// Comprobación de que introduces al menos una letra
                                if(strlen($_REQUEST['buscaanime']) > 0)
                                {
                                    $datosQueGuardar[0] = $_REQUEST['buscaanime'];
                                    $datosQueGuardar[1] = $_REQUEST['geneross'];
                                    $busqueda = buscar_material($_REQUEST['buscaanime'], $V, $_REQUEST['geneross']);
                                    $totalDatos = count($busqueda->find_many());
                                    $numPaginas = ceil($totalDatos/$datosPorPagina);
                                    $busqueda = $busqueda->limit($datosPorPagina)->offset(($num-1)*$datosPorPagina)->find_many();
                                }
                            }
                    }
                
                   $app->render('busquedamaterial.html.twig', array(
                        'datos' => $busqueda,
                        'N' => $numPaginas,
                        'opciones' => $V,
                        'datosBusqueda' => $datosQueGuardar,
                        'usuario' => $_SESSION['logeo']));
           }else
              $app->redirect($app->urlFor('registro'));
        })->name('busquedam');
//////////////////////////////////////////////////////////////////////

/* Llamadas al listado */
$app->get('/listado/:idt/:ide/:nicku', function($idt, $ide, $nicku) use ($app) {
        if(usuario_logeado()){
            $GLOBALS['mensaje'] = "";
            $listad = listados($idt, $ide, $nicku);
            $mensajeListado = $GLOBALS['mensaje'];
            $mensaje = "";
            $clase = "";
            if ($listad == -1) 
            {
                $mensaje = "No existe ese usuario o la URL está mal puesta";
                $clase = "info error";
            }
            
                $app->render('listado.html.twig', array(
                    'datos' => $listad,
                    'cosas' => $mensajeListado,
                    'clase' => $clase,
                    'info' => $mensaje,
                    'usuario' => $_SESSION['logeo']));
            }
            else
                $app->redirect($app->urlFor('registro'));
        });

$app->map('/datosmaterial/:idt/', function($idt) use ($app) {
        if(usuario_logeado())
        {
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
                            $mensaje = "Ocurrió algún error inesperado";
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
               $app->redirect($app->urlFor('error',array('fail' => 3)));
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
        }
        else
            $app->redirect($app->urlFor('registro'));
        })->name('material')->via('GET', 'POST');

$app->map('/datosusuario/:nicku/:modo/:priv', function($nicku, $modo, $priv) use ($app) {
    if(usuario_logeado())
    {
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
                        if (isset($_POST['cnombre']) && isset($_POST['capellido']) && 
                                isset($_POST['cdescripcion']) && isset($_POST['claveantigua']) 
                                && isset($_POST['clavenueva']))
                            $edit = editar_usuario($_POST['cnombre'], $_POST['capellido'], $_POST['cdescripcion'],
                                    $_POST['claveantigua'], $_POST['clavenueva']);
                        else
                            $edit = false;
                    }
                    if (isset($_POST['enviarmensaje']))
                    {
                        $caso = 'mostrar';
                        if (isset($_POST['mensajeprivado']))
                        {
                            if($priv == 2 && isset($_POST['para'])){
                                $priv = $_POST['para'];
                                $ok = enviar_mensaje_privado($_POST['mensajeprivado'], $priv);
                            }
                        }
                    }
                    break;
            }/* Fin del Switch */
            $datosUsuario = ORM::for_table('usuario')->where('nick', $nicku)->find_one();
            $N = -1;

            if (empty($datosUsuario)) {
               $app->redirect($app->urlFor('error',array('fail' => 1))); 
            }
            else if(isset($GLOBALS["error"]) && $GLOBALS["error"] != "")
            {
                $app->redirect($app->urlFor('error',array('fail' => 7)));
            } else if (isset($edit) && $edit == false)
               $app->redirect($app->urlFor('error',array('fail' => 2)));
            else if(isset($ok) && $ok == false)
               $app->redirect($app->urlFor('error',array('fail' => 4)));
            else if($datosUsuario->activo == 0)
               $app->redirect($app->urlFor('error',array('fail' => 1)));
            else {
                if (usuario_logeado() && $_SESSION['logeo'] == $nicku) {
                    $soyyo = 'si';
                    if($caso == "editar")
                        $clase = array('col-md-9', '');
                    else
                        $clase = array('col-md-9', 'col-md-3');
                    if($priv == 1)
                    {
                        $mensajes = mensajes_privados($datosUsuario->id);
                        $conjuntoUsuarios = usuarios_mensajeados($mensajes, $datosUsuario->id);
                        $N = count($conjuntoUsuarios);
                    }
                    else
                    {
                        $conjuntoUsuarios = mensajes_privados_contenido($priv);
                        if($conjuntoUsuarios != null){
                            foreach($conjuntoUsuarios as $conj)
                            {
                                    $conj->usuario_e = ORM::for_table('usuario')->find_one($conj->usuario_e)->nick;
                            }
                        }
                    }
                       
                    
                } else {
                    $soyyo = 'no';
                    $conjuntoUsuarios = array();
                    $clase = array('col-md-12', 'col-md-4');
                }
                $favs = favoritos($datosUsuario->id);
                if($conjuntoUsuarios == null && $priv != 1)
                    $app->redirect($app->urlFor('registro'));
                else{
                    $app->render('datosusuario.html.twig', array(
                        'datos' => $datosUsuario,
                        'favs' => $favs,
                        'caso' => $caso,
                        'soyyo' => $soyyo,
                        'clase' => $clase,
                        'mensajespriv' => $conjuntoUsuarios,
                        'usuariomensajes' => $priv,
                        'N' => $N,
                        'usuario' => $_SESSION['logeo']
                    ));
                }
            }/* Fin del else */
    }
    else
        $app->redirect($app->urlFor('registro'));
        })->name('datosusuario')->via('GET', 'POST');

$app->map('/introducematerial', function() use ($app) {
    if(usuario_logeado())
    {
            switch ($app->request()->getMethod()) {
                case "GET":
                    $app->render('introducematerial.html.twig', array(
                        'usuario' => $_SESSION['logeo']
                    ));
                    break;
                case "POST":
                    if (isset($_POST['publicar'])) {
                        if(isset($_POST['nombrematerial']) && isset($_POST['sinopsismaterial']) && 
                                isset($_POST['aniomaterial']) && isset($_POST['tipomaterial'])&& isset($_POST['generomaterial'])
                                )
                        {
                            $nombreMaterial = $_POST['nombrematerial'];
                            $sinopsisMaterial = $_POST['sinopsismaterial'];
                            $anioMaterial = $_POST['aniomaterial'];
                            $tipoMaterial = $_POST['tipomaterial'];
                            $generoMaterial = $_POST['generomaterial'];
                            $verificar = publicar_material($nombreMaterial, $sinopsisMaterial, 
                                    $anioMaterial, $tipoMaterial, $generoMaterial);
                        }
                        else{
                            $verificar = false;
                            $nombreMaterial = "";
                            $sinopsisMaterial = "";
                            $anioMaterial = "";
                            $tipoMaterial = "";
                            $generoMaterial = "";
                        }
                        
                        echo "Hola. True:"; echo true;
                        echo "<br/>Hola.".$verificar;
                        
                        if($verificar == true)
                        {
                            $datosBorrador = array("", "", "", "");
                            $clase = "info";
                            $mensaje = "Se le ha enviado una notificación con los datos a un administrador. En unos días se le responderá.";
                        }
                        else
                        {
                            $datosBorrador = array($nombreMaterial, $sinopsisMaterial, $anioMaterial, $generoMaterial);
                            $clase = "info error";
                            $mensaje = "Ha ocurrido algún error";
                        }
                        $app->render('introducematerial.html.twig', array(
                        'usuario' => $_SESSION['logeo'],
                        'clase' => $clase,
                        'mensaje' => $mensaje,
                        'datosBorrador' => $datosBorrador
                    ));
                    }
                    
                    break;
            }
    }
    else
        $app->redirect($app->urlFor('registro'));
        })->name('introducematerial')->via('GET', 'POST');        
        
$app->map('/publicabuscanoticias', function() use ($app) {
    if(usuario_logeado())
    {
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
    }
    else
        $app->redirect($app->urlFor('registro'));
        })->name('publicabuscanoticias')->via('GET', 'POST');

$app->post('/buscarnoticia/:num', function($num) use ($app) {
    if(usuario_logeado())
    {
            $datosNoticias = null;
            $numPaginas = 0;
            $datosPorPagina = 1;
            $datosQueGuardar = array();
            if(isset($_POST['inputbuscarnoticias']) && isset($_POST['filtradonoticia'])){
                    $datosNoticias = buscar_noticia($_POST['inputbuscarnoticias'], $_POST['filtradonoticia']);
                    if($datosNoticias != null)
                    {
                        $datosCompletos = $datosNoticias->find_many();
                        $totalDatos = count($datosCompletos);
                        $numPaginas = ceil($totalDatos/$datosPorPagina);
                        $datosNoticias = $datosNoticias->limit($datosPorPagina)->offset(($num-1)*$datosPorPagina)->find_many();
                        $datosQueGuardar[0] = $_POST['inputbuscarnoticias'];
                        $datosQueGuardar[1] = $_POST['filtradonoticia'];
                    }
            }
            $app->render('busquedanoticias.html.twig', array(
                'datos' => $datosNoticias,
                'N' => $numPaginas,
                'datosBusqueda' => $datosQueGuardar,
                'usuario' => $_SESSION['logeo']
            ));
    }
    else
        $app->redirect($app->urlFor('registro'));
        })->name('buscarnoticia');

$app->post('/publicacomentario', function() use ($app) {
    if(usuario_logeado())
    {
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
    }
    else
        $app->redirect($app->urlFor('registro'));
        })->name('publicacomentario');

$app->get('/noticia/:idt', function($idt) use ($app) {
    if(usuario_logeado())
    {
            $datosNoticia = ORM::for_table('noticia')->where('id', $idt)->find_one();

            if (empty($datosNoticia)) {
                $app->redirect($app->urlFor('error',array('fail' => 5)));
            } else {
                $comentarios = ORM::for_table('comentario')->
                                select_many('comentario.id', 'comentario.comentario', 'comentario.fecha_publicad', 'usuario.nick')->
                                join('usuario', array('comentario.usuario_id', '=', 'usuario.id'))->
                                where('noticias_id', $datosNoticia->id)->order_by_asc('fecha_publicad')->find_many();
                $nombreUsuario = ORM::for_table("usuario")->where('id', $datosNoticia->usuario_id)->find_one();
                $_SESSION['logeo'] == $nombreUsuario->nick ? $soyyo = "si" : $soyyo = "no";
                $app->render('noticia.html.twig', array(
                    'datos' => $datosNoticia,
                    'autor' => $nombreUsuario->nick,
                    'soyyo' => $soyyo,
                    'idNoticia' => $idt,
                    'coments' => $comentarios,
                    'usuario' => $_SESSION['logeo']
                ));
            }
    }
    else
        $app->redirect($app->urlFor('registro'));
        })->name('noticia');
    
$app->get('/borrar/:idc/:idt', function($idc, $idt) use ($app) {
    if(usuario_logeado())
    {
            $datosNoticia = ORM::for_table('noticia')->where('id', $idt)->find_one();

            if (empty($datosNoticia)) {
                $app->redirect($app->urlFor('error',array('fail' => 5)));
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
    }
    else
        $app->redirect($app->urlFor('registro'));
        })->name('borrar');
$app->post('/eliminarcuenta', function() use ($app) {
            eliminar_cuenta();
            unset($_SESSION['logeo']);
            $app->redirect($app->urlFor('registro'));
        })->name('eliminarcuenta');

$app->get('/borrarnoticia/:idn', function($idn) use ($app) {
            $ok = borrar_noticia($idn);
            if($ok == false) echo "<br/><br/><br/><br/><br/><br/>False"; else echo "<br/><br/><br/><br/><br/><br/>true";
            //$app->redirect($app->urlFor('registro'));
        })->name('borrarnoticia');
        
$app->run();
?>
