<?php

namespace App\Providers;

use App\Domain\Models\User;
use App\Domain\Models\Account;
use App\Domain\Models\Workspace;
use App\Domain\Models\BannedSlug;
use App\Domain\Models\UserWorkspace;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\EloquentUserRepository;
use App\Domain\Repositories\EloquentAccountRepository;
use App\Domain\Repositories\EloquentWorkspaceRepository;
use App\Domain\Repositories\EloquentBannedSlugRepository;
use App\Domain\Repositories\EloquentUserWorkspaceRepository;

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

        $this->app->singleton('WorkspaceRepository', function (Application $app) {
            return new EloquentWorkspaceRepository(new Workspace());
        });

        $this->app->singleton('UserRepository', function (Application $app) {
            return new EloquentUserRepository(new User());
        });

        $this->app->singleton('BannedSlugRepository', function (Application $app) {
            return new EloquentBannedSlugRepository(new BannedSlug());
        });

        $this->app->singleton('UserWorkspaceRepository', function (Application $app) {
            return new EloquentUserWorkspaceRepository(new UserWorkspace());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
