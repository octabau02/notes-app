<?php

namespace App\Builders;

class AdvancedExport extends BaseExportDirector
{
    public function export()
    {
        return $this->builder->setTitle()
                       ->setContent()
                       ->setUser()
                       ->setUpdatedAt()
                       ->setWasUpdated()
                       ->setIsImportant()
                       ->setReminderDate()
                       ->build();
    }
}
