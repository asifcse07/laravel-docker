<?php

namespace App\Providers;


use App\Repositories\AdRepository;
use App\Repositories\Interfaces\AdRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AdRepositoryInterface::class,
            AdRepository::class
        );
    }
}
