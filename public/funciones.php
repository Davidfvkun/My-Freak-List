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
    if (comprueba_longitud($nick, 30, 1) && comprueba_longitud($nick, 20, 8) &&
            preg_match("/[A-Za-z0-9_.]+@[A-Za-z]+[.]+[A-Za-z]+/", $email) &&
            comprueba_nick_existente($nick) == false && $contraseña == $contraseña2) {
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

            if ($_FILES['uploadedfile']['name'] == null || $_FILES['uploadedfile']['name'] == "") {
                $insertarUsuario->img_perfil = "/utilidades/image/perfil/default.png";
                $insertarUsuario->save();
            } else if (subir_archivo($nick)) {
                $insertarUsuario->img_perfil = "/utilidades/image/perfil/" . $nick . ".jpg";
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
 * @param $nickp Nombre con el que se guardará la imagen.
 * @return boolean True si se ha subido correctamente, False si no
 */

function subir_archivo($nickp) {
    $uploadedfileload = "true";
    //echo $_FILES['uploadedfile']['name'];
    //$msg = "";
    if ($_FILES['uploadedfile']['size'] > 200000) {
        //$msg = $msg . "El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
        $uploadedfileload = "false";
    }

    if (!($_FILES['uploadedfile']['type'] == "image/jpeg" OR $_FILES['uploadedfile']['type'] == "image/png")) {
        //$msg = $msg . " Tu archivo tiene que ser JPG o GIF o PNG. Otros archivos no son permitidos<BR>";
        $uploadedfileload = "false";
    }

    //$file_name = $_FILES['uploadedfile']['name'];
    $add = "utilidades/image/perfil/" . $nickp . ".jpg";
    if ($uploadedfileload == "true") {
        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $add)) {
            //echo " Ha sido subido satisfactoriamente";
            return true;
        } else {
            //echo "Error al subir el archivo";
            return false;
        }
    } else {
        return true;
        //echo $msg;
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
    $ultimasNoticias = ORM::for_table('noticia')->order_by_desc('fecha_publicado')->limit(2)->find_many();
    return $ultimasNoticias;
}

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
    $buscaUsuario = $buscaUsuario->find_many();
    return $buscaUsuario;
}

/*
 * Busqueda de una serie/pelicula/anime filtrando por X campo
 * @param string $busqueda Cadena por la que filtrar
 * @param string $V tipo de material por el que filtrar
 * @return object
 */

function buscar_material($busqueda, $V) {

    $buscaMaterial = ORM::for_table('material');
    $cadena = "";
    $arr = array();
    $sep = false;
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
    $cadena = $cadena . ")";
    if (strlen($busqueda) > 2) {
        $buscaMaterial = $buscaMaterial->where_raw($cadena, $arr)->where_like('nombre', '%' . $busqueda . '%');
    } else {
        $buscaMaterial = $buscaMaterial->where_raw($cadena, $arr)->where_like('nombre', $busqueda . '%');
    }
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
            echo "La página a la que intentas acceder no existe";
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
        default:
            $GLOBALS['mensaje'] = $GLOBALS['mensaje'] . "que tienes borradas. ";
            $idEstado = 4;
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
                        where('usuario.id', $idUsuario->id)->find_many();
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

function editar_usuario($nombre, $apellido, $descripcion) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    $ok = false;
    try {
        $editarUsuario = ORM::for_table('usuario')->where('nick', $_SESSION['logeo'])->find_one();

        $editarUsuario->nombre = $nombre;
        $editarUsuario->apellido = $apellido;
        $editarUsuario->descripcion = $descripcion;
        $editarUsuario->save();
        $ok = true;
        $dbh->commit();
    } catch (\PDOException $e) {
        $dbh->rollback();
        $ok = false;
    }

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
            comprueba_longitud($vista_en, 100, -1) == true && comprueba_longitud($vista_en, 500, -1) == true) {
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
    if ($puntuacion >= 0 && $puntuacion <= 10 && $progreso >= 0 && $progreso <= 30000 && is_number($puntuacion) && is_number($progreso) &&
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
                //$mensajeError = "No existe usuario con ese nick";
                $buscarNoticias = null;
            } else {
                $buscarNoticias = $buscarNoticias->where('usuario_id', $idUsuario->id)->find_many();
                /* if(empty($buscarNoticias))
                  $mensajeError = "Ese usuario no ha publicado ninguna noticia"; */
            }
            break;
        case 2:
            $datosBusqueda = explode(",", $busqueda);
            $datosConsulta = array();

            for ($i = 0; $i < count($datosBusqueda); $i++) {
                $consultaSimple = $buscarNoticias->where_like('etiquetas', '%' . $datosBusqueda[$i] . '%')->find_many();
                $datosConsulta = array_merge($datosConsulta, $consultaSimple);
            }
            $buscarNoticias = $datosConsulta;
            /* if(empty($buscarNoticias))
              $mensajeError = "No existen noticias con esos tags"; */
            break;
        case 3:
            $buscarNoticias = $buscarNoticias->where_like('noticia', '%' . $busqueda . '%')->find_many();
            /* if(empty($buscarNoticias))
              $mensajeError = "No existen noticias con ese contenido"; */
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

function mensajes_privados($idUsuario) {
    $mensaje = ORM::for_table('mensaje')->
            where_raw('`usuario_e` = ? OR `usuario_r` = ?', array($idUsuario, $idUsuario))->
            find_many();
    return $mensaje;
}

function mensajes_privados_contenido($usuario)
{
    $idUsuario = ORM::for_table('usuario')->where('nick',$usuario)->find_one();
    $mensaje = ORM::for_table('mensaje')->
            where_raw('`usuario_e` = ? OR `usuario_r` = ?', array($idUsuario->id, $idUsuario->id))->
            find_many();
    return $mensaje;
}

function enviar_mensaje_privado($mensaje, $priv)
{
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    $existeUsuario = ORM::for_table('usuario')->where('nick',$priv)->find_one();
    if(empty($existeUsuario) || comprueba_longitud($mensaje, 500, 1))
    {
        try 
        {
            $guardar = ORM::for_table('mensaje')->create();
            $guardar->usuario_e = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one()->id;
            $guardar->usuario_r = $existeUsuario->id;
            $guardar->mensaje = $mensaje;
            $guardar->fecha_enviado = date("Y-m-d H:i:s");
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
        /*$mensaje->usuario_e = $aux->nick;
        $mensaje->usuario_r = $aux2->nick;
        echo "<br/>El usuario " . $mensaje->usuario_e .
        " ha enviado el mensaje '" . $mensaje->mensaje . "' al usuario " . $mensaje->usuario_r;*/
    }
    return $conjuntoUsuarios;
}

function publicar_material($nombre, $sinopsis, $anio, $tipo)
{
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if(comprueba_longitud($nombre, 200, 1) && comprueba_longitud($sinopsis, 10000,0) && $tipo >= 1  && $tipo <= 3)
    {
        try
        {
            $usuarioAdmin = ORM::for_table('usuario')->where('es_admin',1)->find_one();
            $mensajePrivado = ORM::for_table('mensaje')->create();
            $mensajePrivado->usuario_r = $usuarioAdmin->id;
            $mensajePrivado->usuario_e = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one()->id;
            $mensajePrivado->mensaje = "Nombre: ".$nombre." Sinopsis: ".$sinopsis." Año: ".$anio. " Tipo: ".$tipo;
            $mensajePrivado->fecha_enviado = date("Y-m-d H:i:s");
            $mensajePrivado->save();
            $dbh->commit();
            $ok = true;
         } catch (\PDOException $e) 
         {
             $dbh->rollback();
             $ok = false;
         }
         $ok = true;
    }
    else
        $ok = false;
   
    return $ok;
}

?>
