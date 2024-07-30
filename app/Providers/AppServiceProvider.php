<?php

namespace App\Providers;

use App\Services\Contracts\DomainContract;
use App\Services\Contracts\PetContract;
use App\Services\DomainService;
use App\Services\PetService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        DomainContract::class => DomainService::class,
        PetContract::class => PetService::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
