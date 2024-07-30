<?php

namespace App\Providers;

use App\Repositories\Interfaces\BreedRepositoryInterface;
use App\Repositories\Interfaces\PetConditionRepositoryInterface;
use App\Repositories\Interfaces\PetRepositoryInterface;
use App\Repositories\Memory\BreedRepository;
use App\Repositories\Memory\PetConditionRepository;
use App\Repositories\Memory\PetRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRepositories();
    }

    public function boot()
    {
    }

    protected function registerRepositories()
    {
        $this->app->singleton(BreedRepositoryInterface::class, BreedRepository::class);
        $this->app->singleton(PetConditionRepositoryInterface::class, PetConditionRepository::class);
        $this->app->singleton(PetRepositoryInterface::class, PetRepository::class);
    }
}
