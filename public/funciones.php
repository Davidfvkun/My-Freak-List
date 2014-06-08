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
require_once "../config.php";

/*
 *  Permite registrarse en el sitio web
 * 
 *  @param string $nick Nick/alias que usarás en el sitio web.
 *  @param string $contraseña Contraseña que usarás para logearte en el sitio web.
 *  @param string $contraseña2 Para verificar que has puesto bien la contraseña
 *  @param string $email Tu Email para enviarse la confirmación al sitio, publicidad, poder recuperar tu contraseña etc
 *  @param string $nombre Nombre, opcional
 *  @param string $apellido Apellido, opcional
 *  @param string $descripcion Datos sobre ti que quieras que aparezcan en tu perfil, opcional
 *  @return boolean Será True si se ha registrado correctamente o False si ha ocurrido algún error
 */

function registrarse($nick, $contraseña, $contraseña2, $email, $nombre, $apellido, $descripcion) {

    $ok = false;
    if (comprueba_longitud($nick, 30, 1) && comprueba_longitud($contraseña, 20, 7) &&
            preg_match("/[A-Za-z0-9_.]+@[A-Za-z]+[.]+[A-Za-z]+/", $email) &&
            comprueba_nick_existente($nick) == false && $contraseña == $contraseña2 && 
            preg_match("/^[áéíóúÁÉÍÓÚA-Za-z ]{0,45}$/", $nombre) && preg_match("/^[áéíóúÁÉÍÓÚA-Za-z ]{0,45}$/", $apellido)
            && preg_match("/^[áéíóúÁÉÍÓÚA-Za-z,. ]{0,45}$/", $descripcion)) {
        $dbh = \ORM::getDb();
        $dbh->beginTransaction();
        try {
            $insertarUsuario = ORM::for_table('usuario')->create();
            $insertarUsuario->nick = $nick;
            $insertarUsuario->nombre = $nombre;
            $insertarUsuario->apellido = $apellido;
            $insertarUsuario->email = $email;
            $insertarUsuario->descripcion = $descripcion;
            $insertarUsuario->clave = password_hash($contraseña, PASSWORD_DEFAULT);
            $insertarUsuario->es_admin = 0;
            $insertarUsuario->activo = 1;

            if ($_FILES['uploadedfile']['name'] == null || $_FILES['uploadedfile']['name'] == "") {
                $insertarUsuario->img_perfil = "/utilidades/image/perfil/default.png";
                $insertarUsuario->save();
            } else if (subir_archivo($nick, 1)) {
                if($_FILES['uploadedfile']['type'] == "image/jpeg")
                    $insertarUsuario->img_perfil = "/utilidades/image/perfil/".$nick.".jpg";
                else if($_FILES['uploadedfile']['type'] == "image/png")
                    $insertarUsuario->img_perfil = "/utilidades/image/perfil/".$nick.".png";
                else
                    $insertarUsuario->img_perfil = "/utilidades/image/perfil/default.png";
                    
                $insertarUsuario->save();
            } else {
                $dbh->rollback();
                return false;
            }
            $ok = true;
            $dbh->commit();
        } catch (\PDOException $e) {
            $dbh->rollback();
            $ok = false;
        }
    }
    return $ok;
}

/*
 * Comprueba que el nick con el que te vas a registrar en el sitio no existe en el sistema,
 * es decir, no lo está usando otra persona
 * 
 * @param string $nick Nick introducido.
 * @return boolean Será True si el nick existe y False si no existe
 */

function comprueba_nick_existente($nicki) {
    $check = ORM::for_table('usuario')->where('nick', $nicki)->find_many();
    if (!empty($check)) {
        return true;
    }// Quiere decir que ya hay un usuario con ese nick
    else
        return false;
}

/*
 * Subir una imagen de perfil.
 * 
 * @param string $nickp Nombre con el que se guardará la imagen.
 * @param int $opcion Opción que indica si la imagen es de perfil o de material
 * @return boolean True si se ha subido correctamente, False si no
 */

function subir_archivo($nickp, $opcion) {
    $uploadedfileload = "true";
    if ($_FILES['uploadedfile']['size'] > 600000) {
        // El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo";
        $uploadedfileload = "false";
    }

    if (!($_FILES['uploadedfile']['type'] == "image/jpeg" OR $_FILES['uploadedfile']['type'] == "image/png")) {
        // Tu archivo tiene que ser JPG o GIF o PNG. Otros archivos no son permitidos;
        $uploadedfileload = "false";
    }
    if($opcion == 1 && $_FILES['uploadedfile']['type'] == "image/jpeg")
        $add = "utilidades/image/perfil/" . $nickp . ".jpg";
    else if($opcion == 1 && $_FILES['uploadedfile']['type'] == "image/png")
        $add = "utilidades/image/perfil/" . $nickp . ".png";
    else if($opcion == 2 && $_FILES['uploadedfile']['type'] == "image/png")
        $add = "utilidades/image/material/" . $nickp . ".png";
    else if($opcion == 2 && $_FILES['uploadedfile']['type'] == "image/jpeg")
        $add = "utilidades/image/material/" . $nickp . ".jpg";
    
    if ($uploadedfileload == "true") {
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $add)) {
            //Ha sido subido satisfactoriamente
            return true; 
        } else {
            //e Error al subir el archivo;
            return false; 
        }
    } else {
        return true; 
    }
}

/*
 * Logearse en la aplicación.
 * @param $nick Nick con el que te registraste
 * @param $contraseña Clave con la que te registraste
 * @return boolean False si el nick y/o contraseña son incorrectos, True si son correctos
 */

function login($nick, $contraseña) {
    $compruebaLogin = ORM::for_table('usuario')->where("nick", $nick)->find_one();
    if ($compruebaLogin === false || !password_verify($contraseña, $compruebaLogin->clave)) {
        return false;
    } else if (password_verify($contraseña, $compruebaLogin->clave)) {
        $_SESSION['logeo'] = $compruebaLogin->nick;
        return true;
    }
}

/*
 *  Devuelve las ultimas noticias publicadas por los usuarios
 *  @return array
 */

function ultimas_noticias() {
    $ultimasNoticias = ORM::for_table('noticia')->order_by_desc('fecha_publicado')->limit(4)->find_many();
    return $ultimasNoticias;
}

/*
 * Permite buscar usuarios filtrando por diversos campos
 * @param string $busqueda Palabra por la que buscas
 * @param int $filtrado Campo por el que filtras
 * @return object Objeto que contiene los datos que se devuelven de la base de datos
 */

function buscar_usuarios($busqueda, $filtrado) {
    $buscaUsuario = ORM::for_table('usuario');
    switch ($filtrado) {
        case "1":
            $buscaUsuario = $buscaUsuario->where_like("nombre", "%" . $busqueda . "%");
            break;
        case "2":
            $buscaUsuario = $buscaUsuario->where_like("nick", "%" . $busqueda . "%");
            break;
        case "3":
            $idMaterial = ORM::for_table("material")->where_like("nombre", "%" . $busqueda . "%")->find_one();
            $buscaUsuario = $buscaUsuario->
                    join("material_usuario", array("usuario.id", "=", "material_usuario.usuario_id"))->
                    where('material_usuario.material_id', $idMaterial->id);
        default:
            $buscaUsuario = $buscaUsuario->where_like("nombre", "%" . $busqueda . "%"); // Si alguien cambia el value de ese select aplicamos case 1
            break;
    }
    return $buscaUsuario;
}

/*
 * Busqueda de una serie/pelicula/anime filtrando por X campo
 * @param string $busqueda Cadena por la que filtrar
 * @param string $V tipo de material por el que filtrar
 * @return object
 */

function buscar_material($busqueda, $V, $genero) {

    $buscaMaterial = ORM::for_table('material');
    $cadena = "";
    $arr = array();
    $sep = false;
    /* Array de tipos */
    if ($V[0] == 1) {
        $cadena = $cadena . "(`tipo` = ? ";
        $arr[count($arr)] = 1;
        $sep = true;
    }
    if ($V[1] == 1) {
        $sep = true;
        if ($cadena != "")
            $cadena = $cadena . "OR `tipo` = ? ";
        else
            $cadena = $cadena . "(`tipo` = ? ";
        $arr[count($arr)] = 2;
    }
    if ($V[2] == 1) {
        $sep = true;
        if ($cadena != "")
            $cadena = $cadena . "OR `tipo` = ?";
        else
            $cadena = $cadena . "`tipo` = ?";

        $arr[count($arr)] = 3;
    }
    //////////////////////////
    
    $cadena = $cadena . ")";
    if (strlen($busqueda) > 2) {
        $buscaMaterial = $buscaMaterial->where_raw($cadena, $arr)->where_like('nombre', '%' . $busqueda . '%')->where('publicado',1);
    } else {
        $buscaMaterial = $buscaMaterial->where_raw($cadena, $arr)->where_like('nombre', $busqueda . '%')->where('publicado',1);
    }
    
    if($genero != "No filtrar")
        $buscaMaterial = $buscaMaterial->where_like('genero', '%' . $genero . '%');
    return $buscaMaterial;
}

/*
 * Funcióna para mostrar el listado de las series/peliculas/animes de un usuario
 * @param string $idt Tipo de material que vas a listar (Anime/Serie/Peli)
 * @param string $ide Estado de ese material (Visto, pendiente etc)
 * @param string $nicku Nick del usuario
 * @param array
 */

function listados($idt, $ide, $nicku) {
    switch ($idt) {
        case "series":
            $idTipo = 1;
            $GLOBALS['mensaje'] = "Series ";
            break;
        case "animes":
            $idTipo = 2;
            $GLOBALS['mensaje'] = "Animes ";
            break;
        case "peliculas":
            $GLOBALS['mensaje'] = "Peliculas ";
            $idTipo = 3;
            break;
        default:
            return -1;
            break;
    }
    switch ($ide) {
        case "vistas":
            $idEstado = 1;
            $GLOBALS['mensaje'] = $GLOBALS['mensaje'] . "que has visto. ";
            break;
        case "viendo":
            $GLOBALS['mensaje'] = $GLOBALS['mensaje'] . "que estás viendo. ";
            $idEstado = 2;
            break;
        case "pendientes":
            $GLOBALS['mensaje'] = $GLOBALS['mensaje'] . "que tienes pendientes. ";
            $idEstado = 3;
            break;
        case "borradas":
            $GLOBALS['mensaje'] = $GLOBALS['mensaje'] . "que tienes borradas. ";
            $idEstado = 4;
            break;
        default:
            return -1;
            break;
    }

    $idUsuario = ORM::for_table('usuario')->select('id')->where("nick", $nicku)->find_one();
    if (!empty($idUsuario)) {
        $buscaCosa = ORM::for_table('material')->
                        select_many('material.nombre', 'material.n_capitulos', 'material_usuario.capitulo_por_el_que_vas', 'material_usuario.puntuacion', 'material_usuario.material_id', 'material_usuario.vista_en', 'material_usuario.comentario')->
                        join('material_usuario', array('material.id', '=', 'material_id'))->
                        join('usuario', array('usuario_id', '=', 'usuario.id'))->
                        where('material.tipo', $idTipo)->
                        where('material_usuario.estado', $idEstado)->
                        where('usuario.id', $idUsuario->id)->order_by_asc('material.nombre')->find_many();
    }
    else
        $buscaCosa = -1;
    return $buscaCosa;
}

/*
 * Función para editar datos del usuario
 * @param string $nombre Nombre nuevo
 * @param string $apellido Apellido nuevo
 * @param string $descripción Descripción nueva
 * @return boolean, True si se han modificado correctamente, False si no.
 */

function editar_usuario($nombre, $apellido, $descripcion, $contraseñaantigua, $contraseñanueva) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    $ok = false;
    if(preg_match("/^[áéíóúÁÉÍÓÚA-Za-z ]{0,45}$/", $nombre) && preg_match("/^[áéíóúÁÉÍÓÚA-Za-z ]{0,45}$/", $apellido)
            && preg_match("/^[áéíóúÁÉÍÓÚA-Za-z,. ]{0,45}$/", $descripcion))
    {
        try {
            $editarUsuario = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();
            $editarUsuario->nombre = $nombre;
            $editarUsuario->apellido = $apellido;
            $editarUsuario->descripcion = $descripcion;
            if($contraseñaantigua != "" && $contraseñaantigua != null)
            {
                if(login($_SESSION['logeo'], $contraseñaantigua) && comprueba_longitud($contraseñanueva, 20, 7))
                {
                    $editarUsuario->clave = password_hash($contraseñanueva, PASSWORD_DEFAULT);
                }
                else
                {
                    $GLOBALS['error'] = "Error al cambiar la contraseña";
                    $dbh->rollback();
                    return false;
                }
                
            }
            
            if ($_FILES['uploadedfile']['name'] != null && $_FILES['uploadedfile']['name'] != "") {
                if(subir_archivo($_SESSION['logeo'],1)){
                    if($_FILES['uploadedfile']['type'] == "image/jpeg")
                            $editarUsuario->img_perfil = "/utilidades/image/perfil/".$_SESSION['logeo'].".jpg";
                    else if($_FILES['uploadedfile']['type'] == "image/png")
                            $editarUsuario->img_perfil = "/utilidades/image/perfil/".$_SESSION['logeo'].".png";
                }
                else{
                    $dbh->rollback();
                    return false;
                }

            }
            $editarUsuario->save();
            $ok = true;
            $dbh->commit();
        } catch (\PDOException $e) {
            $dbh->rollback();
            $ok = false;
        }
    }
    else
        $ok = false;
    return $ok;
}

/*
 * Función para comprobar el estado de un material
 * 
 * @param int $estado Estado en el que está el material (Visto, pendiente etc)
 * @return int $guardar Estado en el que se guardará el material
 */

function comprueba_estado($estado) {
    $guardar = 0;
    if ($estado == 1)
        $guardar = 1;
    else if ($estado == 2)
        $guardar = 2;
    else if ($estado == 3)
        $guardar = 3;
    else
        $guardar = 4;
    return $guardar;
}

/*
 * Le da al usuario administrador los materiales o noticias no publicados entre las fechas elegidas
 * @param $tabla La tabla en la que vas a buscar el campo: material o noticia.
 * @param $fecha1 Fecha desde la que quieres que se muestren materiales
 * @param $fecha2 Fecha hasta la que quieres que se muestren materiales
 */

function dame_no_publicados($tabla,$fecha1,$fecha2)
{
    if($tabla == "material")
        $public = "publicado";
    else
        $public = "publicada";
     return ORM::for_table($tabla)->where_gte('fecha_publicado', $fecha1)->
             where_lte('fecha_publicado', $fecha2)->where($public,0)->find_many();
    
}
/*
 * Actualizar los datos de una serie/peli/anime
 * @param object $variabl Objeto del ORM.
 * @param int $estado Estado en el que guardas el material(serie/peli/anime)
 * @param int $puntuacion Nota que le das a esa serie/peli/anime
 * @param int $progreso Capítulo por el que vas
 * @param string $vista_en Donde la vista
 * @param string $comentario Comentario que quieras añadir sobre ese material
 * @param int $fav Puede valer 1 o 0 dependiendo de si está en tus favoritos o no
 * @return boolean True si se ha actualizado correctamente, False si no
 */

function actualiza_material($variabl, $estado, $puntuacion, $progreso, $vista_en, $comentario, $fav) {
    $ok = false;
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if ($puntuacion >= 0 && $puntuacion <= 10 && $progreso >= 0 && $progreso <= 30000 &&
            comprueba_longitud($vista_en, 100, -1) == true && comprueba_longitud($comentario, 200, -1) == true) {
        try {
            $variabl->estado = comprueba_estado($estado);
            $variabl->puntuacion = $puntuacion;
            $variabl->capitulo_por_el_que_vas = $progreso;
            $variabl->vista_en = $vista_en;
            $variabl->comentario = $comentario;
            $variabl->favorito = $fav;
            $variabl->save();
            $ok = true;
            $dbh->commit();
        } catch (\PDOException $e) {
            $dbh->rollback();
            $ok = false;
        }
    }
    else
        $ok = false;
    return $ok;
}

/*
 * Agregar un nuevo material a tu lista
 * @param object $variabl Objeto del ORM.
 * @param int $estado Estado en el que guardas el material(serie/peli/anime)
 * @param int $puntuacion Nota que le das a esa serie/peli/anime
 * @param int $progreso Capítulo por el que vas
 * @param string $vista_en Donde la vista
 * @param string $comentario Comentario que quieras añadir sobre ese material
 * @param int $fav Puede valer 1 o 0 dependiendo de si está en tus favoritos o no
 * @return boolean True si se ha actualizado correctamente, False si no
 */

function agrega_material($variabl, $estado, $puntuacion, $progreso, $vista_en, $comentario, $idt, $fav) {
    $ok = false;
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if ($puntuacion >= 0 && $puntuacion <= 10 && $progreso >= 0 && $progreso <= 30000 && is_numeric($puntuacion) && is_numeric($progreso) &&
            comprueba_longitud($vista_en, 100, -1) == true && comprueba_longitud($vista_en, 500, -1) == true) {
        try {
            $variabl->estado = comprueba_estado($estado);
            $variabl->puntuacion = $puntuacion;
            $variabl->capitulo_por_el_que_vas = $progreso;
            $variabl->vista_en = $vista_en;
            $variabl->comentario = $comentario;
            $variabl->favorito = $fav;
            if ($idt != -1) {
                $variabl->material_id = $idt;
                $iden = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();
                $variabl->usuario_id = $iden->id;
                $variabl->save();
                $ok = true;
                $dbh->commit();
            } else {
                $ok = false;
                $dbh->rollback();
            }
        } catch (\PDOException $e) {
            $dbh->rollback();
            $ok = false;
        }
    }
    else
        $ok = false;
    return $ok;
}

/* Comprueba si hay un usuario logeado
 * @return boolean True si está logeado, False si no.
 */

function usuario_logeado() {
    if (isset($_SESSION['logeo']))
        return true;
    else
        return false;
}

/*
 * Publicar una noticia en el sitio web.
 * @param string $titulo Titulo de la noticia
 * @param string $noticia Contenido de la noticia
 * @param string $fuente Fuente de donde sacaste la noticia
 * @param string $tags Identificadores, etiquetas.
 * @return boolean, True si se ha publicado correctamente, False si no
 */

function publicar_noticia($titulo, $noticia, $fuente, $tags) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if (comprueba_longitud($titulo, 200, 4) == true &&
            comprueba_longitud($noticia, 100000, 100) == true && comprueba_longitud($tags, 200, 10) == true &&
            comprueba_longitud($fuente, 200, -1) == true) {
        try {
            $insertarNoticia = ORM::for_table('noticia')->create();
            $insertarNoticia->titulo = $titulo;
            $insertarNoticia->fecha_publicado = date("Y/m/d");
            $insertarNoticia->noticia = $noticia;
            $insertarNoticia->fuente = $fuente;
            $insertarNoticia->etiquetas = $tags;
            $insertarNoticia->publicada = 0;
            $id = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();
            $insertarNoticia->usuario_id = $id->id;
            $insertarNoticia->save();
            $ok = true;
            $dbh->commit();
        } catch (\PDOException $e) {
            $dbh->rollback();
            $ok = false;
        }
    } else {
        $ok = false;
    }
    return $ok;
}

/*
 * Buscar una noticia.
 * @param string $busqueda cadena por la que buscas
 * @param string $filtrado Tipo de dato por el que filtras
 * @return array
 */

function buscar_noticia($busqueda, $filtrado) {
    $buscarNoticias = ORM::for_table("noticia");
    //$mensajeError = null;
    switch ($filtrado) {
        case 1:
            $idUsuario = ORM::for_table('usuario')->where("nick", $busqueda)->find_one();
            if (empty($idUsuario)) {
                $buscarNoticias = null;
            } else {
                $buscarNoticias = $buscarNoticias->where('usuario_id', $idUsuario->id);
            }
            break;
        case 2:
            $buscarNoticias = $buscarNoticias->where_like('etiquetas', '%' . $busqueda . '%');
            break;
        case 3:
            $buscarNoticias = $buscarNoticias->where_like('noticia', '%' . $busqueda . '%');
            break;
        default:
    }
    return $buscarNoticias;
}

/*
 * Publicar un comentario en una noticia
 * @param string $comentario Comentario a publicar
 * @param string $idNoticia Noticia en la que pones el comentario
 * @return boolean True si se ha publicado correctamente, False si no
 */

function publica_comentario($comentario, $idNoticia) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if (comprueba_longitud($comentario, 500, 10) == true) {
        try {

            $insertarComentario = ORM::for_table('comentario')->create();
            $insertarComentario->comentario = $comentario;
            $insertarComentario->fecha_publicad = date("Y/m/d H:i:s");
            $insertarComentario->noticias_id = $idNoticia;
            $id = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();
            $insertarComentario->usuario_id = $id->id;
            $insertarComentario->save();
            $ok = true;
            $dbh->commit();
        } catch (\PDOException $e) {
            $dbh->rollback();
            $ok = false;
        }
    } else {
        $ok = false;
    }
    return $ok;
}

/*
 * Comprueba la longitud de una cadena
 * @param string $valor Cadena a comprobar
 * @param int $longitudMaxima Longitud maxima que podrá tener esa cadena
 * @param int $longitudMinima Longitud minima que podrá tener esa cadena
 */

function comprueba_longitud($valor, $longitudMaxima, $longitudMinima) {
    if (strlen($valor) > $longitudMaxima || strlen($valor) < $longitudMinima)
        return false;
    else
        return true;
}

/*
 * Devuelve los materiales favoritos de un usuario
 * @param int $idUsuario Id del usuario del perfil al que accedes.
 * @return array
 */

function favoritos($idUsuario) {
    $fav = ORM::for_table('material')->select_many('material.nombre', 'material.img_material', 'material.id')->
                    join('material_usuario', array('material.id', '=', 'material_usuario.material_id'))->
                    where('material_usuario.usuario_id', $idUsuario)->
                    where('material_usuario.favorito', 1)->find_many();
    return $fav;
}

/*
 * Devuelve los mensajes privados de un usuario
 * 
 * @param string $idUsuario Id del usuario del que se muestran los mensajes
 * @return array $mensaje Contiene dichos mensajes
 */

function mensajes_privados($idUsuario) {
    $mensaje = ORM::for_table('mensaje')->
            where_raw('`usuario_e` = ? OR `usuario_r` = ?', array($idUsuario, $idUsuario))->
            find_many();
    return $mensaje;
}

/*
 * Devuelve los mensajes privados entre dos usuarios concretos (Tu y otro)
 * 
 * @param string $usuario El nick del usuario
 * @return array
 */

function mensajes_privados_contenido($usuario)
{
    $yo = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
    $idUsuario = ORM::for_table('usuario')->where('nick',$usuario)->find_one();
    if(!empty($idUsuario)){
        $mensaje = ORM::for_table('mensaje')->
                where_raw('`usuario_e` = ? OR `usuario_r` = ?', array($idUsuario->id, $idUsuario->id))->
                where_raw('`usuario_e` = ? OR `usuario_r` = ?', array($yo->id, $yo->id))->
                find_many();
        foreach($mensaje as $aux){
            if($aux->usuario_r == ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one()->id){
                $aux->leido = 1;
                $aux->save();
            }
        }
    }
    else
        $mensaje = null;
    return $mensaje;
}

/*
 * Devuelve los mensajes no leidos para notificar al usuario que tiene esos mensajes sin leer
 * 
 * @return array $mensajes_recibidos
 */

function mensajes_no_leidos()
{
    $cadena = "";
    $yo = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
    $mensajes = ORM::for_table('mensaje')->where('usuario_r',$yo->id)->where('leido',0)->find_many();
    $mensajes_recibidos = array();
    foreach($mensajes as $aux)
    {
        $mensajes_recibidos[count($mensajes_recibidos)] = ORM::for_table('usuario')->where('id',$aux->usuario_e)->find_one()->nick;
    }
    return $mensajes_recibidos;
    
    
}

/*
 * Envia un mensaje privado a un usuario
 * 
 * @param string $mensaje El mensaje que se va a enviar
 * @return string $priv El nick del usuario al que se va a enviar el mensaje
 */

function enviar_mensaje_privado($mensaje, $priv)
{
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    $existeUsuario = ORM::for_table('usuario')->where('nick',$priv)->find_one();
    if(!empty($existeUsuario)&& comprueba_longitud($mensaje, 500, 1))
    {
        try 
        {
            $guardar = ORM::for_table('mensaje')->create();
            $guardar->usuario_e = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one()->id;
            $guardar->usuario_r = $existeUsuario->id;
            $guardar->mensaje = $mensaje;
            $guardar->fecha_enviado = date("Y-m-d H:i:s");
            $guardar->leido = 0; // No leido
            $guardar->save();
            $dbh->commit();
            $ok = true;
         } catch (\PDOException $e) 
         {
             $dbh->rollback();
             $ok = false;
         }
    }
    else
        $ok = false;
    return $ok;
}

/*
 * Devuelve el conjunto de usuarios con los que te has enviado mensajes privados
 * 
 * @param array $mensajes Mensajes ue tienes
 * @return int $id Id de los usuarios
 */

function usuarios_mensajeados($mensajes, $id) {
    $nUsuarios = 0;
    $conjuntoUsuarios = array();
    foreach ($mensajes as $mensaje) {
        $aux = ORM::for_table("usuario")->find_one($mensaje->usuario_e);
        $aux2 = ORM::for_table("usuario")->find_one($mensaje->usuario_r);
        if ($mensaje->usuario_e == $id && in_array($aux2->nick, $conjuntoUsuarios) == false) {
            $conjuntoUsuarios[$nUsuarios] = $aux2->nick;
            $nUsuarios++;
        } else if ($mensaje->usuario_r == $id && in_array($aux->nick, $conjuntoUsuarios) == false) {
            $conjuntoUsuarios[$nUsuarios] = $aux->nick;
            $nUsuarios++;
        }
    }
    return $conjuntoUsuarios;
}

/*
 * Función para publicar un nuevo material. Se le envia un mensaje privado al usuario administrador
 * con los datos de ese material. Ese administrador será el encargado de decidir publicarlo o no
 * 
 * @param string $nombre Nombre del material
 * @param string $sinopsis Sinopsis del material
 * @param string $anio Año del material
 * @param int $tipo Tipo del material (Serie/Anime/Película)
 * @return boolean $ok Devuelve true o false según si se ha enviado correctamente la notificación al usuario
 */

function publicar_material($nombre, $sinopsis, $anio, $tipo, $genero)
{
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if(comprueba_longitud($nombre, 200, 1) && comprueba_longitud($sinopsis, 10000,0) && 
            $tipo >= 1  && $tipo <= 3 && is_numeric($anio) && strlen($anio) == 4)
    {
        try
        {
            $id = count(ORM::for_table('material')->find_many()) + 1;
            $insertaMaterial = ORM::for_table('material')->create();
            $insertaMaterial->nombre = $nombre;
            $insertaMaterial->tipo = $tipo;
            $insertaMaterial->sinopsis = $sinopsis;
            $insertaMaterial->anio = $anio;
            $insertaMaterial->genero = $genero;
            $insertaMaterial->fecha_publicado = date("Y/m/d");
            $insertaMaterial->img_material = "/utilidades/image/material/default.png";
                
            $insertaMaterial->publicado = 0; 
            $insertaMaterial->save();
            $dbh->commit();
            $ok = true;
         } catch (\PDOException $e) 
         {
             $dbh->rollback();
             $ok = false;
         }
    }
    else
        $ok = false;
   
    return $ok;
}

/*
 * Se encarga de aceptar y poner como publicado un material. Lo hace el administrador, basandose
 * en los campos que publicó algún usuario normal.
 * @param string $nombre Nombre del material
 * @param string $sinopsis Sinopsis del material
 * @param int $tipo Indica si es una serie/anime/película
 * @param string $genero Generos del material
 * @param int $id Número identificador del material
 * @param boolean $ok Devuelve true o false dependiendo de si se ha guardado correctamente o ha ocurrido algún error
 */

function aceptar_material($nombre, $sinopsis, $anio, $tipo, $genero, $id)
{
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if(comprueba_longitud($nombre, 200, 1) && comprueba_longitud($sinopsis, 10000,0) && $tipo >= 1  && $tipo <= 3)
    {
        try
        {
            $material = ORM::for_table('material')->find_one($id);
            $material->nombre  = $nombre;
            $material->sinopsis = $sinopsis;
            $material->anio = $anio;
            $material->tipo = $tipo;
            $material->genero = $genero;
            $material->publicado = 1;
            if ($_FILES['uploadedfile']['name'] == null || $_FILES['uploadedfile']['name'] == "") {
                   $material->img_material = "/utilidades/image/perfil/default.png";
            } else if (subir_archivo($id, 2)) {
                   if($_FILES['uploadedfile']['type'] == "image/jpeg")
                      $material->img_material = "/utilidades/image/material/".$id.".jpg";
                   else if($_FILES['uploadedfile']['type'] == "image/png")
                      $material->img_material = "/utilidades/image/material/".$id.".png";
                   else
                      $material->img_material = "/utilidades/image/material/default.png";
             }
             $material->save();
            $dbh->commit();
            $ok = true;
         } catch (\PDOException $e) 
         {
             $dbh->rollback();
             $ok = false;
         }
    }
    else
        $ok = false;
    return $ok;
}

function eliminar_cuenta()
{
    $usuario = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
    $usuario->activo = 0;
    $usuario->save();
}

/*
 * Borra una noticia
 * @param int $idNoticia Identificador de la noticia
 * @return boolean $ok Devuelve true o false dependiendo de si se ha borrado correctamente o no
 */

function borrar_noticia($idNoticia)
{
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    $laNoticia = ORM::for_table('noticia')->find_one($idNoticia);
    $ok = false;
    if($laNoticia->usuario_id == ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one()->id)
    {
        try
        {
            $laNoticia->delete();
            $ok = true;
        } catch (\PDOException $e) 
        {
             $dbh->rollback();
             $ok = false;
        }
    }
    return $ok;
}

?>
