<?php

namespace App\Adapters;

use App\Contracts\CloudNote;
use Illuminate\Support\Facades\DB;

class EvernoteAdapter implements CloudNote
{
    public function sync($note_id)
    {
        $note = DB::table('notes')->where('id', $note_id)->first();
        $noteData = [
            'user_id' => $note->user_id,
            'note' => [
                'description' => $note->content,
                'title' => $note->title,
            ]
        ];

        DB::table('notes')->where('id', $note_id)->update(['saved_in' => 'evernote', 'exported_data' => json_encode($noteData)]);
    }
}
