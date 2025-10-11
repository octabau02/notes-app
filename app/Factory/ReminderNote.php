<?php

namespace App\Factory;

use App\Contracts\NoteInterface;
use Illuminate\Support\Facades\Auth;

class ReminderNote implements NoteInterface
{
    public function create($data)
    {
        $nota = [
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
            'created_at' => now(),
            'type' => 'reminder',
            'reminder_date' => !empty($data['reminder_date']) ? $data['reminder_date'] : null,
        ];

        return $nota;
    }

    public function update($data)
    {
        $nota = [
            'title' => $data['title'],
            'content' => $data['content'],
            'type' => 'reminder',
            'reminder_date' => !empty($data['reminder_date']) ? $data['reminder_date'] : null,
            'updated_at' => now(),
        ];

        return $nota;
    }
}
