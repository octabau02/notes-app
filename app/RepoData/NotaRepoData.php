<?php

namespace App\RepoData;

use App\RH\NotaRH;
use Illuminate\Support\Facades\DB;

class NotaRepoData
{
  public static function listar($filtros, $columnas, $orden, $limit, $offset){
    $query = DB::table('notes');

    NotaRH::agregarColumnas($query, $columnas);
    NotaRH::agregarFiltros($query, $filtros);
    NotaRH::agregarOrden($query, $orden);

    if(isset($limit)){
        $query->limit($limit);
    }
    if(isset($offset)){
        $query->offset($offset);
    }

    return $query->get();
  }

  public static function obtener($id, $columnas){
    $query = DB::table('notes');

    if(isset($id)){
        $query->where('id', $id);
    }

    NotaRH::agregarColumnas($query, $columnas);

    return $query->get();
  }
}
