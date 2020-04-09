<?php

namespace App\Providers;

use App\Domain\Models\User;
use App\Domain\Models\Account;
use App\Domain\Models\Banlist;
use App\Domain\Models\Listing;
use App\Domain\Models\Workspace;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use App\Domain\Repositories\EloquentUserRepository;
use App\Domain\Repositories\EloquentAccountRepository;
use App\Domain\Repositories\EloquentBanlistRepository;
use App\Domain\Repositories\EloquentListingRepository;
use App\Domain\Repositories\EloquentWorkspaceRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ListingRepository', function (Application $app) {
            return new EloquentListingRepository(new Listing());
        });

        $this->app->singleton('AccountRepository', function (Application $app) {
            return new EloquentAccountRepository(new Account());
        });

        $this->app->singleton('BanlistRepository', function (Application $app) {
            return new EloquentBanlistRepository(new Banlist());
        });

        $this->app->singleton('WorkspaceRepository', function (Application $app) {
            return new EloquentWorkspaceRepository(new Workspace());
        });

        $this->app->singleton('UserRepository', function (Application $app) {
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
