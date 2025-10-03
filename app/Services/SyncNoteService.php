<?php

namespace App\Services;

use App\Adapters\CloudNoteFactory;
use App\Adapters\EvernoteAdapter;
use App\Adapters\KeepAdapter;
use App\Factory\NoteFactory;
use Illuminate\Support\Facades\DB;

class SyncNoteService
{
    protected $cloudNoteFactory;

    public function __construct(CloudNoteFactory $cloudNoteFactory)
    {
        $this->cloudNoteFactory = $cloudNoteFactory;
    }

    public function send($note){
        $note_saved_in = DB::table('notes')->where('id', $note->id)->value('saved_in');
        $NoteType = $note->important ? 'important' : ($note->reminder_date ? 'reminder' : 'normal');
        $cloudConfig = DB::table('metadata')->where('key', 'cloud_service')->value('value');

        $factory = NoteFactory::create($NoteType);
        if($note->id){
            $service_type = $note_saved_in ?? $cloudConfig;
            $cloudService = $this->cloudNoteFactory->create($service_type);
            $note_id =$factory->update($note);
        }else{
            $cloudService = $this->cloudNoteFactory->create($cloudConfig);
            $note_id = $factory->create($note);
        }

        $cloudService->sync($note_id);
    }
}
