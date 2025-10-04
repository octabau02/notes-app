<?php

namespace App\Contracts;

interface NoteInterface
{
    public function create($data): int;

    public function update($data): int;
}
