<?php

namespace App\Providers;

use App\core\artist\ArtistInterface;
use App\core\artist\ArtistRepository;
use App\core\label\LabelInterface;
use App\core\label\LabelRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ArtistInterface::class, ArtistRepository::class);
        $this->app->bind(LabelInterface::class, LabelRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
