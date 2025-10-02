<?php

namespace App\Factory;

interface Note
{
    public function create($data): int;

    public function update($data): int;
}
