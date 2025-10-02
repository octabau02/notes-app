<?php

namespace App\Services;

use App\Contracts\CloudNote;

class CloudNoteService
{
    protected CloudNote $cloudNote;

    public function __construct(CloudNote $cloudNote)
    {
        $this->cloudNote = $cloudNote;
    }

    public function sync($note_id)
    {
        return $this->cloudNote->sync($note_id);
    }
}
