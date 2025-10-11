<?php

namespace App\RepoAction;

use Illuminate\Support\Facades\DB;

class NotaRepoAction
{
    public static function crear($nota){
        return DB::table('notes')->insertGetId($nota);
    }

    public static function actualizar($id, $nota){
        return DB::table('notes')->where('id', $id)->update($nota);
    }

    public static function eliminar($id){
        return DB::table('notes')->where('id', $id)->delete();
    }
}
