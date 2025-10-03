<?php

namespace App\Providers;

use App\Adapters\EvernoteAdapter;
use App\Adapters\KeepAdapter;
use App\Contracts\CloudNote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class CloudNoteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CloudNote::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
