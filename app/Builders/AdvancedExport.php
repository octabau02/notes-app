<?php

namespace App\Builders;

use App\Contracts\ExportBuilderInterface;
use Illuminate\Support\Facades\DB;

class AdvancedExport implements ExportBuilderInterface
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

    public function setReminderDate()
    {
        $this->exportedData['fecha_recordatorio'] = $this->note->reminder_date ?? '--';
    }

    public function setSavedIn(){}

    public function setUser()
    {
        $this->exportedData['autor'] = DB::table('users')->where('id', $this->note->user_id)->value('name');
    }

    public function setCreatedAt(){}

    public function setUpdatedAt()
    {
        $this->exportedData['actualizado_el'] = $this->note->updated_at;
    }

    public function setWasUpdated()
    {
        $this->exportedData['fue_actualizado'] = $this->note->updated_at ? 'Si' : 'No';
    }

    public function setIsImportant()
    {
        $this->exportedData['es_importante'] = $this->note->type === 'important'? 'Si' : 'No';
    }

    public function build()
    {
        $this->setTitle();
        $this->setContent();
        $this->setUser();
        $this->setUpdatedAt();
        $this->setWasUpdated();
        $this->setIsImportant();
        $this->setReminderDate();
        return json_encode($this->exportedData);
    }
}
