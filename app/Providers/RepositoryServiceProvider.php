<?php

namespace App\Providers;

use App\Domain\Models\Customer\Lookup;
use Illuminate\Foundation\Application;
use App\Domain\Models\Workspace\Member;
use Illuminate\Support\ServiceProvider;
use App\Domain\Models\Customer\Customer;
use App\Domain\Models\Customer\BannedSlug;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Repositories\EloquentLookupRepository;
use App\Domain\Repositories\EloquentMemberRepository;
use App\Domain\Repositories\EloquentCustomerRepository;
use App\Domain\Repositories\EloquentWorkspaceRepository;
use App\Domain\Repositories\EloquentBannedSlugRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('CustomerRepository', function (Application $app) {
            return new EloquentCustomerRepository(new Customer());
        });

        $this->app->singleton('WorkspaceRepository', function (Application $app) {
            return new EloquentWorkspaceRepository(new Workspace());
        });

        $this->app->singleton('MemberRepository', function (Application $app) {
            return new EloquentMemberRepository(new Member());
        });

        $this->app->singleton('BannedSlugRepository', function (Application $app) {
            return new EloquentBannedSlugRepository(new BannedSlug());
        });

        $this->app->singleton('LookupRepository', function (Application $app) {
            return new EloquentLookupRepository(new Lookup());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
