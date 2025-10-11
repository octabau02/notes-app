<?php

namespace App\RepoAction;

use Illuminate\Support\Facades\DB;

class UsuarioRepoAction
{
    public static function agregar($usuario) {
        return DB::table('users')->insertGetId($usuario);
    }

    public static function editar($id, $usuario) {
        return DB::table('users')->where($id)->update($usuario);
    }

    public static function eliminar($id) {
        return DB::table('users')->where($id)->delete();
    }
}
