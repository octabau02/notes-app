<?php

namespace App\Factory;

use App\Contracts\NoteInterface;
use Illuminate\Support\Facades\DB;
class NormalNote implements NoteInterface
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
            'type' => 'normal',
            'created_at' => now(),
        ];

        return DB::table('notes')->insertGetId($note);

    }

    public function update($data): int
    {
        $note = [
            'title' => $data->title,
            'content' => $data->content,
            'type' => 'normal',
            'updated_at' => now(),
        ];

        DB::table('notes')->where('id', $data->id)->update($note);
        return $data->id;
    }
}
