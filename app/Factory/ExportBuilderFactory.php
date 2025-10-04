<?php

namespace App\Factory;

use App\Builders\AdvancedExport;
use App\Builders\IntermediateExport;
use App\Builders\SimpleExport;

class ExportBuilderFactory
{
    public static function create($type, $note)
    {
        switch ($type) {
            case 'simple':
                return new SimpleExport($note);
            case 'intermediate':
                return new IntermediateExport($note);
            case 'advanced':
                return new AdvancedExport($note);
            default:
                throw new \InvalidArgumentException("Tipo de exportación desconocido: $type");
        }
    }
}
