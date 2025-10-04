<?php

namespace App\Builders;

use App\Contracts\ExportBuilderInterface;
use Illuminate\Support\Facades\DB;

class SimpleExport implements ExportBuilderInterface
{
    protected $note;
    protected $exportedData;
    public function __construct($note)
    {
        $this->note = $note;
        $this->exportedData = [];
    }

    public function setId(){}

    public function setTitle()
    {
        $this->exportedData['titulo'] = $this->note->title;
    }

    public function setContent()
    {
        $this->exportedData['contenido'] = $this->note->content;
    }

    public function getType(){}

    public function setReminderDate(){}

    public function setSavedIn(){}

    public function setUser(){}

    public function setCreatedAt(){}

    public function setUpdatedAt(){}

    public function setWasUpdated(){}

    public function setIsImportant(){}

    public function build()
    {
        $this->setTitle();
        $this->setContent();
        return json_encode($this->exportedData);
    }
}
