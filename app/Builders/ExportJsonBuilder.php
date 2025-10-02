<?php

namespace App\Builders;

use Illuminate\Support\Facades\DB;

class ExportJsonBuilder
{
    protected $note;
    protected $exportedData;
    public function __construct($note)
    {
        $this->note = $note;
        $this->exportedData = [];
    }

    public function setId()
    {
        $this->exportedData['id'] = $this->note->id;
    }

    public function setTitle()
    {
        $this->exportedData['titulo'] = $this->note->title;
    }

    public function setContent()
    {
        $this->exportedData['contenido'] = $this->note->content;
    }

    public function getType()
    {
        $this->exportedData['tipo'] = $this->note->type;
    }

    public function setReminderDate()
    {
        $this->exportedData['fecha_recordatorio'] = $this->note->reminder_date ?? '--';
    }

    public function setSavedIn()
    {
        $this->exportedData['guardado_en'] = $this->note->saved_in;
    }

    public function setUser()
    {
        $this->exportedData['autor'] = DB::table('users')->where('id', $this->note->user_id)->value('name');
    }

    public function setCreatedAt()
    {
        $this->exportedData['creado_el'] = $this->note->created_at;
    }

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
        return json_encode($this->exportedData);
    }

    public function buildConfigurated()
    {
        $exportFormat = DB::table('metadata')->where('key', 'export_format')->value('value');

        switch ($exportFormat) {
            case 'simple':
                $this->setTitle();
                $this->setContent();
                return json_encode($this->exportedData);
            case 'intermediate':
                $this->setTitle();
                $this->setContent();
                $this->setUser();
                $this->setCreatedAt();
                return json_encode($this->exportedData);
            case 'advanced':
                $this->setTitle();
                $this->setContent();
                $this->setUser();
                $this->setUpdatedAt();
                $this->setWasUpdated();
                $this->setIsImportant();
                $this->setReminderDate();
                return json_encode($this->exportedData);
            default:
                throw new \Exception("Unsupported export format: $exportFormat");
        }
    }

}
