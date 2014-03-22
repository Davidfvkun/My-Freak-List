<?php

include "../vendor/autoload.php";
require_once "../config.php";

function registrarse($nick, $contraseña, $email, $nombre, $apellido, $descripcion) {
    $dbh = \ORM::getDb();
    $dbh->beginTransaction();
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
    return $ok;
}
?>
