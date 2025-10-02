<?php

namespace App\Facades;

use App\Services\SyncNoteService;
use Illuminate\Support\Facades\Facade;

class SyncNotes extends Facade
{
    public static function getFacadeAccessor()
    {
        return SyncNoteService::class;
    }
}
