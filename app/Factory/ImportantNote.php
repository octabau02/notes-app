<?php

namespace App\Factory;

use Illuminate\Support\Facades\DB;

class ImportantNote implements Note
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function create($data): int
    {
        $note = [
            'title' => $data->title,
            'content' => $data->content,
            'user_id' => $data->user()->id,
            'reminder_date' => $data->reminder_date,
            'created_at' => now(),
            'type' => 'important',
        ];

        return DB::table('notes')->insertGetId($note);
    }

    public function update($data): int
    {
        $note = [
            'title' => $data->title,
            'content' => $data->content,
            'type' => 'important',
            'reminder_date' => $data->reminder_date,
            'updated_at' => now(),
        ];

        DB::table('notes')->where('id', $data->id)->update($note);
        return $data->id;
    }
}
