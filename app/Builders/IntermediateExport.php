<?php

namespace App\Builders;

class IntermediateExport extends BaseExportDirector
{
   public function export()
   {
       return $this->builder->setTitle()
                    ->setContent()
                    ->setUser()
                    ->setCreatedAt()
                    ->build();
   }
}
