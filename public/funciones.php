<?php

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
        $_SESSION[$compruebaLogin->nick] = $compruebaLogin->nick;
        $app->render('inicio.html.twig');
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
        default:
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
    $buscaMaterial = $buscaMaterial->where_raw($cadena, $arr)->where_like('nombre', '%' . $busqueda . '%');
    /* if ($sep)
      $cadena = $cadena . ") AND nombre like '%" . $busqueda . "%'";
      else
      $cadena = $cadena . "WHERE nombre like '%" . $busqueda . "%'"; */

    //$consulta = $consulta . $cadena;
    return $buscaMaterial; // Primero haré unos inserts SQL para poder probar esto.
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
            echo "Mostrar mensaje de error o algo";
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
            echo "Mostrar mensaje de error o algo";
            break;
    }

    $idUsuario = ORM::for_table('usuario')->select('id')->where("nick", $nicku)->find_one();

    $buscaCosa = ORM::for_table('material')->
                    select_many('material.nombre', 'material.n_capitulos', 'material_usuario.capitulo_por_el_que_vas', 'material_usuario.puntuacion', 'material_usuario.material_id', 'material_usuario.vista_en', 'material_usuario.comentario')->
                    join('material_usuario', array('material.id', '=', 'material_id'))->
                    join('usuario', array('usuario_id', '=', 'usuario.id'))->
                    where('material.tipo', $idTipo)->
                    where('material_usuario.estado', $idEstado)->
                    where('usuario.id', $idUsuario->id)->find_many();
    return $buscaCosa;
}

function editar_usuario($nombre, $apellido, $descripcion) {
    $editarUsuario = ORM::for_table('usuario')->where('nick', 'davidnick')->find_one();

    $editarUsuario->nombre = $nombre;
    $editarUsuario->apellido = $apellido;
    $editarUsuario->descripcion = $descripcion;
    $editarUsuario->save();
    return true;
}

function usuario_logeado($elNick) {
    if (isset($_SESSION[$elNick]) && $_SESSION[$elNick] = $elNick)
        return true;
    else
        return false;
}

?>
