<?php

namespace App\Factory;

use App\Contracts\NoteInterface;
use Illuminate\Support\Facades\Auth;

class ImportantNote implements NoteInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function create($data)
    {
        $nota = [
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
            'created_at' => now(),
            'type' => 'important',
        ];

        return $nota;
    }

    public function update($data)
    {
        $nota = [
            'title' => $data['title'],
            'content' => $data['content'],
            'type' => 'important',
            'updated_at' => now(),
        ];

        return $nota;
    }
}
