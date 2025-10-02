<?php

namespace App\Adapters;

use App\Contracts\CloudNote;
use Illuminate\Support\Facades\DB;

class KeepAdapter implements CloudNote
{
    public function sync($note_id)
    {
        $note = DB::table('notes')->where('id', $note_id)->first();
        $noteData = [
            'user_id' => $note->user_id,
            'note' => $note->content,
            'title' => $note->title,
            'date' => $note->created_at,
        ];

        DB::table('notes')->where('id', $note_id)->update(['saved_in' => 'keep', 'exported_data' => json_encode($noteData)]);
    }
}
