<?php

namespace App\Factory;

use App\Contracts\NoteInterface;

class NoteFactory
{
    public static function create(string $type): NoteInterface
    {
        switch ($type) {
            case 'normal':
                return new NormalNote();
            case 'important':
                return new ImportantNote();
            case 'reminder':
                return new ReminderNote();
            default:
                throw new \Exception("Tipo de nota {$type} no reconocido.");
        }
    }
}
