<?php

namespace App\Providers;

use App\Domain\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\EloquentUserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('UserRepository', function($app) {
            return new EloquentUserRepository(new User());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
