<?php

namespace App\RH;

class NotaRH
{
    public static function agregarColumnas(&$query, $columnas){
        if(!empty($columnas)){
            $arregloColumnas = explode(',', $columnas);
            $query->select($arregloColumnas);
        }
    }

    public static function agregarFiltros(&$query, $filtros){
        if(!empty($filtros)){
            if (isset($filtros['id'])) {
                $query->where('id', $filtros['id']);
            };

            if (isset($filtros['user_id'])) {
                $query->where('user_id', $filtros['user_id']);
            };

            if (isset($filtros['created_at'])) {
                $query->whereDate('created_at', $filtros['created_at']);
            }

            if (isset($filtros['was_updated']) && $filtros['was_updated']) {
                $query->whereNotNull('updated_at');
            }
        }
    }

    public static function agregarOrden(&$query, $orden){
        if(!empty($orden)){
            foreach($orden as $columna => $direccion){
                $query->orderBy($columna, $direccion);
            }
        }
    }
}
