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

function registrarse($nick, $contraseña, $email, $nombre, $apellido, $descripcion) {

    $ok = false;
    if ($nick != "" && $nick != null && $contraseña != "" &&
            $contraseña != null && $email != "" && $email != null &&
            comprueba_nick_existente($nick) == false) {
        $dbh = \ORM::getDb();
        $dbh->beginTransaction();
        try {
            $insertarUsuario = ORM::for_table('usuario')->create();
            $insertarUsuario->nick = $nick;
            $insertarUsuario->nombre = $nombre;
            $insertarUsuario->apellido = $apellido;
            $insertarUsuario->email = $email;
            $insertarUsuario->descripcion = $descripcion;
            $insertarUsuario->clave = $contraseña; // A pelo de momento, luego se hará encriptación
            $insertarUsuario->es_admin = 0; // 1 es que si es admin. Solo habrá un admin para pruebas

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

function comprueba_nick_existente($nicki) {
    $check = ORM::for_table('usuario')->where('nick', $nicki)->find_many();
    if (!empty($check)) {
        return true;
    }// Quiere decir que ya hay un usuario con ese nick
    else
        return false;
}

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

function login($nick, $contraseña, $app) {
    $compruebaLogin = ORM::for_table('usuario')->where("nick", $nick)->find_one();
    //if ($login === false || !password_verify($clave, $login->contraseña)) {
    if ($compruebaLogin === false || $contraseña != $compruebaLogin->clave) {
        $app->render('myfreakzone.html.twig', array(
            'mensaje' => 'Usuario y/o contraseña incorrectos',
            'clase' => 'info error'));
        //} else if (password_verify($clave, $login->contraseña)) {
    } else if ($contraseña == $compruebaLogin->clave) {
        $_SESSION['logeo'] = $compruebaLogin->nick;
        $app->render('inicio.html.twig', array('usuario' => $_SESSION['logeo']));
    }
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
            echo "La página a la que intentas acceder no existe";
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

function actualiza_material($variabl, $estado, $puntuacion, $progreso, $vista_en, $comentario) {
    $ok = false;
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    try{
        $variabl->estado = $estado;
        $variabl->puntuacion = $puntuacion;
        $variabl->capitulo_por_el_que_vas = $progreso;
        $variabl->vista_en = $vista_en;
        $variabl->comentario = $comentario;
        $variabl->save();
        $ok = true;
        $dbh->commit();
    }catch (\PDOException $e) {
        $dbh->rollback();
        $ok = false;
    }
    return $ok;
}

function agrega_material($variabl, $estado, $puntuacion, $progreso, $vista_en, $comentario, $idt) {
    $ok = false;
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    try{
        $variabl->estado = $estado;
        $variabl->puntuacion = $puntuacion;
        $variabl->capitulo_por_el_que_vas = $progreso;
        $variabl->vista_en = $vista_en;
        $variabl->comentario = $comentario;
        if($idt != -1)
        {
            $variabl->material_id = $idt;
            $iden = ORM::for_table('usuario')->where('nick',$_SESSION['logeo'])->find_one();
            $variabl->usuario_id = $iden->id;
            $variabl->save();
            $ok = true;
            $dbh->commit();
        }
        else{
            $ok = false;
            $dbh->rollback();
        }
    }catch (\PDOException $e) {
        $dbh->rollback();
        $ok = false;
    }
    return $ok;
}


function usuario_logeado($elNick) {
    if (isset($_SESSION['logeo']) && $_SESSION['logeo'] == $elNick)
        return true;
    else
        return false;
}

function publicar_noticia($titulo, $noticia, $fuente, $tags) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    if (CompruebaLongitud($titulo, 200, 4) == true &&
            CompruebaLongitud($noticia, 100000, 100) == true && CompruebaLongitud($tags, 200, 10) == true &&
            CompruebaLongitud($fuente, 200, -1) == true) {
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

function publica_comentario($comentario, $idNoticia) {
    $dbh = \ORM::getDb();
        $dbh->beginTransaction();
        if(CompruebaLongitud($comentario,500,10) == true)
        {
            try 
            {
                
                $insertarComentario = ORM::for_table('comentario')->create();
                $insertarComentario->comentario = $comentario;
                $insertarComentario->fecha_publicad = date("Y/m/d");
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
        }
        else
        {
            $ok = false;
           
        }
     return $ok;
}

function CompruebaLongitud($valor, $longitudMaxima, $longitudMinima) {
    if (strlen($valor) > $longitudMaxima || strlen($valor) < $longitudMinima)
        return false;
    else
        return true;
}

?>
