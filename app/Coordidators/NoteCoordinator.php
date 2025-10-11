<?php

namespace App\Coordidators;

use App\Services\MetadatoService;
use App\Services\NoteService;

class NoteCoordinator
{
    public static function crear($notaData)
    {
        $configNube = MetadatoService::obtener('cloud_service');
        NoteService::crear($notaData, $configNube);
    }

    public static function exportar($id)
    {
        $exportFormat = MetadatoService::obtener('export_format');
        return NoteService::exportar($id, $exportFormat);
    }
}
