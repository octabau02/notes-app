<?php

namespace App\Builders;

abstract class BaseExportDirector
{
    protected ExportBuilderInterface $builder;
    public function __construct(ExportBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    abstract public function export();
}
