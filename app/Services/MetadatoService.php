<?php

namespace App\Services;

use App\RepoData\MetaRepoData;

class MetadatoService
{
    public static function obtener($clave)
    {
        return MetaRepoData::obtener(['key' => $clave]);
    }
}
