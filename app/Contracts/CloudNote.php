<?php

namespace App\Contracts;

interface CloudNote
{
    public function sync($note);
}
