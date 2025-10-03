<?php

namespace App\Builders;

class SimpleExport extends BaseExportDirector
{

    public function export()
    {
        return $this->builder->setTitle()->setContent()->build();
    }
}
