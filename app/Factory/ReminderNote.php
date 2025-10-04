<?php

namespace App\Factory;

use App\Contracts\NoteInterface;
use Illuminate\Support\Facades\DB;

class ReminderNote implements NoteInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create($data): int
    {
        $note = [
            'title' => $data->title,
            'content' => $data->content,
            'user_id' => $data->user()->id,
            'created_at' => now(),
            'type' => 'reminder',
            'reminder_date' => $data->reminder_date,
        ];

        return DB::table('notes')->insertGetId($note);
    }

    public function update($data): int
    {
        $note = [
            'title' => $data->title,
            'content' => $data->content,
            'type' => 'reminder',
            'reminder_date' => $data->reminder_date,
            'updated_at' => now(),
        ];

        DB::table('notes')->where('id', $data->id)->update($note);
        return $data->id;
    }
}
