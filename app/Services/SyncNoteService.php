<?php

namespace App\Services;

use App\Factory\NoteFactory;

class SyncNoteService
{
    protected $cloudNoteService;

    public function __construct(CloudNoteService $cloudNotesService)
    {
        $this->cloudNoteService = $cloudNotesService;
    }

    public function send($note){
        $NoteType = $note->important ? 'important' : ($note->reminder_date ? 'reminder' : 'normal');

        $factory = NoteFactory::create($NoteType);
        if($note->id){
            $note_id =$factory->update($note);
        }else{
            $note_id = $factory->create($note);
        }

        $this->cloudNoteService->sync($note_id);
    }
}
