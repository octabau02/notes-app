<?php

namespace App\Builders;

use Illuminate\Support\Facades\DB;

class ExportJsonBuilder implements ExportBuilderInterface
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
        return $this;
    }

    public function setTitle()
    {
        $this->exportedData['titulo'] = $this->note->title;
        return $this;
    }

    public function setContent()
    {
        $this->exportedData['contenido'] = $this->note->content;
        return $this;
    }

    public function getType()
    {
        $this->exportedData['tipo'] = $this->note->type;
        return $this;
    }

    public function setReminderDate()
    {
        $this->exportedData['fecha_recordatorio'] = $this->note->reminder_date ?? '--';
        return $this;
    }

    public function setSavedIn()
    {
        $this->exportedData['guardado_en'] = $this->note->saved_in;
        return $this;
    }

    public function setUser()
    {
        $this->exportedData['autor'] = DB::table('users')->where('id', $this->note->user_id)->value('name');
        return $this;
    }

    public function setCreatedAt()
    {
        $this->exportedData['creado_el'] = $this->note->created_at;
        return $this;
    }

    public function setUpdatedAt()
    {
        $this->exportedData['actualizado_el'] = $this->note->updated_at;
        return $this;
    }

    public function setWasUpdated()
    {
        $this->exportedData['fue_actualizado'] = $this->note->updated_at ? 'Si' : 'No';
        return $this;
    }

    public function setIsImportant()
    {
        $this->exportedData['es_importante'] = $this->note->type === 'important'? 'Si' : 'No';
        return $this;
    }

    public function build()
    {
        return json_encode($this->exportedData);
    }

}
