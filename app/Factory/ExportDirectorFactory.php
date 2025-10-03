<?php

namespace App\Factory;

use App\Builders\ExportJsonBuilder;

class ExportDirectorFactory
{
    function create($level, $note){

        $builder = new ExportJsonBuilder($note);
        switch ($level) {
            case 'simple':
                return new \App\Builders\SimpleExport($builder);
            case 'intermediate':
                return new \App\Builders\IntermediateExport($builder);
            case 'advanced':
                return new \App\Builders\AdvancedExport($builder);
            default:
                throw new \Exception("Nivel de exportación {$level} no reconocido.");
        }
    }
}
