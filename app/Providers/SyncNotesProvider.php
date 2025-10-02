<?php

namespace App\Providers;

use App\Services\SyncNoteService;
use Illuminate\Support\ServiceProvider;

class SyncNotesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SyncNoteService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
