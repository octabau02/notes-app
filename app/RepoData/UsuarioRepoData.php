<?php

namespace App\RepoData;

use App\RH\UsuarioRH;
use Illuminate\Support\Facades\DB;

class UsuarioRepoData
{
    public static function listar($filtros, $columnas, $orden, $limit, $offset){
        $query = DB::table('users');

        UsuarioRH::agregarColumnas($query, $columnas);
        UsuarioRH::agregarFiltros($query, $filtros);
        UsuarioRH::agregarOrden($query, $orden);

        if(isset($limit)){
            $query->limit($limit);
        }
        if(isset($offset)){
            $query->offset($offset);
        }

        return $query->get()->toArray();
    }

    public static function obtener($id = null, $email = null, $columnas)
    {
        $query = DB::table('users');

        if (isset($id)) {
            $query->where('id', $id);
        }
        if (isset($email)) {
            $query->where('email', $email);
        }

        UsuarioRH::agregarColumnas($query, $columnas);

        return $query->first();
    }
}
