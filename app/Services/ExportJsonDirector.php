<?php

namespace App\Services;

use App\Builders\ExportJsonBuilder;
use Illuminate\Support\Facades\DB;

class ExportJsonDirector
{
    public function exportConfigurated(ExportJsonBuilder $builder)
    {
        $exportFormat = DB::table('metadata')->where('key', 'export_format')->value('value');

        switch ($exportFormat) {
            case 'simple':
                $builder->setTitle();
                $builder->setContent();
                return $builder->build();

            case 'intermediate':
                $builder->setTitle();
                $builder->setContent();
                $builder->setUser();
                $builder->setCreatedAt();
                return $builder->build();

            case 'advanced':
                $builder->setTitle();
                $builder->setContent();
                $builder->setUser();
                $builder->setUpdatedAt();
                $builder->setWasUpdated();
                $builder->setIsImportant();
                $builder->setReminderDate();
                return $builder->build();

            default:
                throw new \Exception("Unsupported export format: $exportFormat");
        }
    }
}
