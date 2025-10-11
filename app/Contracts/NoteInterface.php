<?php

namespace App\Contracts;

interface NoteInterface
{
    public function create($data);

    public function update($data);
}
