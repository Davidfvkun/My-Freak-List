<?php

include "../vendor/autoload.php";
require_once "../config.php";

function registrarse($nick, $contraseña, $email, $nombre, $apellido, $descripcion) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    $ok = false;
    if ($nick != "" && $nick != null && $contraseña != "" && $contraseña != null && $email != "" && $email != null) {
        try {
            $insertarUsuario = ORM::for_table('usuario')->create();
            $insertarUsuario->nick = $nick;
            $insertarUsuario->nombre = $nombre;
            $insertarUsuario->apellido = $apellido;
            $insertarUsuario->email = $email;
            $insertarUsuario->descripcion = $descripcion;
            $insertarUsuario->clave = $contraseña; // A pelo de momento, luego se hará encriptación
            $insertarUsuario->es_admin = 1; // 1 es que si es admin. Solo habrá un admin para pruebas
            $insertarUsuario->save();
            $ok = true;
            $dbh->commit();
        } catch (\PDOException $e) {
            $dbh->rollback();
            $ok = false;
        }
    }
    return $ok;
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
        $_SESSION['logeo'] = $compruebaLogin->id; //Aun no se como mantendré el login, temporalmente queda así
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
        case "3":
            // Esta es la consulta mas complicada, de momento la obviaré.
            break;
        default:
            break;
    }
    $buscaUsuario = $buscaUsuario->find_many();
    return $buscaUsuario;
}

function buscar_material($busqueda, $V) {

    $buscaMaterial = ORM::for_table('material');
    $consulta = "SELECT * FROM material ";
    $cadena = "";
    $sep = false;
    if ($V[0] == 1) {
        $cadena = $cadena . "WHERE (tipo = 1 ";
        $sep = true;
    }
    if ($V[1] == 1) {
        $sep = true;
        if ($cadena != "")
            $cadena = $cadena . "OR tipo = 2 ";
        else
            $cadena = $cadena . "WHERE (tipo = 2 ";
    }
    if ($V[2] == 1) {
        $sep = true;
        if ($cadena != "")
            $cadena = $cadena . "OR tipo = 3";
        else
            $cadena = $cadena . "WHERE (tipo = 3";
    }
    if ($sep)
        $cadena = $cadena . ") AND nombre like '%" . $busqueda . "%'";
    else
        $cadena = $cadena . "WHERE nombre like '%" . $busqueda . "%'";

    $consulta = $consulta . $cadena;
    $buscaMaterial = $buscaMaterial->raw_query($consulta)->find_many();
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
    
    $idUsuario = ORM::for_table('usuario')->select('id')->where("nick",$nicku)->find_one();

    $buscaCosa = ORM::for_table('material')->
                    select_many('material.nombre', 'material_usuario.puntuacion', 'material_usuario.material_id', 'material_usuario.vista_en', 'material_usuario.comentario')->
                    join('material_usuario', array('material.id', '=', 'material_id'))->
                    join('usuario', array('usuario_id', '=', 'usuario.id'))->
                    where('material.tipo', $idTipo)->
                    where('material_usuario.estado', $idEstado)->
                    where('usuario.id', $idUsuario->id)->find_many();
    return $buscaCosa;
}

?>
