<?php

namespace App\Adapters;

class CloudNoteFactory
{
    public function create(string $service)
    {
        return match ($service) {
            'keep' => new KeepAdapter(),
            'evernote' => new EvernoteAdapter(),
            default => new KeepAdapter(),
        };
    }
}
