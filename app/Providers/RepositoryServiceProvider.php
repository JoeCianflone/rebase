<?php

namespace App\Providers;

use App\Domain\Models\User;
use App\Domain\Models\Account;
use App\Domain\Models\Workspace;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\EloquentUserRepository;
use App\Domain\Repositories\EloquentAccountRepository;
use App\Domain\Repositories\EloquentWorkspaceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('AccountRepository', function (Application $app) {
            return new EloquentAccountRepository(new Account());
        });

        $this->app->singleton('WorkspaceRepository', function ($app) {
            return new EloquentWorkspaceRepository(new Workspace());
        });

        $this->app->singleton('UserRepository', function (Application $app) {
            return new EloquentUserRepository(new User());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
