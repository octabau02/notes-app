<?php

namespace App\Factory;

use App\Contracts\NoteInterface;
use Illuminate\Support\Facades\Auth;
class NormalNote implements NoteInterface
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
            'type' => 'normal',
            'created_at' => now(),
        ];

        return $nota;
    }

    public function update($data)
    {
        $nota = [
            'title' => $data['title'],
            'content' => $data['content'],
            'type' => 'normal',
            'reminder_date' => null,
            'updated_at' => now(),
        ];

        return $nota;
    }
}
