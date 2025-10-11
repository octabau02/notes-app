<?php

namespace App\RH;

class UsuarioRH
{
    public static function agregarColumnas(&$query, $columnas){
        if(!empty($columnas)){
            $arregloColumnas = explode(',', $columnas);
            $query->select($arregloColumnas);
        }
    }

    public static function agregarFiltros(&$query, $filtros){
        if(!empty($filtros)){
            if (isset($filtros['name'])) {
                $query->where('name', $filtros['name']);
            };

            if (isset($filtros['email'])) {
                $query->where('email', $filtros['email']);
            };
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
