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
        $cloudService = DB::table('metadata')->where('key', 'cloud_service')->value('value');
        $this->app->bind(CloudNote::class, function($app) use ($cloudService) {
            return match ($cloudService) {
                'keep' => new KeepAdapter(),
                'evernote' => new EvernoteAdapter(),
                default => new KeepAdapter(),
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
