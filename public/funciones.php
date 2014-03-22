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
        // $_SESSION['loge'] = $login->id; Aun no se como mantendré el login
        $app->render('inicio.html.twig');
    }
}

function buscar_usuarios($busqueda, $filtrado)
{
    $buscaUsuario = ORM::for_table('usuario');
    switch($filtrado)
    {
        case "1":
            $buscaUsuario = $buscaUsuario->where_like("nombre","%".$busqueda."%");
            break;
        case "2":
            $buscaUsuario = $buscaUsuario->where_like("nick","%".$busqueda."%");
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
function buscar_material($busqueda, $filtrado)
{
    $buscaUsuario = ORM::for_table('material');
    /*switch($filtrado)
    {
        case "1":
            $buscaUsuario = $buscaUsuario->where_like("nombre","%".$busqueda."%");
            break;
        case "2":
            $buscaUsuario = $buscaUsuario->where_like("nick","%".$busqueda."%");
            break;
        case "3":
            // Esta es la consulta mas complicada, de momento la obviaré.
            break;
        default:
            break;
    }*/
    $buscaUsuario = $buscaUsuario->find_many();
    return null; // Primero haré unos inserts SQL para poder probar esto.
}

?>
