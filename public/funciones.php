<?php

include "../vendor/autoload.php";
require_once "../config.php";

function registrarse($nick, $contraseña, $email, $nombre, $apellido, $descripcion) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
    $ok = false;
    if ($nick != "" && $nick != null && $contraseña != "" && $contraseña != null && $email != "" && $email != null) {
        if ($pasa) {
            try {
                $insertarUsuario = ORM::for_table('usuario')->create();
                $insertarUsuario->nick = $nick;
                $insertarUsuario->nombre = $nombre;
                $insertarUsuario->apellido = $apellido;
                $insertarUsuario->email = $email;
                $insertarUsuario->descripcion = $descripcion;
                $insertarUsuario->contraseña = $contraseña; // A pelo de momento, luego se hará encriptación
                $insertarUsuario->es_admin = 1; // 1 es que si es admin. Solo habrá un admin para pruebas
                $insertarUsuario->save();
                $ok = true;
                $dbh->commit();
            } catch (\PDOException $e) {
                $dbh->rollback();
                $ok = false;
            }
        }
    }
    return $ok;
}

function login($nick, $contraseña, $app) {
    $compruebaLogin = ORM::for_table('usuario')->where("nick", $nick)->find_one();
    //if ($login === false || !password_verify($clave, $login->contraseña)) {
    if ($compruebaLogin === false || $contraseña != $compruebaLogin->contraseña) {
        $app->render('myfreakzone.html.twig', array(
            'mensaje' => 'Usuario y/o contraseña incorrectos',
            'clase' => 'info error'));
        //} else if (password_verify($clave, $login->contraseña)) {
    } else if ($contraseña == $compruebaLogin->contraseña) {
        // $_SESSION['loge'] = $login->id; Aun no se como mantendré el login
        $app->render('inicio.html.twig');
    }
}

?>
