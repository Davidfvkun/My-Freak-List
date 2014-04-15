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
                            $mensaje = "Algún campo es incorrecto";
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
                        if(strlen($_POST['busquedausuario']) > 0)// Comprobación de que introduces al menos una letra
                        {
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
            
            if($listad != -1)
            {
                $app->render('listado.html.twig', array(
                'datos' => $listad,
                'cosas' => $mensajeListado,
                'usuario' => $_SESSION['logeo']));
            }
            else
                echo "No existe ese usuario";
        });

$app->get('/datosmaterial/:idt/', function($idt) use ($app) {

            $datosMaterial = ORM::for_table('material')->find_one($idt);
            $idUsuario = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
            $loTengo = ORM::for_table('material_usuario')->where('material_id',$idt)->
                    where('usuario_id',$idUsuario->id)->find_one();
           
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
                        if(isset($_POST['cnombre']) && isset($_POST['capellido']) && isset($_POST['cdescripcion']))
                            $edit = editar_usuario($_POST['cnombre'], $_POST['capellido'], $_POST['cdescripcion']);
                        else
                            $edit = false;
                    }
                    break;
            }
            $datosUsuario = ORM::for_table('usuario')->where('nick',$nicku)->find_one();
                        
            if(usuario_logeado($nicku))
                $soyyo = 'si';
            else
                $soyyo = 'no';
                
            if(empty($datosUsuario))
            {
                echo "Ese usuario no existe"; // Esto está cutrisimo, pero por ahora se queda así
            }
            else if(isset($edit) && $edit == false)
                echo "Ha ocurrido algún error al editar los datos";
            else
            {
                $favs = ORM::for_table('material')->select_many('material.nombre','material.img_material','material.id')->
                    join('material_usuario', array('material.id','=','material_usuario.material_id'))->
                    where('material_usuario.usuario_id',$datosUsuario->id)->
                    where('material_usuario.favorito',1)->find_many();
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
    $ok = true;
    $idt = -1;
    if(isset($_POST['id'])){
        $idt = $_POST['id'];
    }
    else{
        $ok = false;
    }
    
    $usuario = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
    $material = ORM::for_table('material_usuario')->where('material_id',$idt)->
            where('usuario_id',$usuario->id)->find_one();
    if(isset($_POST['editarmaterial']))
    {
        if(empty($material))
        {
            $mensaje = "Ocurrió algún error inespetado";
            $clase = "info error";
            $ok = false;
        }
        else
        {
            if(isset($_POST['estado']) && isset($_POST['puntuacion']) && isset($_POST['progreso']) && isset($_POST['vista_en']) && isset($_POST['comentario']))
            {
                $material = actualiza_material($material, 
                    $_POST['estado'],$_POST['puntuacion'],
                    $_POST['progreso'],$_POST['vista_en'],$_POST['comentario']);
                if($material == false)
                    $ok = false;
            }
            else
            {
                $ok = false;
            }
            if($ok == true){
                $mensaje = "Se ha actualizado correctamente";
                $clase = "info";
            }
            else{
                $mensaje = "Ha ocurrido algún error";
                $clase = "info error";
            }
                
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
            
            if(isset($_POST['estado']) && isset($_POST['puntuacion']) && isset($_POST['progreso']) && isset($_POST['vista_en']) && isset($_POST['comentario']))
            {
            $material = agrega_material($material, 
                    $_POST['estado'],$_POST['puntuacion'],
                    $_POST['progreso'],$_POST['vista_en'],$_POST['comentario'], $idt);
            }
            else{ 
                $material = false;
            }            
            if($material == true){
                $mensaje = "Se ha actualizado correctamente";
                $clase = "info";
            }
            else{
                $mensaje = "Ha ocurrido algún error";
                $clase = "info error";
            }
        }
    }
    
            $datosMaterial = ORM::for_table('material')->find_one($idt);
            
            if(empty($datosMaterial))
            {
                echo "No existe ese anime/serie/película";
            }
            else
            {
                $idUsuario = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
                $loTengo = ORM::for_table('material_usuario')->where('material_id',$idt)->
                        where('usuario_id',$idUsuario->id)->find_one();

                empty($loTengo) ? $check = 'Agregar' : $check = 'Editar';
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

/* Esto no está incluido en el ultimo commit */
$app->get('/publicabuscanoticias', function() use ($app) 
{
    $app->render('publicanoticia.html.twig');
})->name('publicabuscanoticias');

$app->post('/publicarnoticia', function() use ($app) 
{
    if(isset($_POST['publicar']))
    {
        if(isset($_POST['titulonoticia']) && isset($_POST['noticia']) 
                && isset($_POST['fuentenoticia']) && isset($_POST['tags']))
        {
            $publicarNoticia = publicar_noticia($_POST['titulonoticia'],
                $_POST['noticia'],$_POST['fuentenoticia'], $_POST['tags']);
        }
        else 
            $publicarNoticia = false;
        
        if($publicarNoticia)
        {
            $mensaje = "Noticia publicada correctamente.";
            $clase = "info";
            $enlace = "InsertarAquiEnlaceDeLaNoticia";
        }
        else
        {
            $clase = "info error";
            $mensaje = "Alguno de los campos es incorrecto";
        }
        echo $mensaje;
        $app->render('publicanoticia.html.twig',array(
            'mensaje' => $mensaje,
            'clase' => $clase
        ));
    }        
})->name('publicarnoticia');

$app->post('/buscarnoticia', function() use ($app) 
{
    if(isset($_POST['buscarnoticia']))
    {
        $datosNoticias = buscar_noticia($_POST['inputbuscarnoticias'],$_POST['filtradonoticia']);
    }
    $app->render('busquedanoticias.html.twig',array(
            'datos' => $datosNoticias
        ));
})->name('buscarnoticia');

$app->post('/publicacomentario', function() use ($app) 
{
    $mensajeError = null;
    if(isset($_POST['comentar']))
    {
        $existeNoticia = ORM::for_table('noticia')->where('id',$_POST['id'])->find_one();
        if(!empty($existeNoticia))
        {
            $mensaje = publica_comentario($_POST['comentario'], $_POST['id']);
            
            if($mensaje == false)
            {
                $mensaje = "Ha ocurrido algún error al enviar el comentario";
                $clase = "info error";
            }
            else
                $clase = "info";
            
            $comentarios = ORM::for_table('comentario')->
            select_many('comentario.comentario', 'comentario.fecha_publicad','usuario.nick')->
            join('usuario',array('comentario.usuario_id','=','usuario.id'))->
            where('noticias_id', $existeNoticia->id)->find_many();
            $nombreUsuario = ORM::for_table("usuario")->where('id',$existeNoticia->usuario_id)->find_one();
            $app->render('noticia.html.twig', array(
            'datos' => $existeNoticia,
            'autor' => $nombreUsuario->nick,
            'coments' => $comentarios,
            'mensaje' => $mensaje,
            'clase' => $clase
            ));
        }
        else
        {
            echo "Ha ocurrido algún error al enviar el comentario";
        }
        
    }
    
})->name('publicacomentario');

$app->get('/noticia/:idt', function($idt) use ($app) 
{
    $datosNoticia = ORM::for_table('noticia')->where('id',$idt)->find_one();
    
    if(empty($datosNoticia))
    {
        echo "No existe esa noticia";
    }
    else
    {
        $comentarios = ORM::for_table('comentario')->
            select_many('comentario.comentario', 'comentario.fecha_publicad','usuario.nick')->
            join('usuario',array('comentario.usuario_id','=','usuario.id'))->
            where('noticias_id', $datosNoticia->id)->find_many();
        $nombreUsuario = ORM::for_table("usuario")->where('id',$datosNoticia->usuario_id)->find_one();
        $app->render('noticia.html.twig', array(
        'datos' => $datosNoticia,
        'autor' => $nombreUsuario->nick,
        'coments' => $comentarios
        ));
        
    }
    
})->name('noticia');

$app->run();
?>
